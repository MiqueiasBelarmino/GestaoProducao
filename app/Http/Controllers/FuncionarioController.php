<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Exports\FuncionarioExport;
use App\Models\Endereco;
use App\Http\Requests\NumeroValidationFormRequest;
use PDF;
use DB;
use Excel;
use Illuminate\Support\Facades\Auth;

class FuncionarioController extends Controller
{
    private $totalPage = 10;
    
    public function index()
    {
        return view('admin.funcionario.index');
    }

    public function LoginActionHandler(Request $request)
    {

        // dd($request);
        // $credentials = ['fun_email'=>Input::get('email'),'password'=>Input::get('password')];
        $credentials = ['fun_email'=>$request->request->get("fun_email"),'password'=>$request->request->get("fun_senha")];
        $funcionarioLog = auth()->guard('funcionario');
        if($funcionarioLog->attempt($credentials)) {
            //dd(Auth::user());
            return redirect()->route('admin.home');
        } else {
          return redirect()->back()->withErrors('Invalid Login, please try again');
        }

    }
    public function username()
    {
        return 'fun_email';
    }



    public function logout()
    {
        auth()->guard('funcionario')->logout();
        return redirect()->route('login');
    }

    public function novo($id = null)
    {
        $funcionario = Funcionario::find($id);
        $endereco = "";
        $cargos = Cargo::pluck('car_nome', 'car_codigo');
        if ($id != null) {
            //$endereco = Funcionario::find($id)->enderecos()->get();
            $temp = DB::table('enderecos')
                ->join('enderecos_funcionarios', 'enderecos.end_codigo', '=', 'enderecos_funcionarios.end_codigo')
                ->join('funcionarios', 'enderecos_funcionarios.fun_codigo', '=', 'funcionarios.fun_codigo')
                ->select('enderecos.*')
                ->where('funcionarios.fun_codigo', '=', $id)
                ->get();
            // dd($endereco);
            $endereco = $temp[0];
            return view('admin.funcionario.novo', compact('cargos', 'funcionario', 'endereco'));
        }
        //Endereco::where('fun_codigo', $id)->get()->first();
        
        // return view('admin.funcionario.novo', compact('car_codigo', 'cargos', 'funcionario', 'endereco'));
        return view('admin.funcionario.novo', compact('cargos', 'funcionario'));
    }

    public function endereco($id = null)
    {
        $funcionario = Funcionario::find($id);
        return view('admin.funcionario.endereco', compact('funcionario'));
    }

    public function gerarPDF(Request $request)
    {
        $funcionarios = Funcionario::all();
        $pdf = PDF::loadView('admin.funcionario.pdf', compact('funcionarios', 'request'));
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

    public function store(NumeroValidationFormRequest $request, Funcionario $funcionario)
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

        $endereco = new Endereco;
        $endereco->end_rua          = $request->rua;
        $endereco->end_numero       = $request->numero;
        $endereco->end_bairro       = $request->bairro;
        $endereco->end_cidade       = $request->cidade;
        $endereco->end_cep          = $request->cep;
        $endereco->end_estado       = $request->estado;
        $endereco->end_observacao   = $request->observacao_end;

        $response = $funcionario->salvar();
        if ($response['success']) {
            $endereco->salvar();
            $funcionario->enderecos()->attach($endereco->end_codigo);
            return redirect()->route('funcionario.novo')->with('success', $response['message']);
        }
        return redirect()->back()->with('error', $response['message']);
    }

    public function todos(Request $request)
    {
        $funcionarios = Funcionario::all();
        return view('admin.funcionario.listagem', compact('funcionarios', 'request'));
    }

    public function updatePost(NumeroValidationFormRequest $request, $id)
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

        $temp = DB::table('enderecos')
            ->join('enderecos_funcionarios', 'enderecos.end_codigo', '=', 'enderecos_funcionarios.end_codigo')
            ->join('funcionarios', 'enderecos_funcionarios.fun_codigo', '=', 'funcionarios.fun_codigo')
            ->select('enderecos.*')
            ->where('funcionarios.fun_codigo', '=', $funcionario->fun_codigo)
            ->get();
        $endereco = $temp[0];
        $endereco->end_rua          = $request->rua;
        $endereco->end_numero       = $request->numero;
        $endereco->end_bairro       = $request->bairro;
        $endereco->end_cidade       = $request->cidade;
        $endereco->end_cep          = $request->cep;
        $endereco->end_estado       = $request->estado;
        $endereco->end_observacao   = $request->observacao_end;

        $response = $funcionario->salvar();
        if ($response['success']) {
            $endereco->salvar();
            return redirect()->route('funcionario')->with('success', $response['message']);
        }
        return redirect()->back()->with('error', $response['message']);
    }

    public function delete($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $temp = DB::table('enderecos')
            ->join('enderecos_funcionarios', 'enderecos.end_codigo', '=', 'enderecos_funcionarios.end_codigo')
            ->join('funcionarios', 'enderecos_funcionarios.fun_codigo', '=', 'funcionarios.fun_codigo')
            ->select('enderecos.*')
            ->where('funcionarios.fun_codigo', '=', $funcionario->fun_codigo)
            ->get();
        $endereco = $temp[0];
        $funcionario->enderecos()->detach($endereco->end_codigo);
        $funcionario->delete();
        return redirect()->route('funcionario')->with('success', 'Funcionário deletado');
    }
}
