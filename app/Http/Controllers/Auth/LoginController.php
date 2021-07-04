<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $this->middleware('guest')->except('logout');
    }

    // Overide the email login to username
    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt(array($fieldType => $input['username'], 'password' => $input['password'], 'active_account' => 1), $request->filled('remember'))) {
            // After login update user last login
            $user_id = auth()->user()->id;
            User::where('id', $user_id)->update([
                'last_login_at' => Carbon::now()->toDateTimeString()
            ]);
            return redirect('/');
        } else {
            return redirect()->route('login')
                ->with('error', 'Incorrect Email Address or Password. <br/> Please check your account is active.');
        }
    }
}
