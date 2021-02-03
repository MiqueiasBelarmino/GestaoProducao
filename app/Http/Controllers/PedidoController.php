<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustoValidationFormRequest;
use App\Models\Pagamento;
use App\Models\MaterialProduto;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\ItemPedido;
use PDF;
use Excel;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    private $totalPage = 10;

    public function index()
    {
        return view('admin.pedido.index');
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
        $pedido = new Pedido;

        $pedido->cli_codigo         = $request['data'][0]['cli_codigo'];
        $pedido->fun_codigo         = $request['data'][0]['fun_codigo'];
        $pedido->ped_observacao         = $request['data'][0]['ped_observacao'];
        $pedido->ped_data         = $request['data'][0]['ped_data'];
        $pedido->ped_data_entrega         = $request['data'][0]['ped_data_entrega'];
        $pedido->ped_status         = $request['data'][0]['ped_status'];
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
                $parcelas = $request['data'][1]['pag_numero_parcela'];
                for ($j = 0; $j < ($parcelas); $j++) {
                    $pagamento = new Pagamento;
                    $pagamento->ped_codigo = $pedido->ped_codigo;
                    $pagamento->pag_numero_parcela = ($j + 1);
                    $pagamento->pag_valor = number_format(($request['data'][0]['ped_total']/$parcelas), 2, '.', '');
                    $pagamento->pag_data_vencimento = $aux;
                    if ($j != 0) {

                        $pagamento->pag_data_vencimento->addDays(30);
                        $aux = $request['data'][1]['pag_data_vencimento'];
                    }
                    $pagamento->save();
                }
            }

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
        $pedido = Produto::findOrFail($id);
        // if($pedido->funcionarios()->count() > 0)
        // {
        //     return redirect()->route('pedido.todos')->with('error','Há funcionários relacionados a esse pedido');
        // }else
        // {
        $pedido->delete();
        // }
        return redirect()->route('pedido.todos')->with('success', 'Produto Deletado');
    }
}
