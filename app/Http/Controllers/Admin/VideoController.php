<?php namespace App\Http\Controllers\Admin;

use App\Enums\CategoryType;
use App\Enums\SystemType;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Lang;
use App\Models\Product;
use App\Models\User;
use Session;

class VideoController extends Controller {

	public function index(){

	    $this->authorize('video.view');

        $admins = Admin::when(auth()->id() > 1, function ($q){
            $q->where('id','>', 1);
        })->get();

        return view('admin.video.index',compact('admins'));
	}

	public function create(){
        $this->authorize('video.create');

        return view('admin.video.create');
    }

	public function edit(Product $video){
      $this->authorize('video.edit');

        $translations = $video->translations->load('language');


        return view('admin.video.edit', compact('video','translations'));
    }
}
