<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    private $totalPage = 10;

    public function index()
    {
        return view('rh.fornecedor.index');
    }

    public function novo($id=null)
    {
        $fornecedor = Fornecedor::find($id);
        return view('rh.fornecedor.novo',compact('fornecedor'));
    }

    public function store(Request $request, Fornecedor $fornecedor)
    {

        $fornecedor = new Fornecedor;
        $fornecedor->for_nome_razao_social      = $request->for_nome_razao_social;
        $fornecedor->for_nome_social_fantasia   = $request->for_nome_social_fantasia;
        $fornecedor->for_rg_inscricao_estadual  = $request->for_rg_inscricao_estadual;
        $fornecedor->for_cpf_cnpj               = $request->for_cpf_cnpj;
        $fornecedor->for_telefone               = $request->for_telefone;
        $fornecedor->for_email                  = $request->for_email;
        $fornecedor->for_observacao             = $request->for_observacao;
        $response = $fornecedor->salvar();
        //$response = $fornecedor->save();
        if($response['success'])
            return redirect()->route('fornecedor.novo')->with('success',$response['message']);
        
            return redirect()->back()->with('error',$response['message']);
    }

    public function todos()
    {
        $fornecedores = Fornecedor::all();
        return view('rh.fornecedor.index',compact('fornecedores'));
    }

    public function updateGet($id)
    {
        $fornecedor = Fornecedor::find($id);
        return view('rh.fornecedor.editar',compact('fornecedor'));
    }

    public function updatePost(Request $request, $id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->for_nome_razao_social      = $request->for_nome_razao_social;
        $fornecedor->for_nome_social_fantasia   = $request->for_nome_social_fantasia;
        $fornecedor->for_rg_inscricao_estadual  = $request->for_rg_inscricao_estadual;
        $fornecedor->for_cpf_cnpj               = $request->for_cpf_cnpj;
        $fornecedor->for_telefone               = $request->for_telefone;
        $fornecedor->for_email                  = $request->for_email;
        $fornecedor->for_observacao             = $request->for_observacao;
        $response = $fornecedor->salvar();
        return redirect()->route('fornecedor.todos')->with('success', 'Fornecedor Atualizado');
    }
  
    public function delete($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();
        return redirect()->route('fornecedor.todos')->with('success','Fornecedor deletado');
    }
}
