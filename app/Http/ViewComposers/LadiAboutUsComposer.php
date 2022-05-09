<?php
namespace App\Http\ViewComposers;

use App\Enums\Position;
use App\Enums\PostType;
use App\Enums\TakeItem;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\View\View;

class LadiAboutUsComposer
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
        $data['idols'] = Photo::ofPosition(Position::Idol)->get();
        $data['posts']  = Post::ofType(PostType::post)->with(['categories','admin','category'])->withCount('comments')->ofTake(TakeItem::index)->status()->get();

        $view->with($data);
    }
}
