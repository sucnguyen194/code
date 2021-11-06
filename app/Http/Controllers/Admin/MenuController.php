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
        $this->authorize('menu.view');

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
        $this->authorize('menu.create');

        $menus = Menu::query()->with('translation', function ($q) { $q->select('name','slug','menu_id');})->whereHas('translation')->position()->sort()->get();

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
        $this->authorize('menu.create');

        $menu = new Menu();
        $menu->forceFill($request->data);
        $menu->save();
        $menu->update(['sort' => $menu->id]);
        $menu->translations()->createMany($request->translation);

        session()->put('menu_position', $menu->position);

        $menus = Menu::query()->select('id','parent_id')->with('translation', function($q){
            $q->select('name','slug','menu_id');
        })->position()->sort()->get();

        return  $this->menu($menus);
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
        $this->authorize('menu.edit');

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
        $this->authorize('menu.edit');

        $menu->forceFill($request->data);
        $menu->save();

        //translations
        foreach ($request->translation as $translation):
            $menu->translations()->updateOrCreate(['locale' => $translation['locale']], $translation);
        endforeach;

        session()->put('menu_position', $menu->position);

        $menus = Menu::query()->select('id','parent_id')->with('translation', function($q){
            $q->select('name','slug','menu_id');
        })->position()->sort()->get();

        return  $this->menu($menus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $this->authorize('menu.destroy');

        $menu->delete();

        $menus = Menu::query()->select('id','parent_id')->with('translation', function($q){
            $q->select('name','slug','menu_id');
        })->position()->sort()->get();

        return  $this->menu($menus);
    }

    public function position(Request $request){
        $this->authorize('menu.view');

        session()->put('menu_position',$request->position);

        $menus = Menu::query()->select('id','parent_id')->with('translation', function($q){
            $q->select('name','slug','menu_id');
        })->position()->sort()->get();

        return  $this->menu($menus);
        //return flash('Cập nhật thành công');

    }
    public function append(Request $request){
       $this->authorize('menu.create');

        $menu = new Menu();
        $menu->position  = session()->get('menu_position');
        $menu->save();
        $menu->update(['sort' => $menu->id]);

        if($request->type == CategoryType::category)
            $transltions = Category::find($request->id);

        if($request->type == PostType::page)
            $transltions = Post::find($request->id);

        foreach ($transltions->translations as $translation){
            $menu->translation()->create(['name' => $translation->name, 'slug' => $translation->slug,'locale' => $translation->locale]);
        }

        $append = '<li class="dd-item" data-id="'.$menu->id.'">';
        $append .= '<div class="dd-handle">'.optional($menu->translation)->name.'</div>';
        $append .= '<div class="menu_action">';
        if(auth()->user()->can('menu.edit'))
        $append .= '<a href="'.route('admin.menus.edit',$menu).'" title="Sửa" class="ajax-modal btn btn-primary waves-effect waves-light"><i class="fe-edit-2"></i></a> ';
        if(auth()->user()->can('menu.destroy'))
        $append .= '<a href="'.route('admin.menus.destroy',$menu).'" title="Xóa" class="ajax-link-menu btn btn-warning waves-effect waves-light" data-confirm="Xoá bản ghi?" data-refresh="true" data-method="DELETE"><i class="fe-x"></i> </a> ';
        $append .= '</div>';

        return $append;
    }

    public function setMenuSort(){

        $this->authorize('menu.edit');

        $menus = request()->val;
        $menus = json_decode($menus);
        $this->updateMenuSort($menus);
    }

    public function updateMenuSort($menus, $parent_id=0){
        $this->authorize('menu.edit');
        foreach($menus as $key => $items){
            $update = Menu::find($items->id);
            $update->update(['sort' => $key,'parent_id' => $parent_id]);

            if(isset($items->children)){
                $this->updateMenuSort($items->children,$items->id);
            }
        }
    }

    public function menu($menus){
        $html = "";
        foreach($menus->where('parent_id',0) as $items){
            $html .= '<li class="dd-item" data-id="'.$items->id.'">';
            $html .= '<div class="dd-handle">'.$items->translation->name.'</div>';
            $html .= '<div class="menu_action">';
            if(auth()->user()->can('menu.edit'))
            $html .= '<a href="'.route('admin.menus.edit',$items).'" title="Sửa" class="ajax-modal btn btn-primary waves-effect waves-light ajax-modal"><i class="fe-edit-2"></i></a> ';
            if(auth()->user()->can('menu.destroy'))
            $html .= '<a href="'.route('admin.menus.destroy',$items).'" title="Xóa" class="ajax-link-menu btn btn-warning waves-effect waves-light" data-confirm="Xoá bản ghi?" data-refresh="true" data-method="DELETE"><i class="fe-x"></i> </a> ';
            $html .= '</div>';

            $html .= '<ol class="dd-list">';
            $html .=  static::sub($menus,$items->id);;
            $html .= '</ol>';
            $html .= '</li>';
        }
        return $html;
    }

    public static function sub($data,$parent_id){
        $html = "";
        foreach($data->where('parent_id', $parent_id) as $items){
            $html .= '<li class="dd-item" data-id="'.$items->id.'">';
            $html .= '<div class="dd-handle">'.$items->translation->name.'</div>';
            $html .= '<div class="menu_action">';
            if(auth()->user()->can('menu.edit'))
            $html .= '<a href="'.route('admin.menus.edit',$items).'" title="Sửa" class="ajax-modal btn btn-primary waves-effect waves-light ajax-modal"><i class="fe-edit-2"></i></a> ';
            if(auth()->user()->can('menu.destroy'))
            $html .= '<a href="'.route('admin.menus.destroy',$items).'" title="Xóa" class="ajax-link-menu btn btn-warning waves-effect waves-light" data-confirm="Xoá bản ghi?" data-refresh="true" data-method="DELETE"><i class="fe-x"></i> </a> ';
            $html .= '</div>';

            $html .= '<ol class="dd-list">';
            $html .= static::sub($data,$items->id);;
            $html .= '</ol>';
            $html .= '</li>';
        }
        return $html;
    }
}
