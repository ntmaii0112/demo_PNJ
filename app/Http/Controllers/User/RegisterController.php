<?php

namespace App\Http\Controllers\User;

use App\Events\UserRegister;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class RegisterController extends Controller
{
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $exists = User::where('email', $email)->exists();

        return response()->json(['exists' => $exists]);
    }
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
            'status' => 1,
            'isConfirmed' => 0,
            'captcha' => '',
        ]);

        $user->roles()->attach(2);
        Auth::login($user);

        if ($user) {
            Log::info("Register success for user: {$user->email}");

            Log::info('Send mail register');
            event(new UserRegister($user));

            return redirect()->route('login')->with('success', 'Register success!');

        } else {
            Log::error("Register failed");
            return back()->with('error', 'Đăng ký thất bại. Vui lòng thử lại!');
        }
    }
}
