<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        
        return view('loginView');
    }

    public function authenticate(Request $request){

        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ],[
            'name.required' => 'Silahkan Masukkan Username Anda!',
            'password.required' => 'Silahkan Masukkan Password Anda!',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/masteriks')->with('massage', 'Anda Berhasil Login');
        }

        return back()->with('loginError', 'Login Gagal');
    }

    public function logout(Request $request){

        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect('login')->with('massage', 'Berhasil Logout');
    }
}
