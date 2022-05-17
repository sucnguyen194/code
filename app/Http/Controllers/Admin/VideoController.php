<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Post;

class VideoController extends Controller {

	public function index(){

	    $this->authorize('video.view');

        $admins = Controller::getAllAdmins();

        return view('admin.video.index',compact('admins'));
	}

	public function create(){
        $this->authorize('video.create');

        return view('admin.video.create');
    }

	public function edit(Post $video){
      $this->authorize('video.edit');

        $translations = $video->translations->load('language');
        $video = $video->load('translation');

        return view('admin.video.edit', compact('video','translations'));
    }
}
