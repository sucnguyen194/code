<?php
namespace App\Http\ViewComposers;

use App\Enums\SupportType;
use App\Models\Support;
use Illuminate\View\View;

class QuessionComposer
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

        $data['quessions'] = Support::ofType(SupportType::quession)->get();

        $view->with($data);
    }
}
