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
            return response()->json(['success' => true]);
        }
        Log::info('Login failed',[
            'email' => $credentials['email'],
        ]);
        return response()->json([
            'success' => false,
            'message' => 'Email hoặc mật khẩu không đúng.'
        ], 401);
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
