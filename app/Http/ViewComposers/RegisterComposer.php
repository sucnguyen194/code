<?php
namespace App\Http\ViewComposers;

use App\Enums\MenuPosition;
use App\Enums\PostType;
use App\Enums\SupportType;
use App\Enums\TakeItem;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Product;
use App\Models\Support;
use Illuminate\View\View;

class RegisterComposer
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
       $data['customers'] = Support::ofType(SupportType::customer)->get();

        $view->with($data);
    }
}
