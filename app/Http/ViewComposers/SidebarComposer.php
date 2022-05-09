<?php
namespace App\Http\ViewComposers;

use App\Enums\CategoryType;
use App\Enums\MenuPosition;
use App\Enums\PostType;
use App\Enums\TakeItem;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\View\View;

class SidebarComposer
{
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $data['categories'] = Category::ofType(CategoryType::post)->get();
        $data['posts'] = Post::ofType(PostType::post)->ofTake(TakeItem::replated)->get();
        $data['tags'] = Tag::whereHas('translation', function ($q){
            $q->groupBy('name');
        })->latest()->get();

        $view->with($data);
    }
}
