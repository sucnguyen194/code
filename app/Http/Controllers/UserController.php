<?php namespace App\Http\Controllers;
use App\Enums\LeverUser;
use App\Models\SiteSetting;
use App\Models\SocialIdentity;
use App\Models\User;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Psy\Util\Str;
use Session,Schema,DB,Artisan,Mail;
use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserController extends Controller {

	public function profile(){
	    if(Auth::check())
            return view('User.profile');

        return flash(__('client.please_login'),3,route('home'));
	}
	public function update(Request $request){

//		$password = $request->password;
//		$re_password = $request->re_password;

		$email = $request->input('data.email');
		if($email){

		    $user = auth()->user();

			if(User::where('email',$email)->whereNotIn('id',[$user->id])->count())
                return flash(__('client.email_already_exists'),3);

			$user->forceFill($request->data);
			$user->save();


//				if($password == NULL && $re_password== NULL){
//					$password = $user->password;
//					$re_password = $user->password;
//				}else{
//					$password = bcrypt($request->password);
//					$re_password = bcrypt($request->re_password);
//				}

//				if($password != $re_password){
//                    return flash('Mật khẩu không khớp',3);
//				}else{
//
//				$user->update([
//                    'password' => $password,
//                    'name' => $name,
//                    'address' => $address,
//                    'phone' => $phone,
//                    'email' => $email,
//                ]);
//
//			}
            return flash(__('lang.flash_update'));
			}
	}

	public function password(){
        $user = auth()->user();
        return view('user.password', compact('user'));
    }

    public function updatePassword(Request  $request){
        $request->validate([
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = auth()->user();
        if ($user->password && !Hash::check($request->old_password, $user->password)){
            return flash('Mật khẩu hiện tại không đúng', 0);
        }

        $user->password = Hash::make($request->password);

        $user->save();

        return flash('Đổi mật khẩu thành công');
    }
}
