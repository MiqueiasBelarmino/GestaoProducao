<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;
use App\Exports\FornecedorExport;
use PDF;
use Excel;

class FornecedorController extends Controller
{
    private $totalPage = 10;

    public function index()
    {
        return view('admin.fornecedor.index');
    }

    public function novo($id=null)
    {
        $fornecedor = Fornecedor::find($id);
        return view('admin.fornecedor.novo',compact('fornecedor'));
    }

    public function gerarPDF(Request $request)
    {
        $fornecedores = Fornecedor::all();
        $pdf = PDF::loadView('admin.fornecedor.pdf', compact('fornecedores','request'));
        return $pdf->setPaper('a4')->stream('Fornecedores.pdf');
    }

    public function gerarXLSX() 
    {
        return Excel::download(new FornecedorExport, 'Fornecedores.xlsx');
    }

    public function gerarCSV() 
    {
        return Excel::download(new FornecedorExport, 'Fornecedores.csv');
    }

    public function store(Request $request, Fornecedor $fornecedor)
    {

        $fornecedor = new Fornecedor;
        $fornecedor->for_nome_razao_social      = $request->nome_razao_social;
        $fornecedor->for_nome_social_fantasia   = $request->nome_social_fantasia;
        $fornecedor->for_rg_inscricao_estadual  = $request->rg_inscricao_estadual;
        $fornecedor->for_cpf_cnpj               = $request->cpf_cnpj;
        $fornecedor->for_telefone               = $request->telefone;
        $fornecedor->for_email                  = $request->email;
        $fornecedor->for_observacao             = $request->observacao;
        $response = $fornecedor->salvar();
        //$response = $fornecedor->save();
        if($response['success'])
            return redirect()->route('fornecedor.novo')->with('success',$response['message']);
        
            return redirect()->back()->with('error',$response['message']);
    }

    public function todos(Request $request)
    {
        $fornecedores = Fornecedor::all();
        return view('admin.fornecedor.listagem',compact('fornecedores','request'));
    }

    public function updateGet($id)
    {
        $fornecedor = Fornecedor::find($id);
        return view('admin.fornecedor.editar',compact('fornecedor'));
    }

    public function updatePost(Request $request, $id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->for_nome_razao_social      = $request->nome_razao_social;
        $fornecedor->for_nome_social_fantasia   = $request->nome_social_fantasia;
        $fornecedor->for_rg_inscricao_estadual  = $request->rg_inscricao_estadual;
        $fornecedor->for_cpf_cnpj               = $request->cpf_cnpj;
        $fornecedor->for_telefone               = $request->telefone;
        $fornecedor->for_email                  = $request->email;
        $fornecedor->for_observacao             = $request->observacao;
        $response = $fornecedor->salvar();
        if ($response['success'])
            return redirect()->route('fornecedor')->with('success', $response['message']);
       return redirect()->back()->with('error', $response['message']);
    }
  
    public function delete($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();
        return redirect()->route('fornecedor')->with('success','Fornecedor deletado');
    }
}
