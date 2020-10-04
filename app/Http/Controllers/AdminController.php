<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('user_code')) {
            return view('admin.home.index');
        }
        
    }
}
