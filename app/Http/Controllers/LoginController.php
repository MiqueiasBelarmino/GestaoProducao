<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function logar(Request $request)
    {
        $fun_email = null;
        $fun_senha = null;
        $fun_email = DB::table('funcionarios')->where('fun_email', $request->fun_email)->value('fun_email');
        if($fun_email != null)
        {
            $fun_senha = DB::table('funcionarios')->where('fun_email', $request->fun_email)->value('fun_senha');
        }
        if($fun_email == null)
        {
            return back()->withErrors(['email'=>trans('E-mail inválido')]);
        }
        else if($fun_senha == null)
        {
            return back()->withErrors(['password'=>trans('Senha inválida')]);
        }
        else
        {
            if (Hash::check($request->fun_senha, $fun_senha)) {
                return view('admin.home.index');
            }else
            {
                return 'Credenciais inválidas';
            }
        }
    }

    public function logout()
    {
        return 'logout';
    }
}
