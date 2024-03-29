<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustoValidationFormRequest;
use App\Models\Pagamento;
use App\Models\MaterialCompra;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\Compra;
use App\Models\HistoricoProducao;
use App\Models\HistoricoView;
use App\Models\PedidoView;
use App\Models\ItemPedido;
use App\Models\CompraPedidoView;
use App\Models\CompraView;
use App\Models\Processo;
use PDF;
use DB;
use Excel;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    private $totalPage = 10;

    public function index()
    {
        $pedidos = Pedido::orderBy('ped_data', 'ASC')->simplePaginate(10);
        return view('admin.pedido.index', compact('pedidos'));
    }

    public function producao()
    {
        // $historicos = HistoricoView::all();
        $historicos = HistoricoView::select('*')->where('his_pro_data_saida', '=', null)->get();
        // dump($historicos);
        return view('admin.pedido.producao', compact('historicos'));
    }

    public function historico($id)
    {
        $historicos = HistoricoView::select('*')->where('ped_codigo', '=', $id)->get();
        return view('admin.pedido.historico', compact('historicos'));
    }

    // public function historicoView($id)
    // {
    //     $historicos = HistoricoView::select('*')->where('ped_codigo', '=', $id)->get();
    //     return view('admin.pedido.historico', compact('historicos'));
    // }

    public function compra($id = null)
    {
        if ($id != null)
            $itens_compra = CompraPedidoView::where('ped_codigo', '=', $id)->simplePaginate(10);
        else
            $itens_compra = CompraView::select('*')->simplePaginate(10);
        return view('admin.pedido.compra', compact('itens_compra'));
    }

    public function confirmar($id)
    {
        return view('admin.pedido.vencimento', compact('id'));
    }

    public function compraPedido(Request $request)
    {
        $itens_compra = CompraPedidoView::where('ped_codigo', '=', $request->ped_codigo)->get();
        $aux = 0;
        foreach ($itens_compra as $item) {
            $aux = $aux + $item->valor;
        }
        $compra =  new Compra;
        $compra->com_data       = now();
        $compra->com_total = $aux;
        $compra->com_data_vencimento = $request->com_data_vencimento;
        $teste = $compra->save();

        if ($teste == true) {
            foreach ($itens_compra as $item) {
                $material_compra = new MaterialCompra;
                $material_compra->mat_codigo = $item->mat_codigo;
                $material_compra->com_codigo = $compra->com_codigo;
                $material_compra->mat_com_quantidade = $item->quantidade;
                $material_compra->mat_com_custo = $item->valor;
                $material_compra->save();
            }

            return redirect()->route('producao')->with('success', 'Compra efetuada');
        }
    }

    public function compraTodos(Request $request, $id)
    {
        $itens_compra = CompraPedidoView::where('ped_codigo', '=', $id);
        $compra =  new Compra;
        $compra->com_data       = now();
    }

    public function producaoStore(Request $request, $id)
    {

        $historico = HistoricoProducao::findOrFail($id);
        $temp = $historico;
        $historico->his_pro_data_saida   = now();
        $response = $historico->save();
        
        if ($response == true) {
            if ($temp->proc_codigo == 1) {
                $pedido = Pedido::findOrFail($temp->ped_codigo);
                $pedido->ped_data_aprovacao = now();
                $pedido->save();
            }

            if ($temp->proc_codigo < (DB::table('processos')->count())) {
                $historico                       = new HistoricoProducao;
                $historico->ped_codigo           = $temp->ped_codigo;
                $historico->proc_codigo          = ($temp->proc_codigo + 1);
                $historico->his_pro_data_entrada = now();
                $historico->save();
                return redirect()->route('producao')->with('success', 'Pedido encaminhado para ' . (Processo::select('proc_nome')->where('proc_codigo', ($temp->proc_codigo + 1))->get())[0]->proc_nome);
            } else
                return redirect()->route('producao')->with('success', 'Pedido Finalizado');
        }
    }

    public function compraMateriais()
    {
        return view('admin.pedido.sucesso');
    }
    public function getProdutosValor($id)
    {
        $produtos = Produto::select('*')->where('prod_codigo', $id)->get();
        // Fetch all records
        $produtosData['data'] = $produtos;

        echo json_encode($produtosData);
        // exit;
    }

    public function novo($id = null)
    {
        $pedido = Pedido::find($id);
        $produtos = Produto::pluck('prod_nome', 'prod_codigo');
        $clientes = Cliente::pluck('cli_nome_razao_social', 'cli_codigo');
        return view('admin.pedido.novo', compact('pedido', 'produtos', 'clientes'));
    }

    public function gerarCompraPDF($id=null)
    {
        if ($id != null) {
            $itens_compra = CompraPedidoView::select('*')->where('ped_codigo', '=', $id)->get();
            $pdf = PDF::loadView('admin.pedido.pdf', compact('itens_compra'));
            return $pdf->setPaper('a4')->stream('Compra_' . now() . '.pdf');
        } else {
            $itens_compra = CompraView::all();
            $pdf = PDF::loadView('admin.pedido.pdfTodos', compact('itens_compra'));
            return $pdf->setPaper('a4')->stream('Compra_' . now() . '.pdf');
        }
    }


    // public function store(Request $request, Produto $produto)
    public function store(Request $request)
    {

        $request = $request->all();
        $pedido = new Pedido;

        $pedido->cli_codigo         = $request['data'][0]['cli_codigo'];
        $pedido->fun_codigo         = $request['data'][0]['fun_codigo'];
        $pedido->ped_observacao         = $request['data'][0]['ped_observacao'];
        $pedido->ped_data         = $request['data'][0]['ped_data'];
        $pedido->ped_data_entrega         = $request['data'][0]['ped_data_entrega'];
        $pedido->ped_status_pagamento         = $request['data'][0]['ped_status_pagamento'];
        $ammount = number_format($request['data'][0]['ped_total'], 2, '.', '');
        $pedido->ped_total        = $ammount;
        $response = $pedido->salvar();



        if ($response['success']) {

            for ($i = 2; $i <= (sizeof($request['data']) - 1); $i++) {
                $item = new ItemPedido();
                $item->ite_ped_cor = $request['data'][$i]['cor'];
                $item->prod_codigo = $request['data'][$i]['prod_codigo'];
                $item->ped_codigo = $pedido->ped_codigo;
                $item->ite_ped_valor = $request['data'][$i]['custo_produto'];
                $item->ite_ped_quantidade = $request['data'][$i]['quantidade'];
                $item->save();
            }

            if ($request['data'][1]['pag_forma'] == '1') {
                $pagamento = new Pagamento;
                $pagamento->ped_codigo = $pedido->ped_codigo;
                $pagamento->pag_numero_parcela = 1;
                $pagamento->pag_valor = number_format($request['data'][0]['ped_total'], 2, '.', '');
                $pagamento->pag_data_vencimento = $request['data'][1]['pag_data_vencimento'];
                $pagamento->pag_data_pagamento = $request['data'][1]['pag_data_vencimento'];
                $pagamento->save();
            } else if ($request['data'][1]['pag_forma'] == '2') {
                $pagamento = new Pagamento;
                $pagamento->ped_codigo = $pedido->ped_codigo;
                $pagamento->pag_numero_parcela = 1;
                $pagamento->pag_valor = number_format($request['data'][0]['ped_total'], 2, '.', '');
                $pagamento->pag_data_vencimento = $request['data'][1]['pag_data_vencimento'];
                $pagamento->save();
            } else if ($request['data'][1]['pag_forma'] == '3') {

                $aux = $request['data'][1]['pag_data_vencimento'];
                $tempDate = $aux;
                $parcelas = $request['data'][1]['pag_numero_parcela'];
                for ($j = 0; $j < ($parcelas); $j++) {
                    $pagamento = new Pagamento;
                    $pagamento->ped_codigo = $pedido->ped_codigo;
                    $pagamento->pag_numero_parcela = ($j + 1);
                    $pagamento->pag_valor = number_format(($request['data'][0]['ped_total'] / $parcelas), 2, '.', '');
                    $pagamento->pag_data_vencimento = $tempDate;
                    if ($j != 0) {

                        $pagamento->pag_data_vencimento = $pagamento->pag_data_vencimento->addDays(30);
                        $tempDate = $pagamento->pag_data_vencimento;
                    } else {
                        $pagamento->pag_data_vencimento = $tempDate;
                    }
                    $pagamento->save();
                }
            }

            $historico                       = new HistoricoProducao;
            $processo                        = Processo::select('*')->where('proc_nome', '=', 'Artes')->get();
            $historico->ped_codigo           = $pedido->ped_codigo;
            $historico->proc_codigo          = $processo[0]->proc_codigo;
            $historico->his_pro_data_entrada = $request['data'][0]['ped_data'];
            $historico->save();

            return response()->json(['success' => $response['message']]);
        }
        return response()->json(['error' => $response['message']]);
    }

    public function todos()
    {
        $pedidos = Pedido::all();
        return view('admin.pedido.index', compact('materiais'));
    }

    public function updateGet($id)
    {
        $pedido = Produto::find($id);
        return view('admin.pedido.editar', compact('pedido'));
    }
    public function historicoView($id)
    {
        $historicos = HistoricoView::select('*')->where('ped_codigo', '=', $id)->get();
        // Fetch all records
        $historicosData['data'] = $historicos;

        echo json_encode($historicosData);
        // exit;
    }
    public function pedidoView($id)
    {
        $pedidos = PedidoView::select('*')->where('pedido_detalhe.ped_codigo', '=', $id)->get();
        $detalhes  = array();

        foreach($pedidos as $pedido)
        {
            if($pedido->det_cam_codigo != null){
                // $detalhes = DB::table('dcam')->select('*')->where('ped_codigo', '=', $pedido->ped_codigo)->get();
                $detalhes = array_merge($detalhes, (DB::table('dcam')->select('*')->where('ped_codigo', '=', $pedido->ped_codigo)->get()->toArray()));
            }
            if($pedido->det_cal_codigo != null){
                // $detalhes = DB::table('dcal')->select('*')->where('ped_codigo', '=', $pedido->ped_codigo)->get();
                $detalhes = array_merge($detalhes, (DB::table('dcal')->select('*')->where('ped_codigo', '=', $pedido->ped_codigo)->get()->toArray()));
            }
        }

        $detalhesPedido['pedido'] = $pedidos;
        $detalhesPedido['detalhes'] = $detalhes;
        echo json_encode($detalhesPedido);
    }

    public function updatePost(CustoValidationFormRequest $request, $id)
    {
        $pedido = Produto::findOrFail($id);
        $pedido->mat_nome         = $request->nome;
        $pedido->mat_descricao    = $request->descricao;
        $pedido->for_codigo       = $request->for_codigo;
        $ammount = number_format($request->custo, 2, '.', '');
        $pedido->mat_custo = $ammount;

        $pedido->mat_observacao   = $request->observacao;
        $pedido->save();
        return redirect()->route('pedido.todos')->with('success', 'Produto Atualizado');
    }

    public function delete($id)
    {
        //$pedido = Pedido::findOrFail($id);
        //$pedido->delete();
        // return redirect()->route('pedido.todos')->with('success', 'Produto Deletado');
    }
}