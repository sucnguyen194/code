<?php
namespace App\Http\Controllers\Admin;

use App\Enums\ActiveDisable;
use App\Enums\CategoryType;
use App\Enums\TagType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTranslationRequest;
use App\Http\Requests\UpdateTranslationRequest;
use App\Models\Admin;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('product.view');

        $categories = Category::query()->with('translation', function($q){
            $q->select('id','name','category_id');
        })->whereHas('translation')->whereType(CategoryType::product)->public()->latest()->get();

        $admins = Admin::query()->select('id','name','email')->when(auth()->id() > 1, function ($q){
            $q->where('id','>', 1);
        })->get();

        return view('admin.product.index',compact('categories','admins'));
    }

    public function data(){
        $products = Product::query()->with(['category' => function($q){
                $q->with('translation', function ($q){
                    $q->select('id','name','slug','category_id');
                });
            },'categories' => function($q){
                    $q->with('translation');
             } ,'translation' => function($q){
                $q->select('name','slug','product_id');
            },'admin','comments' => function($q){
                $q->select('id','comment_type','comment_id','rate');
            }])->whereHas('translation')->whereType(request()->type)
            ->when(request()->author,function($q, $author){
                $q->where('admin_id',$author);
            })
            ->when(request()->search, function ($q, $keyword){
                return $q->whereHas('translation',function ($q) use ($keyword){
                    return $q->where('id', $keyword)->orWhere('name', 'like', '%'.$keyword.'%')->orWhere('slug', 'like', '%'.$keyword.'%')->orWhere('code', 'like', '%'.$keyword.'%');
                });
            })
            ->when(request()->status,function($q, $status){
                $q->where('status',$status);
            })
            ->when(request()->public, function($q, $public){
                $q->where('public',$public);
            })
            ->when(\request()->category,function($q, $category){
                $q->where('category_id',$category)
                  ->orwhereHas('categories' , function ($q) use ($category) {
                        $q->whereCategoryId($category);
                });
            });

        return datatables()->of($products)
            ->editColumn('name',function($product){
                return $product->translation->name;
            })
            ->editColumn('thumb',function($product){
                return $product->thumb;
            })
            ->editColumn('image',function($product){
                return $product->images;
            })
            ->editColumn('comments', function ($product){
                return $product->comments->whereNotNull('rate')->count();
            })
            ->editColumn('rating', function ($product){
                if(!$product->comments->count())
                    return 0;
                return  round($product->comments->sum('rate') /  $product->comments->whereNotNull('rate')->count(), 1);
            })
            ->editColumn('created_at', function ($product){
                return $product->created_at->diffForHumans();
            })
            ->order(function($q){
                $q->orderBy(\request()->input('sort','created_at'), \request()->input('order','desc'));
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('product.create');

        $categories = Category::with('translation')->whereHas('translation')->whereType(CategoryType::product)->public()->latest()->get();
        $attributes = Attribute::with('translation')->whereHas('translation')->oldest('sort')->get();
        $tags = Tag::ofType(TagType::product)->get();

        return view('admin.product.create', compact('categories','attributes', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTranslationRequest $request)
    {

       $this->authorize('product.create')
       || $this->authorize('video.create')
       || $this->authorize('gallery.create');

        $product = new Product;
        $product->fill($request->data);

        if($request->input('data.price_sale') && $request->input('data.price_sale') > $request->input('data.price'))
            return flash('Giá khuyến mại phải thấp hơn giá gốc',3);

        if ($request->input('fields.0.name')){
            $fields = [];
            foreach ($request->fields as $field){
                if ($field['name']){
                    $fields[] = $field;
                }
            }
            $product->options = $fields;
        }
        if($request->photos){
            $photos = [];
            foreach ($request->photos as $photo):
                $photos[] = $photo;
            endforeach;

            $product->photo = $photos;
        }

        if($request->input('data.video')){
            $product->video = str_replace('https://www.youtube.com/watch?v=','',$request->input('data.video'));
        }

        $product->save();

        $product->translations()->createMany($request->translation);
        $product->categories()->attach($request->category_id);

        $product->attributes()->attach($request->attribute);

        return  flash('Thêm mới thành công', 1 , $product->route);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize('product.edit');

        $categories = Category::with('translation')->whereHas('translation')->whereType(CategoryType::product)->public()->latest()->get();
        $attributes = Attribute::with('translation')->whereHas('translation')->oldest('sort')->get();
        $translations = $product->translations->load('language');

        $tags = Tag::ofType(TagType::product)->get();

        return view('admin.product.edit',compact('product','categories','attributes','translations','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTranslationRequest $request, Product $product)
    {
         $this->authorize('product.edit')
         || $this->authorize('video.edit')
         || $this->authorize('gallery.edit');

        if($request->input('data.price_sale') && $request->input('data.price_sale') > $request->input('data.price'))
            return flash('Giá khuyến mại phải thấp hơn giá gốc',3);

        $product->forceFill($request->data);

        if ($request->input('fields.0.name')){
            $fields = [];
            foreach ($request->fields as $field){
                if ($field['name']){
                    $fields[] = $field;
                }
            }
            $product->options = $fields;
        }

        if($request->photos){
            $photos = [];
            foreach ($request->photos as $photo):
                $photos[] = $photo;
            endforeach;

            $product->photo = $photos;
        }

        if($request->input('data.video')){
            $product->video = str_replace('https://www.youtube.com/watch?v=','',$request->input('data.video'));
        }
        $product->admin_edit = Auth::id();
        $product->status = $request->status ? ActiveDisable::active : ActiveDisable::disable;
        $product->public = $request->public ? ActiveDisable::active : ActiveDisable::disable;
        $product->save();

        //translations
        foreach ($request->translation as $translation):
            $product->translations()->updateOrCreate(['locale' => $translation['locale']], $translation);
        endforeach;

        $product->categories()->sync($request->category_id);
        $product->attributes()->sync($request->attribute);

        return  flash('Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Product $product)
    {
        $this->authorize('product.destroy');

        $product->delete();

        return flash('Xóa bản ghi thành công!');
    }
}
