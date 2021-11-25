<?php

namespace App\Http\Controllers\Admin;
use App\Enums\ActiveDisable;
use App\Enums\CategoryType;
use App\Enums\PostType;
use App\Enums\TagType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTranslationRequest;
use App\Http\Requests\UpdateTranslationRequest;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Translation;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('blog.view');

        $categories = Category::query()->with('translation',function($q){
            $q->select('id','name','category_id');
        })->whereType(CategoryType::post)->public()->latest()->get();

        $authors = Admin::query()->select('id','name','email')->when(auth()->id() > 1, function ($q){
            $q->where('id','>', 1);
        })->get();

        return view('admin.post.index',compact('authors','categories'));
    }

    public function data(){

        $posts = Post::query()->with(['category' => function($q){
                $q->with('translation', function($q){
                    $q->select('id','name','slug','category_id');
                });
            }, 'admin','categories' => function($q){
                $q->with('translation');
            } , 'translation' => function($q){
                $q->select('name','slug','post_id');
            },'comments' => function($q){
                $q->select('id','comment_type','comment_id','rate');
            }])
            ->when(\request()->type,function ($q, $type){
                return $q->whereType($type);
            })
            ->when(request()->search, function ($q, $keyword){
                return $q->whereHas('translation',function ($q) use ($keyword){
                    return $q->where('id', $keyword)->orWhere('name', 'like', '%'.$keyword.'%')->orWhere('slug', 'like', '%'.$keyword.'%');
                });
            })
            ->when(\request()->author,function ($q, $author){
                return $q->whereAdminId($author);
            })
            ->when(request()->status, function ($q, $status){
                return $q->where('status', $status);
            })
            ->when(request()->public, function ($q, $public){
                return $q->wherePublic($public);
            })
            ->when(request()->category, function ($q, $category){
                $q->where('category_id',$category)
                    ->orwhereHas('categories' , function ($q) use ($category) {
                        $q->whereCategoryId($category);
                    });
            });

        return datatables()->of($posts)
            ->editColumn('title', function ($post){
                return $post->translation->name;
            })
            ->editColumn('comments', function ($post){
                return $post->comments->whereNotNull('rate')->count();
            })
            ->editColumn('rating', function ($post){
                if(!$post->comments->count())
                    return 0;
                return  round($post->comments->sum('rate') /  $post->comments->whereNotNull('rate')->count(), 1);
            })
            ->editColumn('image', function ($post){
                return $post->thumb;
            })
            ->editColumn('created_at', function ($post){
                return $post->created_at->diffForHumans();
            })

            ->order(function ($query){
                $query->orderBy(request()->input('sort','created_at'), request()->input('order','desc'));
            })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('blog.create');

        $categories = Category::query()->with('translation',function($q){
            $q->select('id','name','category_id');
        })->whereType(CategoryType::post)->public()->latest()->get();

        $tags = Tag::ofType(TagType::post)->get();

        return view('admin.post.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTranslationRequest $request)
    {
        $this->authorize('blog.create');

        $post = new Post();
        $post->forceFill($request->data);
        $post->save();

        $post->translations()->createMany($request->translation);
        $post->categories()->attach($request->category_id);

        return flash('Thêm mới thành công', 1 , $post->route);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('blog.edit');

        $categories = Category::query()->with('translation',function($q){
            $q->select('id','name','category_id');
        })->whereType(CategoryType::post)->public()->latest()->get();

        $translations = $post->translations->load('language');

        $tags = Tag::ofType(TagType::post)->get();

        return  view('admin.post.edit', compact('post','categories','translations','tags'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTranslationRequest $request, Post $post)
    {
        $this->authorize('blog.edit');

        $post->forceFill($request->data);
        $post->admin_edit = Auth::id();
        $post->status = $request->status ? ActiveDisable::active : ActiveDisable::disable;
        $post->public = $request->public ? ActiveDisable::active : ActiveDisable::disable;
        $post->save();

        //translations
        foreach ($request->translation as $translation):
            $post->translations()->updateOrCreate(['locale' => $translation['locale']], $translation);
        endforeach;

        $post->categories()->sync($request->category_id);

        return flash('Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Post $post)
    {
        $this->authorize('blog.destroy');

        $post->delete();
        return flash('Xóa thành công');
    }
}
