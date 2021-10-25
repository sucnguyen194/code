<?php

namespace App\Http\Controllers\Admin;

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
        if(auth()->id() > 1) $this->authorize('contact');

        $admins = Admin::when(auth()->id() > 1, function ($q){
            $q->where('id','>', 1);
        })->get();

        return view('admin.contact.index',compact('admins'));
    }

    public function data(){
        $contacts = Contact::query()->whereRepId(0)
            ->when(request()->status,function($q, $status){
                $q->whereStatus($status);
            })
            ->when(request()->user,function($q, $user){
            $q->whereUserEdit($user);
        });

        return datatables()->of($contacts)
            ->editColumn('note',function ($contact){
                return $contact->note ? str_limit($contact->note,100) : "Khách hàng yêu cầu nhận thông báo";
            })
            ->editColumn('updated_at',function ($contact){
                return $contact->updated_at->diffForHumans();
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
        if(auth()->id() > 1) $this->authorize('contact');

        $replys = Contact::whereRepId($contact->id)->get();

        if($contact->status == 0)
            $contact->update(['status' => 1,'user_edit' => \Auth::id()]);

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
        if(auth()->id() > 1) $this->authorize('contact');

        Validator::make($request->data,[
            'note' => 'required'
        ])->validate();
        $post = new Contact();
        $post->forceFill($request->data);
        $post->user_id = auth()->id();
        $post->rep_id = $contact->id;
        $post->save();

        send_email('reply',$request->data,$contact->email);

        return flash('Gửi phản hồi thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Contact $contact)
    {
        if(auth()->id() > 1) $this->authorize('contact');

        $contact->delete();

        return flash('Xóa thành công');
    }
}
