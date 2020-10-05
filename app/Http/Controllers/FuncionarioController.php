<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use App\Exports\FuncionarioExport;
use App\Models\Endereco;
use PDF;
use Excel;

class FuncionarioController extends Controller
{
    private $totalPage = 10;
    public function index()
    {
        return view('admin.funcionario.index');
    }
    
    public function novo($id=null)
    {
        $funcionario = Funcionario::find($id);
        $endereco = $roles = Funcionario::find($id)->enderecos()->get();
        //Endereco::where('fun_codigo', $id)->get()->first();
        $cargos = Cargo::pluck('car_nome','car_codigo');
        return view('admin.funcionario.novo',compact('car_codigo','cargos','funcionario','endereco'));
    }

    public function endereco($id=null)
    {
        $funcionario = Funcionario::find($id);
        return view('admin.funcionario.endereco',compact('funcionario'));
    }

    public function gerarPDF(Request $request)
    {
        $funcionarios = Funcionario::all();
        $pdf = PDF::loadView('admin.funcionario.pdf', compact('funcionarios','request'));
        //return dd($request);
        return $pdf->setPaper('a4')->stream('Funcionarios.pdf');
    }

    public function gerarXLSX() 
    {
        return Excel::download(new FuncionarioExport, 'Funcionarios.xlsx');
    }

    public function gerarCSV() 
    {
        return Excel::download(new FuncionarioExport, 'Funcionarios.csv');
    }

    public function store(Request $request, Funcionario $funcionario)
    {

        $funcionario = new Funcionario;
        $funcionario->fun_nome          = $request->nome;
        $funcionario->fun_rg            = $request->rg;
        $funcionario->fun_cpf           = $request->cpf;
        $funcionario->fun_email         = $request->email;
        $funcionario->car_codigo        = $request->car_codigo;
        $funcionario->fun_comissao      = $request->comissao;
        $funcionario->fun_telefone      = $request->telefone;
        $funcionario->fun_data_admissao = $request->data_admissao;
        $funcionario->fun_observacao    = $request->observacao;
        $funcionario->fun_senha         = bcrypt($request->senha);

        $response = $funcionario->salvar();
        if ($response['success'])
            return redirect()->route('funcionario.novo')->with('success', $response['message']);

        return redirect()->back()->with('error', $response['message']);
    }

    public function todos(Request $request)
    {
        $funcionarios = Funcionario::all();
        return view('admin.funcionario.listagem', compact('funcionarios','request'));
    }

    public function updatePost(Request $request, $id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->fun_nome          = $request->nome;
        $funcionario->fun_rg            = $request->rg;
        $funcionario->fun_cpf           = $request->cpf;
        $funcionario->fun_email         = $request->email;
        $funcionario->car_codigo        = $request->car_codigo;
        $funcionario->fun_comissao      = $request->comissao;
        $funcionario->fun_telefone      = $request->telefone;
        $funcionario->fun_data_admissao = $request->data_admissao;
        $funcionario->fun_observacao    = $request->observacao;
        $funcionario->fun_senha         = bcrypt($request->senha);
        $response = $funcionario->salvar();
        if ($response['success'])
            return redirect()->route('funcionario')->with('success', $response['message']);
       return redirect()->back()->with('error', $response['message']);
    }
  
    public function delete($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->delete();
        return redirect()->route('funcionario')->with('success','Funcionário deletado');
    }
}
