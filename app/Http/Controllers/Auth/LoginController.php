<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialIdentity;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
        $this->redirectTo = url()->previous();
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $info = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('home');
        }
//        if(!$info->getEmail())
//            return redirect()->route('user.register')->withErrors(['message' => 'Tài khoản chưa có email. Vui lòng đăng ký tại đây!']);

        $user = $this->createUser($info,$provider);
        Auth::login($user, true);

        return flash('Đăng nhập thành công!',1, route('home'));
    }

    public function createUser($info,$provider){

        $account = SocialIdentity::whereProviderName($provider)
            ->whereProviderId($info->getId())
            ->latest()->first();

        if ($account) {
            return $account->user;
        } else {
            $email = $info->getEmail();
            $user = User::whereEmail($email)->first();
            if(!$user){
                $user = new User();
                $user = $user->forceFill(
                    [
                        'email' => $email,
                        'name' => $info->getName(),
                        'email_verified_at' => now(),
                    ]
                );
                $user->save();
            }
            $user->identities()->updateOrCreate(
                [
                    'provider_id' => $info->getId(),
                    'provider_name' => $provider,
                ]
            );

            return $user;
        }
    }
}
