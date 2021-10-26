<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CategoryType;
use App\Enums\PostType;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Post;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function __construct()
    {
        if(!session()->has('menu_position')){
            session()->put('menu_position','top');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('menu');

        $menus = Menu::query()->select('id','parent_id')->with('translation', function($q){
            $q->select('name','slug','menu_id');
        })->position()->sort()->get();

        return view('admin.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('menu');

        $menus = Menu::query()->with('translation', function ($q) { $q->select('name','slug','menu_id');})->position()->sort()->get();

        return view('admin.menu.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('menu');

        $menu = new Menu();
        $menu->forceFill($request->data);
        $menu->save();
        $menu->update(['sort' => $menu->id]);
        $menu->translations()->createMany($request->translation);

        session()->put('menu_position', $menu->position);

        return  flash('Thêm mới thành công!', 1, route('admin.menus.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return  abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $this->authorize('menu');

        $menus = Menu::query()->with('translation', function ($q) { $q->select('name','slug','menu_id');})
            ->where('id','!=', $menu->id)->position()->sort()->get();
        $translations = $menu->translations->load('language');

        return view('admin.menu.edit', compact('menus','menu','translations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $this->authorize('menu');

        $menu->forceFill($request->data);
        $menu->save();

        //translations
        foreach ($request->translation as $translation):
            $menu->translation()->updateOrCreate(['locale' => $translation['locale']], $translation);
        endforeach;

        session()->put('menu_position', $menu->position);

        return flash('Cập nhật thành công', 1, route('admin.menus.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $this->authorize('menu');

        $menu->delete();

        return flash('Xóa bản ghi thành công', 1, route('admin.menus.index'));
    }

    public function position(Request $request){
        $this->authorize('menu');

        session()->put('menu_position',$request->position);
        return flash('Cập nhật thành công');

    }
    public function append(Request $request){
       $this->authorize('menu');

        $menu = new Menu();
        $menu->position  = session()->get('menu_position');
        $menu->save();
        $menu->update(['sort' => $menu->id]);

        if($request->type == CategoryType::category)
            $transltions = Category::find($request->id);

        if($request->type == PostType::page)
            $transltions = Post::find($request->id);

        foreach ($transltions->translations as $transltion){
            $menu->translation()->create(['name' => $transltion->name, 'slug' => $transltion->slug,'locale' => $transltion->locale]);
        }

        $append = '<li class="dd-item" data-id="'.$menu->id.'">';
        $append .= '<div class="dd-handle">'.optional($menu->translation)->name.'</div>';
        $append .= '<div class="menu_action">';
        $append .= '<a href="'.route('admin.menus.edit',$menu).'" title="Sửa" class="ajax-modal btn btn-primary waves-effect waves-light"><i class="fe-edit-2"></i></a> ';
        $append .= '<a href="'.route('admin.menus.destroy',$menu).'" title="Xóa" class="ajax-link btn btn-warning waves-effect waves-light" data-confirm="Xoá bản ghi?" data-refresh="true" data-method="DELETE"><i class="fe-x"></i> </a> ';
        $append .= '</div>';

        echo $append;
    }
}
