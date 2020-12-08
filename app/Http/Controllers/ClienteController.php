<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Endereco;
use App\Exports\ClienteExport;
use PDF;
use DB;
use Excel;

class ClienteController extends Controller
{
    private $totalPage = 10;

    public function index()
    {
        return view('admin.cliente.index');
    }

    public function novo($id = null)
    {
        $cliente = Cliente::find($id);
        if ($id != null) {
            $temp = DB::table('enderecos')
                ->join('enderecos_clientes', 'enderecos.end_codigo', '=', 'enderecos_clientes.end_codigo')
                ->join('clientes', 'enderecos_clientes.cli_codigo', '=', 'clientes.cli_codigo')
                ->select('enderecos.*')
                ->where('clientes.cli_codigo', '=', $cliente->cli_codigo)
                ->get();
            // dd($endereco);
            if ($temp[0] != null)
                $endereco = $temp[0];
        }
        return view('admin.cliente.novo', compact('cliente', 'endereco'));
    }


    public function gerarPDF(Request $request)
    {
        $clientes = Cliente::all();
        $pdf = PDF::loadView('admin.cliente.pdf', compact('clientes', 'request'));
        return $pdf->setPaper('a4')->stream('Clientes.pdf');
    }

    public function gerarXLSX()
    {
        return Excel::download(new ClienteExport, 'Clientes.xlsx');
    }

    public function gerarCSV()
    {
        return Excel::download(new ClienteExport, 'Clientes.csv');
    }

    public function store(NumeroValidationFormRequest $request, Cliente $cliente)
    {

        $cliente = new Cliente;
        $cliente->cli_nome_razao_social      = $request->nome_razao_social;
        $cliente->cli_nome_social_fantasia   = $request->nome_social_fantasia;
        $cliente->cli_rg_inscricao_estadual  = $request->rg_inscricao_estadual;
        $cliente->cli_cpf_cnpj               = $request->cpf_cnpj;
        $cliente->cli_telefone               = $request->telefone;
        $cliente->cli_email                  = $request->email;
        $cliente->cli_observacao             = $request->observacao;

        $endereco = new Endereco;
        $endereco->end_rua          = $request->rua;
        $endereco->end_numero       = $request->numero;
        $endereco->end_bairro       = $request->bairro;
        $endereco->end_cidade       = $request->cidade;
        $endereco->end_cep          = $request->cep;
        $endereco->end_estado       = $request->estado;
        $endereco->end_observacao   = $request->observacao_end;

        $response = $cliente->salvar();
        if ($response['success']) {
            $endereco->salvar();
            $cliente->enderecos()->attach($endereco->end_codigo);
            return redirect()->route('cliente.novo')->with('success', $response['message']);
        }

        return redirect()->back()->with('error', $response['message']);
    }

    public function todos(Request $request)
    {
        $clientes = Cliente::all();
        return view('admin.cliente.listagem', compact('clientes', 'request'));
    }

    public function updateGet($id)
    {
        $cliente = Cliente::find($id);
        return view('admin.cliente.editar', compact('cliente'));
    }

    public function updatePost(NumeroValidationFormRequest $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->cli_nome_razao_social      = $request->nome_razao_social;
        $cliente->cli_nome_social_fantasia   = $request->nome_social_fantasia;
        $cliente->cli_rg_inscricao_estadual  = $request->rg_inscricao_estadual;
        $cliente->cli_cpf_cnpj               = $request->cpf_cnpj;
        $cliente->cli_telefone               = $request->telefone;
        $cliente->cli_email                  = $request->email;
        $cliente->cli_observacao             = $request->observacao;

        $temp = DB::table('enderecos')
            ->join('enderecos_clientes', 'enderecos.end_codigo', '=', 'enderecos_clientes.end_codigo')
            ->join('clientes', 'enderecos_clientes.cli_codigo', '=', 'clientes.cli_codigo')
            ->select('enderecos.*')
            ->where('clientes.cli_codigo', '=', $cliente->cli_codigo)
            ->get();
        $endereco = $temp[0];
        $endereco->end_rua          = $request->rua;
        $endereco->end_numero       = $request->numero;
        $endereco->end_bairro       = $request->bairro;
        $endereco->end_cidade       = $request->cidade;
        $endereco->end_cep          = $request->cep;
        $endereco->end_estado       = $request->estado;
        $endereco->end_observacao   = $request->observacao_end;

        $response = $cliente->salvar();
        if ($response['success']) {
            $endereco->salvar();
            return redirect()->route('cliente')->with('success', $response['message']);
        }
        return redirect()->back()->with('error', $response['message']);
    }

    public function delete($id)
    {
        $cliente = Cliente::findOrFail($id);
        $temp = DB::table('enderecos')
            ->join('enderecos_clientes', 'enderecos.end_codigo', '=', 'enderecos_clientes.end_codigo')
            ->join('clientes', 'enderecos_clientes.cli_codigo', '=', 'clientes.cli_codigo')
            ->select('enderecos.*')
            ->where('clientes.cli_codigo', '=', $cliente->cli_codigo)
            ->get();
        $endereco = $temp[0];
        $cliente->enderecos()->detach($endereco->end_codigo);
        $cliente->delete();
        return redirect()->route('cliente')->with('success', 'Cliente deletado');
    }
}
