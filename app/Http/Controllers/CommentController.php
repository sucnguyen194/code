<?php

namespace App\Http\Controllers;

use App\Enums\ActiveDisable;
use App\Models\Alias;
use App\Models\Comment;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Validator::make($request->data,[
            'comment' => 'required',
            'name' => 'required',
            'email' => 'email|required',
        ]);

        $translation = Translation::whereSlug($request->slug)->first();
        if(!$translation)
            return flash(__('_error'),0);

            $comment = new Comment();
            $comment->forceFill($request->data);
            $comment->comment()->associate($translation->item);
            $comment->save();

           session()->put('name', $request->input('data.name'));
           session()->put('email', $request->input('data.email'));
           session()->put('website', $request->input('data.url'));

           return flash(__('client.thank_comment'), 1, route('slug', $request->slug));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
