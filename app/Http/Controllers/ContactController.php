<?php namespace App\Http\Controllers;

use App\Jobs\MailContact;
use App\Models\Contact;
use App\Rules\ValidRecapcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;

class ContactController extends Controller {

	public function index(){
		return view('Contact.index');
	}
	public function store(Request $request){

	    $rules = [];

	    if($request->has('data.email')){
	        $rules['data.email'] = ['required','email'];
        }

	    if($request->has('data.name')){
	        $rules['data.name'] = 'required';
        }

        if($request->has('data.phone')){
            $rules['data.phone'] = 'required';
        }

        if(setting()->re_captcha_key){
            $rules['g-recaptcha-response'] = ['required', new  ValidRecapcha()];
        }

        Validator::make($request->all(), $rules)->validate();

        $contact = new Contact();
	    $contact->forceFill($request->data);
	    $contact->save();

        if(setting('contact.email'))
	    MailContact::dispatch($request->data)->onQueue('default');

        return flash('Gửi thông tin thành công', 1);
	}

}
