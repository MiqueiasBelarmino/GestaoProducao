<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustoValidationFormRequest;
use App\Models\Material;
use App\Models\MaterialProduto;
use App\Models\Produto;
use PDF;
use Excel;

class ProdutoController extends Controller
{
    private $totalPage = 10;
    public function index()
    {
        return view('admin.produto.index');
    }

    public function getMateriais($id)
    {
        $materiais = Material::select('*')->where('mat_codigo', $id)->get();
        // Fetch all records
        $materiaisData['data'] = $materiais;

        echo json_encode($materiaisData);
        // exit;
    }

    public function novo($id = null)
    {
        $produto = Produto::find($id);
        $materiais = Material::pluck('mat_nome', 'mat_codigo');
        return view('admin.produto.novo', compact('produto', 'materiais'));
    }

    public function save()
    {
        $this->output->set_content_type('application/json');
        echo json_encode(array('check' => 'check'));
    }
    // public function gerarPDF()
    // {
    //     $cargos = Produto::all();
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

    // public function store(Request $request, Produto $produto)
    public function store(Request $request)
    {

        $request = $request->all();
        $produto = new Produto;

        $produto->prod_nome         = $request['data'][0]['nome'];
        $ammount = number_format($request['data'][0]['valor'], 2, '.', '');
        $produto->prod_valor        = $ammount;
        $produto->prod_observacao   = $request['data'][0]['observacao'];
        $response = $produto->salvar();
        if ($response['success']) {

            for ($i = 1; $i <= (sizeof($request['data']) - 1); $i++) {
                $material_produto = new MaterialProduto();
                $material_produto->mat_codigo = $request['data'][$i]['material'];
                $material_produto->prod_codigo = $produto->prod_codigo;
                $material_produto->mat_pro_valor = $request['data'][$i]['custo_material'];
                $material_produto->mat_pro_quantidade = $request['data'][$i]['quantidade'];
                $material_produto->save();
            }
            return response()->json(['success' => $response['message']]);
        }
        return response()->json(['error' => $response['message']]);
    }

    public function todos()
    {
        $materiais = Produto::all();
        return view('admin.produto.index', compact('materiais'));
    }

    public function updateGet($id)
    {
        $produto = Produto::find($id);
        return view('admin.produto.editar', compact('produto'));
    }

    public function updatePost(CustoValidationFormRequest $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->mat_nome         = $request->nome;
        $produto->mat_descricao    = $request->descricao;
        $produto->for_codigo       = $request->for_codigo;
        $ammount = number_format($request->custo, 2, '.', '');
        $produto->mat_custo = $ammount;

        $produto->mat_observacao   = $request->observacao;
        $produto->save();
        return redirect()->route('produto.todos')->with('success', 'Produto Atualizado');
    }

    public function delete($id)
    {
        $produto = Produto::findOrFail($id);
        // if($produto->funcionarios()->count() > 0)
        // {
        //     return redirect()->route('produto.todos')->with('error','Há funcionários relacionados a esse produto');
        // }else
        // {
        $produto->delete();
        // }
        return redirect()->route('produto.todos')->with('success', 'Produto Deletado');
    }
}
