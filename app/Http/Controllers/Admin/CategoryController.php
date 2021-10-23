<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ActiveDisable;
use App\Enums\AliasType;
use App\Enums\CategoryType;
use App\Enums\Upload;
use App\Http\Controllers\Controller;
use App\Enums\SystemType;
use App\Http\Requests\StoreTranslationRequest;
use App\Jobs\CreatePostLangs;
use App\Models\Alias;
use App\Models\Category;
use App\Models\Lang;
use App\Models\Post;
use App\Models\PostLang;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function data(){

        $categories = Category::with(['admin', 'translation' => function($q){
                $q->locale();
            }])->whereType(\request()->type)
            ->when(\request()->user,function ($q, $user){
                return $q->whereUserId($user);
            })
            ->when(request()->search, function ($q, $keyword){
                return $q->with('translation',function ($q) use ($keyword){
                    return $q->where('id', $keyword)->orWhere('name', 'like', '%'.$keyword.'%')->orWhere('slug', 'like', '%'.$keyword.'%');
                });
            })
            ->when(request()->status, function ($q, $status){
                return $q->where('status', $status);
            })
            ->when(request()->public, function ($q, $public){
                return $q->wherePublic($public);
            });

        return datatables()->of($categories)
            ->editColumn('name', function ($category){
                return $category->translation->name;
            })
            ->editColumn('created_at', function ($category){
                return $category->created_at->diffForHumans();
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTranslationRequest $request)
    {
        $category =  new Category();
        $category->forceFill($request->data);
        $category->save();

        $category->translations()->createMany($request->translation);

        return flash('Thêm mới thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //translations
        foreach ($request->translation as $translation):
            //check slug
            if(Translation::whereSlug($translation['slug'])->where('post_id','!=', $category->id)->count())
                return  flash('Đường dẫn đã tồn tại',0);

            $category->translation()->updateOrCreate(['locale' => $translation['locale']], $translation);
        endforeach;

        $category->forceFill($request->data);
        $category->admin_edit = Auth::id();
        $category->save();

        return flash('Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Category $category)
    {
        $category->delete();

        return flash('Xóa danh mục thành công!');
    }
}
