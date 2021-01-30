<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustoValidationFormRequest;
use App\Models\Fornecedor;
use App\Models\Material;
use PDF;
use Excel;

class MaterialController extends Controller
{
    private $totalPage = 10;
    public function index()
    {
        return view('admin.material.index');
    }

    public function novo($id = null)
    {
        $material = Material::find($id);
        $fornecedores = Fornecedor::pluck('for_nome_razao_social', 'for_codigo');
        return view('admin.material.novo', compact('material', 'fornecedores'));
    }

    // public function gerarPDF()
    // {
    //     $cargos = Material::all();
    //     $pdf = PDF::loadView('admin.cargos.pdf', compact('cargos'));
    //     return $pdf->setPaper('a4')->stream('Cargos.pdf');
    // }

    // public function gerarXLSX() 
    // {
    //     return Excel::download(new CargoExport, 'Cargos.xlsx');
    // }

    // public function gerarCSV() 
    // {
    //     return Excel::download(new CargoExport, 'Cargos.csv');
    // }

    public function store(CustoValidationFormRequest $request, Material $material)
    {

        $material = new Material;
        //$material = $material->firstOrCreate([]);
        $material->mat_nome         = $request->nome;
        $material->mat_descricao    = $request->descricao;
        $material->for_codigo       = $request->for_codigo;
        $ammount = number_format($request->custo, 2, '.', '');
        $material->mat_custo = $ammount;

        $material->mat_observacao   = $request->observacao;
        $response = $material->salvar();
        //$response = $material->save();
        if ($response['success'])
            return redirect()->route('material.novo')->with('success', $response['message']);

        return redirect()->back()->with('error', $response['message']);
    }

    public function todos()
    {
        $materiais = Material::all();
        return view('admin.material.index', compact('materiais'));
    }

    public function updateGet($id)
    {
        $material = Material::find($id);
        return view('admin.material.editar', compact('material'));
    }

    public function updatePost(CustoValidationFormRequest $request, $id)
    {
        $material = Material::findOrFail($id);
        $material->mat_nome         = $request->nome;
        $material->mat_descricao    = $request->descricao;
        $material->for_codigo       = $request->for_codigo;
        $ammount = number_format($request->custo, 2, '.', '');
        $material->mat_custo = $ammount;

        $material->mat_observacao   = $request->observacao;
        $material->save();
        return redirect()->route('material.todos')->with('success', 'Material Atualizado');
    }

    public function delete($id)
    {
        $material = Material::findOrFail($id);
        // if($material->funcionarios()->count() > 0)
        // {
        //     return redirect()->route('material.todos')->with('error','Há funcionários relacionados a esse material');
        // }else
        // {
        $material->delete();
        // }
        return redirect()->route('material.todos')->with('success', 'Material Deletado');
    }

    
}
