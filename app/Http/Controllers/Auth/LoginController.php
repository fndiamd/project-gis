<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Hash;

use App\Models\User;

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

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        // Save previous url 
        $previousUrl = session('_previous.url');
        $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        $ref = rtrim($ref, '/');

        if ($previousUrl != url('login')) {
            session(['referer', $ref]);
            if ($previousUrl == $ref) {
                session(['url.intended', $ref]);
            }
        }

        $meta = [
            'title' => 'Masuk',
            'description' => 'Halaman masuk Dashbor ' . config('app.name')
        ];

        return view('auth.login')->with('meta', $meta);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // Getting user data by email address
        $user = User::whereRaw('LOWER(email) = ?', [$request->email])->first();

        // Check email
        if (empty($user)) {
            return redirect()->route('login')
                ->withInput()
                ->withErrors([
                    'email' => 'Alamat surel yang kamu masukkan salah.'
                ]);
        }

        // Check activation
        if (empty($user->email_verified_at)) {
            return redirect()->route('login')
                ->withInput()
                ->with('warningMessage', 'Akun belum teraktivasi, harap konfirmasi email kamu');
        }

        // Check password
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('login')
                ->withInput()
                ->with('dangerMessage', 'Sandi yang kamu masukkan salah');
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->route('dashboard.index');
    }

    public function logout(Request $request)
    {
        // do logout
        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('successMessage', 'Sesi berhasil diakhiri');
    }
}
