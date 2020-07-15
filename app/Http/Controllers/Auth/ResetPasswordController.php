<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;
use Validator;
use Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function bukafomreset()
    {
        return view('auth.resetpassword');
    }

    public function simpanresetpasswd(Request $request)
    {
        // dd($request);
        User::where('email', $request['email'])
        ->update(['password' => Hash::make($request['password'])]);
        // return User::update([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);
            return redirect()->route('index');
    }
}
