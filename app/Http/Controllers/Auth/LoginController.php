<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // dd('www');
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'User Login Successfully.');

        }
        return redirect()->back()->with('error', 'Credencial Not Match');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
