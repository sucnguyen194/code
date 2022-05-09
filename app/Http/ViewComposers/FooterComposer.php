<?php
namespace App\Http\ViewComposers;

use App\Enums\MenuPosition;
use App\Enums\Position;
use App\Models\Menu;
use App\Models\Photo;
use Illuminate\View\View;

class FooterComposer
{
   // public $position;
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
     // $this->position = $position;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $data['menus'] =  Menu::ofPosition(MenuPosition::bottom)->get();

        $data['logo'] = Photo::ofPosition(Position::Logo)->oldest('sort')->first();

        $view->with($data);
    }
}
