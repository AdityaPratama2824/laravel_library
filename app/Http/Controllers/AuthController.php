<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
 public function index()
{
    return view('auth.login');
}

public function register()
{
    return view('auth.register');
}

public function createMember(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6'
    ]);

    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => bcrypt($request->password)
    ]);

    // auto member
    $user->roles()->attach(2);

    return redirect('/login')->with('success', 'Account created');
}

public function login(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt([
        'email' => $request->email,
        'password' => $request->password
    ])) {

        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect('/admin/book');
        }

        return redirect('/');
    }

    return back()->with('error', 'Email atau password salah');
}

public function logout()
{
    Auth::logout();
    return redirect('/login');
}
}