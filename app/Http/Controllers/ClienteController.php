<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

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

    public function store(Request $request, Cliente $cliente)
    {

        $cliente = new Cliente;
        $cliente->cli_nome_razao_social      = $request->cli_nome_razao_social;
        $cliente->cli_nome_social_fantasia   = $request->cli_nome_social_fantasia;
        $cliente->cli_rg_inscricao_estadual  = $request->cli_rg_inscricao_estadual;
        $cliente->cli_cpf_cnpj               = $request->cli_cpf_cnpj;
        $cliente->cli_telefone               = $request->cli_telefone;
        $cliente->cli_email                  = $request->cli_email;
        $cliente->cli_observacao             = $request->cli_observacao;
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
        $cliente->cli_nome_razao_social      = $request->cli_nome_razao_social;
        $cliente->cli_nome_social_fantasia   = $request->cli_nome_social_fantasia;
        $cliente->cli_rg_inscricao_estadual  = $request->cli_rg_inscricao_estadual;
        $cliente->cli_cpf_cnpj               = $request->cli_cpf_cnpj;
        $cliente->cli_telefone               = $request->cli_telefone;
        $cliente->cli_email                  = $request->cli_email;
        $cliente->cli_observacao             = $request->cli_observacao;
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
