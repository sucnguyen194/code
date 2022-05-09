<?php
namespace App\Http\ViewComposers;

use App\Enums\ActiveDisable;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Language;
use Illuminate\View\View;

class LayoutComposer
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
        $data['contacts'] = Contact::whereRepId(0)->oldest('status')->latest()->get();
        $data['comments'] = Comment::whereStatus(ActiveDisable::disable)->get();

        $data['languages'] = session('languages');

        $view->with($data);
    }
}
