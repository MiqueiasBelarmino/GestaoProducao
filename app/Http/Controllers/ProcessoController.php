<?php

namespace App\Http\Controllers;

use App\Models\Processo;
use Illuminate\Http\Request;
use App\Exports\ProcessoExport;
use PDF;
use Excel;

class ProcessoController extends Controller
{
    private $totalPage = 10;
    public function index()
    {
        return view('admin.processo.index');
    }

    public function novo($id=null)
    {
        $processo = Processo::find($id);
        return view('admin.processo.novo',compact('processo'));
    }

    public function gerarPDF()
    {
        $processos = Processo::all();
        $pdf = PDF::loadView('admin.processo.pdf', compact('processos'));
        return $pdf->setPaper('a4')->stream('Processos.pdf');
    }

    public function gerarXLSX() 
    {
        return Excel::download(new ProcessoExport, 'Cargos.xlsx');
    }

    public function gerarCSV() 
    {
        return Excel::download(new ProcessoExport, 'Cargos.csv');
    }

    public function store(Request $request, Processo $processo)
    {

        $processo = new Processo;
        $processo->proc_nome   = $request->nome;
        $processo->proc_observacao   = $request->observacao;
        $response = $processo->salvar();
        //$response = $processo->save();
        if($response['success'])
            return redirect()->route('processo.novo')->with('success',$response['message']);
        
            return redirect()->back()->with('error',$response['message']);
    }

    public function todos()
    {
        $processos = Processo::select('*')->simplePaginate(15);
        return view('admin.processo.index',compact('processos'));
    }

    public function updateGet($id)
    {
        $processo = Processo::find($id);
        return view('admin.processo.editar',compact('processo'));
    }

    public function updatePost(Request $request, $id)
    {
        $processo = Processo::findOrFail($id);
        $processo->proc_nome   = $request->nome;
        $processo->proc_observacao   = $request->observacao;
        $processo->save();
        return redirect()->route('processo.todos')->with('success', 'Processo Atualizado');
    }
  
    public function delete($id)
    {
        $processo = Processo::findOrFail($id);
        // if($processo->historico_producao()->count() > 0)
        // {
        //     return redirect()->route('processo.todos')->with('error','Há produções relacionadas a esse processo');
        // }else
        // {
            $processo->delete();
        // }
        return redirect()->route('processo.todos')->with('success','Processo Deletado');
    }
}
