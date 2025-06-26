<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Create token for API usage
            $token = $user->createToken('api-token')->plainTextToken;

            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Authenticated',
                    'token' => $token,
                    'user' => $user,
                ]);
            }

            switch($user->role) {
                case 'pasien':
                    return redirect()->intended('/pasien/dashboard')->with('login_success', true);
                case 'admin':
                    return redirect()->intended('/admin/dashboard')->with('login_success', true);
                case 'klinik':
                    return redirect()->intended('/klinik/dashboard')->with('login_success', true);
                case 'dokter':
                    return redirect()->intended('/dokter/dashboard')->with('login_success', true);
                case 'stafrekammedis':
                    return redirect()->intended('/stafrekammedis/dashboard')->with('login_success', true);
                default:
                    return redirect()->intended('/');
            }
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'The provided credentials do not match our records.',
            ], 401);
        }

        return back()->with('error', 'Username atau password salah!');

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    
}
