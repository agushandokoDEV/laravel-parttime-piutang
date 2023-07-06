<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function  login(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users',
            //'password' => 'required|min:8'
        ],[
            'email.required' => 'Silahkan masukan Email yang terdafatar.',
            'email.exists' => 'Email tidak terdafatar.',
            'password.required' => 'Silahkan masukan Password.',
            'password.min' => 'Password minimal 8 huruf atau angka.',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('/nasabah/home');
            }
        }
        return back()->with(['err' => 'Akun tidak terdaftar !']);
    }
    
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/')->with(['suc' => 'Berhasil keluar !']);
    }
}
