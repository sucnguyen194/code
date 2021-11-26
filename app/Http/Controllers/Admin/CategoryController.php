<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTranslationRequest;
use App\Models\Category;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                $q->select('id','name','slug','category_id');
            }])->whereType(\request()->type)
            ->when(\request()->author,function ($q, $author){
                return $q->whereAdminId($author);
            })
            ->when(request()->search, function ($q, $keyword){
                return $q->whereHas('translation',function ($q) use ($keyword){
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
                return $category->name;
            })
            ->editColumn('slug', function ($category){
                return $category->slug;
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
        $categories = Category::ofType(request()->type)->get();

        return view('admin.category.create', compact('categories'));
    }

    public function add(StoreTranslationRequest $request){
        $category =  new Category();
        $category->forceFill($request->data);
        $category->save();

        $category->translations()->createMany($request->translation);

        $category->load(['translation' => function($q){
            $q->select('id','category_id','name');
        }]);

        return  response()->json($category);
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

        return flash(__('lang.flash_create'));
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
        $category->forceFill($request->data);
        $category->admin_edit = Auth::id();
        $category->save();

        //translations
        foreach ($request->translation as $translation):
            $category->translations()->updateOrCreate(['locale' => $translation['locale']], $translation);
        endforeach;

        return flash(__('lang.flash_update'));
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

        return flash(__('lang.flash_destroy'));
    }
}
