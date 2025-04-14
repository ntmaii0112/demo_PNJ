<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'dob' => $request->dob,
            'role_id' => 2,
            'status' => 1,
            'isConfirmed' => 0,
            'captcha' => '',
        ]);

        if ($user) {
            Log::info("Register success for user: {$user->email}");
            return redirect()->route('login')->with('success', 'Register success!');
        } else {
            Log::error("Register failed");
            return back()->with('error', 'Đăng ký thất bại. Vui lòng thử lại!');
        }
    }
}
