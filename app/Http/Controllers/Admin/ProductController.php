<?php
namespace App\Http\Controllers\Admin;

use App\Enums\ActiveDisable;
use App\Enums\CategoryType;
use App\Enums\SystemType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTranslationRequest;
use App\Http\Requests\UpdateTranslationRequest;
use App\Jobs\CreatePostLangs;
use App\Jobs\CreateTags;
use App\Models\Admin;
use App\Models\Alias;
use App\Models\Attribute;
use App\Models\AttributeCategory;
use App\Models\Category;
use App\Models\Lang;
use App\Models\Photo;
use App\Models\PostLang;
use App\Models\Product;
use App\Models\ProductSession;
use App\Models\User;
use App\Models\UserAgency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Session, Image;

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

        $categories = Category::whereType(CategoryType::product)->withTranslation()->public()->get();

        $admins = Admin::when(auth()->id() > 1, function ($q){
            $q->where('id','>', 1);
        })->get();

        return view('admin.product.index',compact('categories','admins'));
    }

    public function data(){
        $products = Product::with(['category' => function($q){
            $q->withTranslation();
            },'admin'])->whereType(request()->type)
            ->when(request()->author,function($q, $author){
                $q->where('admin_id',$author);
            })
            ->when(request()->search, function ($q, $keyword){
                return $q->whereHas('translation',function ($q) use ($keyword){
                    return $q->where('id', $keyword)->orWhere('name', 'like', '%'.$keyword.'%')->orWhere('slug', 'like', '%'.$keyword.'%');
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
            })->withTranslation();

        return datatables()->of($products)
            ->editColumn('name',function($product){
                return $product->translation->name;
            })
            ->editColumn('image',function($product){
                return $product->thumb;
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

        $categories = Category::whereType(CategoryType::product)->public()->withTranslation()->latest()->get();
        $attributes = Attribute::oldest('sort')->withTranslation()->get();

        return view('admin.product.create', compact('categories','attributes'));
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

        if($request->input('data.price_sale')){
            if($request->input('data.price_sale') > $request->input('data.price'))
                return flash('Giá khuyến mại phải thấp hơn giá gốc',3);
        }

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
        $product->categories()->attach($request->category_id);
        $product->attributes()->attach($request->attribute);
        $product->translations()->createMany($request->translation);

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
        if(auth()->id() > 1) $this->authorize('product.edit');

        $categories = Category::whereType(CategoryType::product)->public()->withTranslation()->latest()->get();
        $attributes = Attribute::oldest('sort')->withTranslation()->get();
        $translations = $product->translations->load('language');

        return view('admin.product.edit',compact('product','categories','attributes','translations'));
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
         $this->authorize('product.create')
         || $this->authorize('video.create')
         || $this->authorize('gallery.create');

        if($request->input('data.price_sale')){
            if($request->input('data.price_sale') > $request->input('data.price'))
                return flash('Giá khuyến mại phải thấp hơn giá gốc',3);
        }

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

        $product->categories()->sync($request->category_id);
        $product->attributes()->sync($request->attribute);

        //translations
        foreach ($request->translation as $translation):
            $product->translation()->updateOrCreate(['locale' => $translation['locale']], $translation);
        endforeach;

        if($request->back)
            return  flash('Cập nhật thành công!',1 , route($product->route));

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
