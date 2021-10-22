<?php namespace App\Http\Controllers;

use App\Models\Translation;
use Illuminate\Http\Request;

class SearchController extends Controller {

    public function search(Request $request){

        $translations = Translation::with(['post' , 'product'])
            ->whereHas('tags',function ($q) use ($request){
                $q->whereSlug($request->key);
            })
            ->where(function($q){
                $q->whereHas('post',function($q){
                    $q->public();
                });
            })
            ->orwhere(function($q){
                $q->whereHas('product',function ($q) {
                    $q->public();
                });
            })
            ->latest('id')
            ->locale()
            ->paginate(20);

        if(!$request->has('key'))
            $translations = collect();

        return view('search.search',compact('translations'));
    }

    public function tag($slug){
        $translations = Translation::with(['post' , 'product'])
            ->whereHas('tags',function ($q) use ($slug){
                $q->whereSlug($slug);
            })
            ->where(function($q){
                $q->whereHas('post',function($q){
                    $q->public();
                });
            })
            ->orwhere(function($q){
                $q->whereHas('product',function ($q) {
                    $q->public();
                });
            })
            ->locale()
            ->latest('id')
            ->paginate(20);

        return view('search.tags',compact('translations','slug'));
    }
}
