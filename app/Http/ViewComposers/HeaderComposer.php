<?php
namespace App\Http\ViewComposers;

use App\Enums\MenuPosition;
use App\Models\Menu;
use Illuminate\View\View;

class HeaderComposer
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
        $data['menus'] =  Menu::ofPosition(MenuPosition::top)->get();

        $data['menu_homes'] =  Menu::ofPosition(MenuPosition::home)->get();

        $view->with($data);
    }
}
