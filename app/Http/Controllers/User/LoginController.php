<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view("auth.login");
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        Log::info('Login success',[
            'email' => $credentials['email'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('products.public')->with('success','Login success!');
        }
        Log::info('Login failed',[
            'email' => $credentials['email'],
        ]);
        return back()->withErrors(['email'=> 'Thông tin đăng nhập không đúng']);

    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function logout(Request $request){
        $user = Auth::user();
        Log::info('Người dùng đã đăng xuất',[
            'user_id' => $user->id,
            'email' => $user ->email,
            'ip_address' => $request -> ip(),
            'time'=> now(),
        ]);
        Auth::logout();
        return redirect("/login");
    }
}
