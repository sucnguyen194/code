<?php

namespace App\Http\Controllers\Auth;

use App\Enums\SocialiteProvider;
use App\Http\Controllers\Controller;
use App\Models\SocialIdentity;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\FacebookProvider;
use Laravel\Socialite\Two\GoogleProvider;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        if( ($provider === SocialiteProvider::google && !setting('api.login_google'))
            || ($provider === SocialiteProvider::facebook && !setting('api.login_facebook'))
            || ! $this->isProviderAllowed($provider) )

            return  flash("{$provider} is not currently supported", 0);

        try {
            return $this->getProvider($provider)->redirect();
        } catch (\Exception $e) {
            return  flash($e->getMessage(), 0);
        }
    }

    public function callback($provider)
    {
        try {
            $info = $this->getProvider($provider)->user();
        } catch (\Exception $e) {
            return  flash($e->getMessage(), 0);
        }

        $user = $this->createUser($info,$provider);
        Auth::login($user, true);

        return flash(__('_login_success'),1, route('home'));
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
                $user->forceFill(
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

    public function isProviderAllowed($provider)
    {
        return in_array($provider, SocialiteProvider::getValues());
    }

    public function getProvider($driver){

        if($driver == SocialiteProvider::facebook){
            $config = [
                'client_id' => setting('api.facebook_app_id'),
                'client_secret' => setting('api.facebook_app_secret'),
                'redirect' =>  route('login.social.callback',SocialiteProvider::facebook)
            ];
            $provider = Socialite::buildProvider(
                FacebookProvider::class, $config
            );
        }else if($driver == SocialiteProvider::google){
            $config = [
                'client_id' => setting('api.google_app_id'),
                'client_secret' => setting('api.google_app_secret'),
                'redirect' =>  route('login.social.callback',SocialiteProvider::google)
            ];
            $provider = Socialite::buildProvider(
                GoogleProvider::class, $config
            );

        }
        return $provider;
    }
}
