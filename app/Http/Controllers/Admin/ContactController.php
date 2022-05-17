<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ActiveDisable;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('contact.view');

        $admins = Controller::getAllAdmins();

        return view('admin.contact.index',compact('admins'));
    }

    public function data(){
        $this->authorize('contact.view');

        $contacts = Contact::query()->whereRepId(0)
            ->when(request()->status,function($q, $status){
                $q->whereStatus($status);
            })
            ->when(request()->admin,function($q, $admin){
            $q->whereAdminEdit($admin);
        });

        return datatables()->of($contacts)
            ->editColumn('note',function ($contact){
                return $contact->note ? str_limit($contact->note,100) : __('_customer_request_to_receive_infomation');
            })
            ->editColumn('updated_at',function ($contact){
                if($contact->updated_at != $contact->created_at)
                    return $contact->updated_at->diffForHumans();

                return;
            })
            ->editColumn('created_at',function ($contact){
                return $contact->created_at->diffForHumans();
            })
            ->order(function ($q){
                $q->orderBy(request()->input('sort','created_at'), request()->input('order','desc'));
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        $this->authorize('contact.edit');

        $replys = Contact::whereRepId($contact->id)->get();

        if($contact->status == ActiveDisable::disable)
            $contact->update(['status' => ActiveDisable::active,'admin_edit' => \Auth::id()]);

        return view('admin.contact.edit',compact('contact','replys'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $this->authorize('contact.update');

        Validator::make($request->data,[
            'note' => 'required'
        ])->validate();
        $post = new Contact();
        $post->forceFill($request->data);
        $post->admin_id = auth()->id();
        $post->rep_id = $contact->id;
        $post->save();

        send_email('reply',$request->data,$contact->email);

        return flash(__('_the_record_is_added_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Contact $contact)
    {
        $this->authorize('contact.destroy');

        $contact->delete();

        return flash(__('_the_record_is_deleted_successfully'));
    }
}
