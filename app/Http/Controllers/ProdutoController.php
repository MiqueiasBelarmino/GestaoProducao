<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustoValidationFormRequest;
use App\Models\Material;
use App\Models\MaterialProduto;
use App\Models\Produto;
use App\Models\DetalhesCamiseta;
use App\Models\DetalhesCalca;
use PDF;
use Excel;
use SebastianBergmann\Environment\Console;

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

    // public function store(Request $request, Produto $produto)
    public function store(Request $request)
    {

        $request = $request->all();
    
        $produto = new Produto;

        $produto->prod_nome         = $request['data'][0]['nome'];
        $ammount = number_format($request['data'][0]['valor'], 2, '.', '');
        $produto->prod_valor        = $ammount;
        $produto->prod_observacao   = $request['data'][0]['observacao'];

        $grupo = $request['data'][0]['grupo'];


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

            if($grupo == '1' || $grupo == 1){

                $datalhes_camiseta = new DetalhesCamiseta;
                $datalhes_camiseta->det_cam_manga_tipo   = $request['data'][0]['manga_tipo'];
                $datalhes_camiseta->det_cam_manga_tamanho   = $request['data'][0]['manga_tamanho'];
                $datalhes_camiseta->det_cam_manga_cor   = $request['data'][0]['manga_cor'];
                $datalhes_camiseta->det_cam_manga_galao   = $request['data'][0]['manga_galao'];
                $datalhes_camiseta->det_cam_gola_tipo   = $request['data'][0]['gola_tipo'];
                $datalhes_camiseta->det_cam_gola_decote   = $request['data'][0]['gola_decote'];
                $datalhes_camiseta->det_cam_bolso_frente   = $request['data'][0]['bolso_frente_cam'];
                $datalhes_camiseta->prod_codigo = $produto->prod_codigo;
                $datalhes_camiseta->save();

            }else if($grupo == '2' || $grupo == 2){

                $datalhes_calca = new DetalhesCalca;
                $datalhes_calca->det_cal_passadores   = isset($request['data'][0]->passadores)?'1':'0' ;
                $datalhes_calca->det_cal_elastico   = isset($request['data'][0]->elastico)?'1':'0' ;
                $datalhes_calca->det_cal_bolso_frente   = isset($request['data'][0]->bolso_frente)?'1':'0' ;
                $datalhes_calca->det_cal_bolso_costas   = isset($request['data'][0]->bolso_costas)?'1':'0' ;
                $datalhes_calca->det_cal_refletiva   = isset($request['data'][0]->refletiva)?'1':'0' ;
                $datalhes_calca->prod_codigo = $produto->prod_codigo;
                $datalhes_calca->save();

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
