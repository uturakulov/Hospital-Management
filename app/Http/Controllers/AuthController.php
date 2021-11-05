<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function signin(Request $request)
    {
        validator($request->all(), [
            'email' => ['required', 'email'],
            'password' => 'required'
        ])->validate();

        if (isset($request->doctor)) {
            if (auth()->guard('doctor')->attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])) {
                return redirect()->route('doctor-home');
            }
        } else {
            if (auth()->guard('web')->attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])) {
                return redirect()->route('patient-home');
            }
        }

        return redirect()->back()->withErrors(['email' => 'Invalid Credentials']);
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/login');
    }

    public function adminLogin()
    {
        return view('admin.login');
    }

    public function adminSignin(Request $request)
    {
        validator($request->all(), [
            'email' => ['required', 'email'],
            'password' => 'required'
        ])->validate();

        if (auth()->guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return redirect()->route('admin-home')->with('message', 'Welcome ' . auth()->guard('admin')->user()->fullname);
        }

        return redirect()->back()->withErrors(['email' => 'Invalid Credentials']);
    }
}
