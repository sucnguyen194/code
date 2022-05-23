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
        return view('user.profile');
	}

	public function update(Request $request){

        $user = auth()->user();

        $request->validate([
           'email' => 'required|unique:users,email,'.$user->id
        ]);

        $user->forceFill($request->data);
        $user->save();

        return flash(__('_the_record_is_updated_successfully'));
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
