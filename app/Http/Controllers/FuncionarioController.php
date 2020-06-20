<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    private $totalPage = 10;
    public function index()
    {
        return view('rh.funcionario.index');
    }

    public function novo($id=null)
    {
        $funcionario = Funcionario::find($id);
        $cargos = Cargo::pluck('car_nome','car_codigo');
        return view('rh.funcionario.novo',compact('car_codigo','cargos','funcionario'));
    }

    public function store(Request $request, Funcionario $funcionario)
    {

        $funcionario = new Funcionario;
        $funcionario->fun_nome          = $request->fun_nome;
        $funcionario->fun_rg            = $request->fun_rg;
        $funcionario->fun_cpf           = $request->fun_cpf;
        $funcionario->fun_email         = $request->fun_email;
        $funcionario->car_codigo        = $request->car_codigo;
        $funcionario->fun_comissao      = $request->fun_comissao;
        $funcionario->fun_telefone      = $request->fun_telefone;
        $funcionario->fun_data_admissao = $request->fun_data_admissao;
        $funcionario->fun_observacao    = $request->fun_observacao;

        $response = $funcionario->salvar();
        if ($response['success'])
            return redirect()->route('funcionario.novo')->with('success', $response['message']);

        return redirect()->back()->with('error', $response['message']);
    }

    public function todos()
    {
        $funcionarios = Funcionario::all();
        return view('rh.funcionario.index', compact('funcionarios'));
    }

    public function updatePost(Request $request, $id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->fun_nome          = $request->fun_nome;
        $funcionario->fun_rg            = $request->fun_rg;
        $funcionario->fun_cpf           = $request->fun_cpf;
        $funcionario->fun_email         = $request->fun_email;
        $funcionario->car_codigo        = $request->car_codigo;
        $funcionario->fun_comissao      = $request->fun_comissao;
        $funcionario->fun_telefone      = $request->fun_telefone;
        $funcionario->fun_data_admissao = $request->fun_data_admissao;
        $funcionario->fun_observacao    = $request->fun_observacao;
        $response = $funcionario->salvar();
        return redirect()->route('funcionario.todos')->with('success', 'Funcionário Atualizado');
    }
  
    public function delete($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->delete();
        return redirect()->route('funcionario.todos')->with('success','Funcionário deletado');
    }
}
