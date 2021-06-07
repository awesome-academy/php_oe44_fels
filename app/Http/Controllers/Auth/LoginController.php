<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{

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
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $request->session()->flash('email');
        Validator::make($request->all(), app(LoginRequest::class)->rules());

        $email = trim($request->email);
        $password = trim($request->password);

        $user = User::where('email', $email)->first();
       
        if ($user) {
            if (Hash::check($password, $user->password)) {
                Auth::login($user);

                return redirect()->route('home');
            } else {
                $request->session()->flash('statusPassword', trans('PasswordMis'));
            }
        } else {
            $request->session()->flash('statusEmail', trans('EmailMis'));
        }
        return view('auth.login');
    }
    
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $this->_resgisterOrLogin($user);

        return redirect()->route('home');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $this->_resgisterOrLogin($user);

        // Return home after login
        return redirect()->route('home');
    }

    protected function _resgisterOrLogin($data){

        $user = User::where('email', '=', $data->email)->first();
        if(!$user){
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->avatar = $data->avatar;
            $user->save();
        }

        Auth::login($user);
    }

}
