<?php namespace App\Http\Controllers;

use App\Enums\SystemType;
use App\Models\Product;

class GalleryController extends Controller {

	public function index(){
		$galleries = Product::whereType(SystemType::GALLERY)->public()->langs()->get();

		return view('Gallery.index',compact('galleries'));
	}
}
