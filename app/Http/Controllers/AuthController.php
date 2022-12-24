<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
        $request->validate([
            'username' => 'required|max:255',
            'password' => 'required'
        ]);

        try {
            $this->validate(
                $request,
                ['username' => 'required|max:255'],
                ['username.required' => 'وارد کردن این فیلد الزامی است']
            );
        } catch (ValidationException $e) {
        }

        if (Auth::attempt(['personal_code' => $request->username, 'password' => $request->password])) {
            return redirect()->route('main');
        } else {
            if (Auth::attempt(['phone' => $request->username, 'password' => $request->password])) {
                return redirect()->route('main');
            }
        }
        return back()->with('fail', 'اطلاعات وارده اشتباه است');
    }

    public function Logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
