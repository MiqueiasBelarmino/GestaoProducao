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

    public function gerarPDF()
    {
        $materiais = Material::all();
        $pdf = PDF::loadView('admin.material.pdf', compact('materiais'));
        return $pdf->setPaper('a4')->stream('Materiais.pdf');
    }

    public function store(CustoValidationFormRequest $request, Material $material)
    {

        $material = new Material;
        //$material = $material->firstOrCreate([]);
        $material->mat_nome         = $request->nome;
        $material->for_codigo       = $request->for_codigo;
        $material->mat_unidade      = $request->unidade;
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
        $materiais = Material::select('*')->simplePaginate(15);
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
        $material->for_codigo       = $request->for_codigo;
        $material->mat_unidade      = $request->unidade;
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
