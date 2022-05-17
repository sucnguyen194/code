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
        if(setting('site.maintenance')){
            if(!session()->has('site.password') && setting('site.password')){
                session()->put('url', request()->url());
                return view('errors.lock');
            }
        }

       $data['sliders'] = Photo::ofPosition(Position::Slider)->get();
       $data['partners'] = Photo::ofPosition(Position::Partner)->get();
       $data['idols'] = Photo::ofPosition(Position::Idol)->get();
//       $data['posts']  = Post::ofType(PostType::post)->with(['categories','admin','category'])->withCount('comments')->ofTake(TakeItem::index)->status()->get();

       $data['categoris'] = Category::with(['posts' => function($q){
           $q->sort();
       }])->ofType(CategoryType::post)->status()->get();

       $data['fixed'] = true;

        return view('layouts.home', $data);
    }

    public function maintenance(Request $request){
        $request->validate([
            'password' => 'required',
        ]);

        if($request->password != setting('site.password'))
            return flash(__('client.password_wrong'), 0);

        session()->put('site.password', setting('site.password'));

        return flash(__('client.login_success'),1, session('url'));
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
                $post = $translation->post;

                $related = Post::with(['categories','admin'])
                    ->where('id','!=', $post->id)
                    ->ofCategory(optional($post->category)->id)
                    ->ofTake(TakeItem::replated)->get();

                return view($post->views, compact('post', 'related'));

                break;

            case ($translation->product):
                $this->setView($translation->product);
                $product = $translation->product;

                $related = Product::with(['categories' ,'admin','translation'])
                    ->where('id','!=', $product->id)
                    ->ofCategory(optional($product->category)->id)
                    ->ofTake(TakeItem::replated)->get();

                return view('product.show', compact('product', 'related'));

            case ($translation->category):

                $category = $translation->category;

                switch ($category->type) {
                    case (CategoryType::product):
                        $products = Product::with(['category','admin'])
                            ->when(request()->filters, function ($q){
                                $q->whereHas('filters', function ($q) {
                                    $q->whereHas('translation', function($q) {
                                        $q->whereIn('name', collect(\request()->filters));
                                    });
                                });
                            })
                            ->ofTranslation()
                            ->ofCategory($category->id)
                            ->paginate(setting('site.product.category', 12));

                        return view('product.category', compact('category','products'));
                        break;
                    case (CategoryType::post):
                        $posts = Post::with(['category','admin'])
                            ->ofType(PostType::post)
                            ->ofCategory($category->id)
                            ->paginate(setting('site.post.category',  12));

                        return view('post.category', compact('category','posts'));
                        break;
                }
                break;
        }
    }

    public function author($id){
        $author = Admin::find($id);

            if(!$author)
                return redirect()->back()->withInput();

        $posts = auth()->post->latest()->paginate(setting('site.post.category', 12));

        return view('post.author',compact('posts','author'));
    }

    public function setView($translation){

        if(session('view') === $translation->id)
            return;

            $translation->increment('view');
            $translation->save();
            session()->put('view', $translation->id);
    }
}
