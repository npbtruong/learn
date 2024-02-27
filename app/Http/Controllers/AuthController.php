<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login_admin()
    {
        
        return view('admin.auth.login');
    }
    public function auth_login_admin(Request $request)
    {
        dd($request->all());
    }
}
