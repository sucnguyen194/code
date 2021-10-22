<?php

namespace App\Http\Controllers;

use App\Enums\CategoryType;
use App\Enums\PostType;
use App\Enums\ProductType;
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
        if(setting('site.maintenance')){
            if(!session()->has('site.password') && setting('site.password')){
                session()->put('url', request()->url());
                return view('errors.lock');
            }
        }

        return view('layouts.home');
    }

    public function maintenance(Request $request){
        $request->validate([
            'password' => 'required',
        ]);

        if($request->password != setting('site.password'))
            return flash('Mật khẩu không chính xác!', 0);

        session()->put('site.password', setting('site.password'));

        return flash('Đăng nhập thành công!',1, session('url'));
    }


    public function translation($slug)
    {
        $translation = Translation::whereSlug($slug)->firstOrFail();

        if(setting('site.maintenance')){
            if(!session()->has('site.password') && setting('site.password')){
                session()->put('url', request()->url());
                return view('errors.lock');
            }
        }

        if($translation->locale != session('lang')){
            App::setLocale($translation->locale);
            session()->put('lang', $translation->lang);
        }

        switch (true) {
            case ($translation->post):
                $this->setView($translation->post);

                switch ($translation->post->type) {
                    case (PostType::post):
                        return view('post.show', compact('translation'));
                        break;

                    default;
                        return view('post.page', compact('translation'));
                }
                break;

            case ($translation->product):
                $this->setView($translation->product);

                switch ($translation->product->type) {
                    case (ProductType::product):
                        return view('product.show', compact('translation'));
                        break;
                    case (ProductType::video):
                        return view('video.show', compact('translation'));
                        break;
                    default:
                        return view('gallery.show', compact('translation'));
                        break;
                }
                break;
            case ($translation->category):

                switch ($translation->category->type) {
                    case (CategoryType::product):

                        $products = Product::with(['category','admin','categories'])->orwhereHas('categories',function($q) use ($translation) {
                            $q->where('category_id',$translation->category->id);
                        })->orWhere('category_id',$translation->category->id)
                            ->public()->withTranslation()->paginate(12);

                        return view('product.category', compact('translation','products'));
                        break;
                    case (CategoryType::post):

                        $posts = Post::with(['category','admin','categories'])->orwhereHas('categories',function($q) use ($translation) {
                            $q->where('category_id',$translation->category->id);
                        })->orWhere('category_id',$translation->category->id)
                        ->public()->withTranslation()->paginate(12);

                        return view('post.category', compact('translation','posts'));
                        break;
                }
                break;
        }
    }

    public function setView($translation){

        if(session('view') != $translation->id)
            return;

            $translation->view = $translation->view + 1;
            $translation->timestamps = false;
            $translation->save();

            session()->put('view', $translation->id);
    }
}
