<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Keluarga;
use App\Providers\RouteServiceProvider;
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

    public function checkLogin(Request $request){

        $isKeluarga = Keluarga::where('kontak','=',$request->uname)->count();
        
        if ($isKeluarga>0) {
           return $this->keluargaLogin($request);
        }else{
            return back()->with(["error" => "Akun tidak ditemukan"]);
        }


    }


    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ],
            $request->get('remember')
        )) {
            return redirect()->intended('/admin');
        } else {
            return redirect('login/admin')->withErrors([
                'error' => 'Username Atau Password Salah'
            ]);
        }
        
        return back()->withInput($request->only('email', 'remember'));
    }

    public function keluargaLogin(Request $request)
    {
        $this->validate($request, [
            'uname'   => 'required|numeric',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('keluarga')->attempt(
            [
                'kontak' => $request->uname,
                'password' => $request->password
            ],
            $request->get('remember')
        )) {
            return redirect()->intended('/keluarga')->with(["success" => "Login Berhasil"]);
        } else {
            return redirect('/login')->withErrors([
                'error' => 'Username Atau Password Salah'
            ]);
        }
        
        return redirect('/login')->withInput($request->only('uname', 'password'));
    }
 
}
