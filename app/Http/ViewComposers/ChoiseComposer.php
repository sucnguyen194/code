<?php
namespace App\Http\ViewComposers;

use App\Enums\PostType;
use App\Enums\SupportType;
use App\Models\Post;
use App\Models\Support;
use Illuminate\View\View;

class ChoiseComposer
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

        $data['pages']  = Post::ofType(PostType::page)->status()->get();

        $view->with($data);
    }
}
