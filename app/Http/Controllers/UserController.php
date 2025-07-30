<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ThongtincanhanModel;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // giao dien

    // Backend------------
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->permission === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            return redirect()->intended('/user/dashboard');
        }
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->onlyInput('email');
    }
    //------------

}
