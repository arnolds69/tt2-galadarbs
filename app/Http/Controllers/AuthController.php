<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function loginForm() { return view('login'); }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect('/');
        }
        return back()->with('error', 'Wrong username or password.');
    }

    public function registerForm() { return view('register'); }

    public function register(Request $request)
    {
        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => 'user',
        ]);
        return redirect('/login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}