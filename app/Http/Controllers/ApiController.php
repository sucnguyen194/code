<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function updateVcb(Request $request){
       $password = $request->password;
       $body = $request->body;

        if(!$password || $password != setting('checkout.password'))
            return response()->json(['error' => 1, 'status' => 'Incorrect password!']);

        if(!$body)
            return response()->json(['error' => 1, 'status' => 'Body not null!']);

        if($request->server('HTTP_USER_AGENT') != setting('checkout.user_agent'))
            return response()->json(['error' => 1, 'status' => 'Fails']);



    }
}
