<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Exports\ClienteExport;
use PDF;
use Excel;

class ClienteController extends Controller
{
    private $totalPage = 10;

    public function index()
    {
        return view('admin.cliente.index');
    }

    public function novo($id=null)
    {
        $cliente = Cliente::find($id);
        return view('admin.cliente.novo',compact('cliente'));
    }


    public function gerarPDF(Request $request)
    {
        $clientes = Cliente::all();
        $pdf = PDF::loadView('admin.cliente.pdf', compact('clientes','request'));
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

    public function store(Request $request, Cliente $cliente)
    {

        $cliente = new Cliente;
        $cliente->cli_nome_razao_social      = $request->nome_razao_social;
        $cliente->cli_nome_social_fantasia   = $request->nome_social_fantasia;
        $cliente->cli_rg_inscricao_estadual  = $request->rg_inscricao_estadual;
        $cliente->cli_cpf_cnpj               = $request->cpf_cnpj;
        $cliente->cli_telefone               = $request->telefone;
        $cliente->cli_email                  = $request->email;
        $cliente->cli_observacao             = $request->observacao;
        $response = $cliente->salvar();
        if($response['success'])
            return redirect()->route('cliente.novo')->with('success',$response['message']);
        
            return redirect()->back()->with('error',$response['message']);
    }

    public function todos(Request $request)
    {
        $clientes = Cliente::all();
        return view('admin.cliente.listagem',compact('clientes','request'));
    }

    public function updateGet($id)
    {
        $cliente = Cliente::find($id);
        return view('admin.cliente.editar',compact('cliente'));
    }

    public function updatePost(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->cli_nome_razao_social      = $request->nome_razao_social;
        $cliente->cli_nome_social_fantasia   = $request->nome_social_fantasia;
        $cliente->cli_rg_inscricao_estadual  = $request->rg_inscricao_estadual;
        $cliente->cli_cpf_cnpj               = $request->cpf_cnpj;
        $cliente->cli_telefone               = $request->telefone;
        $cliente->cli_email                  = $request->email;
        $cliente->cli_observacao             = $request->observacao;
        $response = $cliente->salvar();
        if ($response['success'])
            return redirect()->route('cliente')->with('success', $response['message']);
       return redirect()->back()->with('error', $response['message']);
    }
  
    public function delete($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('cliente')->with('success','Cliente deletado');
    }
}
