<?php namespace App\Http\Controllers;

use App\Models\Translation;
use Illuminate\Http\Request;

class SearchController extends Controller {

    public function search(Request $request){
        $translations = collect();

        if($request->has('key'))
            $translations = Translation::with(['post' => function($q){
                $q->selectRaw('id,image')->public();
            } , 'product' => function($q){
                $q->public();
            }])->when($request->key, function($q) use ($request){
                $q->where('name','like',"%$request->key%");
            })->latest('id')->paginate(12);

        return view('search.search',compact('translations'));
    }

    public function tag($slug){
        $translations = Translation::with(['post' , 'product'])
            ->where(function($q) use ($slug){
                $q->whereHas('post',function($q) use ($slug){
                    $q->public()->whereHas('tags', function ($q) use ($slug){
                        $q->with('translation', function ($q) use ($slug){
                            $q->whereSlug($slug);
                        });
                    });
                });
            })
            ->orWhere(function($q) use ($slug){
                $q->whereHas('product',function($q) use ($slug){
                    $q->public()->whereHas('tags', function ($q) use ($slug){
                        $q->with('translation', function ($q) use ($slug){
                            $q->whereSlug($slug);
                        });
                    });
                });
            })
            ->locale()
            ->latest('id')
            ->paginate(12);

        return view('search.tags',compact('translations','slug'));
    }
}
