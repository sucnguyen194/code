<?php

namespace App\Http\Controllers;

use App\Enums\CategoryType;
use App\Enums\Position;
use App\Enums\PostType;
use App\Enums\TakeItem;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Product;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('layouts.home');
    }

    public function maintenance(Request $request){
        $request->validate([
            'password' => 'required',
        ]);

        if($request->password != setting('site.password'))
            return flash(__('_password_wrong'), 0);

        session()->put('site.password', setting('site.password'));

        return flash(__('_login_success'),1, session('url'));
    }


    public function translation($slug)
    {
        $translation = Translation::ofSlug($slug)->first();

        if(!$translation || !$translation->item)
            return  redirect()->route('home');

        if($translation->locale != session('lang')){
            $translation = $translation->item->translation;
            App::setLocale($translation->locale);
            session()->put('lang', $translation->locale);
            return  redirect()->route('slug', $translation->slug);
        }

        switch (true) {
            case ($translation->post):

                $this->setView($translation->post);
                $post = $translation->post;

                $related = Post::ofRelated($post)->get();

                return view($post->views, compact('post', 'related'));

                break;

            case ($translation->product):
                $this->setView($translation->product);
                $product = $translation->product;

                $related = Product::ofRelated($product)->get();;

                return view('product.show', compact('product', 'related'));

            case ($translation->category):

                $category = $translation->category;

                switch ($category->type) {
                    case (CategoryType::product):
                        $products = Product::ofCategory($category)->paginate(setting('site.product.category', 12));

                        return view('product.category', compact('category','products'));
                        break;
                    case (CategoryType::post):
                        $posts = Post::ofCategory($category)->paginate(setting('site.post.category',  12));

                        return view('post.category', compact('category','posts'));
                        break;
                }
                break;
        }
    }

//    public function author($id){
//        $author = Admin::find($id);
//
//            if(!$author)
//                return redirect()->back()->withInput();
//
//        $posts = auth()->post->latest()->paginate(setting('site.post.category', 12));
//
//        return view('post.author',compact('posts','author'));
//    }

    public function setView($translation){

        if(session('view') === $translation->id)
            return;

            $translation->increment('view');
            $translation->save();
            session()->put('view', $translation->id);
    }
}
