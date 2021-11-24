<?php

namespace App\Http\Controllers;

use App\Enums\CategoryType;
use App\Enums\PostType;
use App\Enums\ProductType;
use App\Models\Attribute;
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
        if(setting('site.maintenance')){
            if(!session()->has('site.password') && setting('site.password')){
                session()->put('url', request()->url());
                return view('errors.lock');
            }
        }

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
                        return view('product.video.show', compact('translation'));
                        break;
                    default:
                        return view('product.gallery.show', compact('translation'));
                        break;
                }
                break;
            case ($translation->category):

                switch ($translation->category->type) {
                    case (CategoryType::product):

                        $products = Product::with(['category','admin','categories', 'translation'])->whereType(ProductType::product)->where('category_id',$translation->category->id)
                            ->whereHas('translation')->orwhereHas('categories',function($q) use ($translation) {
                            $q->where('category_id',$translation->category->id);
                            })->when(request()->attr, function ($q){
                                $q->whereHas('attributes', function ($q) {
                                    $q->whereHas('translations', function($q) {
                                        $q->whereIn('name', explode(',', request()->attr));
                                    });
                                });
                            })
                            ->public()->latest()->paginate(setting('site.product.category') ?? 20);

                        return view('product.category', compact('translation','products'));
                        break;
                    case (CategoryType::post):

                        $posts = Post::with(['category','admin','categories', 'translation'])->whereType(PostType::post)->whereHas('translation')->where('category_id',$translation->category->id)->orwhereHas('categories',function($q) use ($translation) {
                            $q->where('category_id',$translation->category->id);
                        })                        ->public()->latest()->paginate(setting('site.post.category') ?? 12);

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
