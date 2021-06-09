<?php

namespace App\Http\Controllers\Auth\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {
        // $user = Auth::guard('admin')->user();
        return view('auth.admin.home');
    }

    public function login(Request $request)
    {
        if ($request->getMethod() == 'GET') {

            return view('auth.admin.login');
        }

        $credentials = $request->only(['email', 'password']);
        if (Auth::guard('admin')->attempt($credentials)) {

            return redirect()->route('admin.home');
        } else {

            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {

        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
