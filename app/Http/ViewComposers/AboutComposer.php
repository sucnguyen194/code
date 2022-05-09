<?php
namespace App\Http\ViewComposers;

use App\Enums\ActiveDisable;
use App\Enums\SupportType;
use App\Models\Support;
use Illuminate\View\View;

class AboutComposer
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
        $data['supports'] =  Support::ofType(SupportType::support)->get();

        $data['_supports'] =  Support::ofType(SupportType::support)->when(request()->filter,function ($q, $filter){
            $q->whereId($filter);
        })->get();

        $view->with($data);
    }
}
