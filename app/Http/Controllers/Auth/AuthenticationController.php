<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthenticationController extends Controller
{
    public function showFormLogin()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        // dd($request->all());
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function showFormRegister()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        try {
            // dd($request->all());
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed',
                'phone' => 'required|string|max:11',
                'address' => 'required|string'
            ]);
            $user = User::query()->create($data);
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('home');
        } catch (\Exception $exception) {
            Log::error('Loi dang ky tai khoan' . $exception->getMessage());
            return back();
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
