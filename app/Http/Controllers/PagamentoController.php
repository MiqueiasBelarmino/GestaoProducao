<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use Illuminate\Http\Request;
use App\Models\Pedido;

class PagamentoController extends Controller
{
    public function index()
    {
        $pagamentos = Pagamento::simplePaginate(10);
        foreach ($pagamentos as $pagamento) {
            if($pagamento->pag_data_pagamento == null){
                echo "NULL<br>";
            }
         }
        // return view('admin.pagamento.index', compact('pagamentos'));
        // $pedidos = Pagamento::all();
        // foreach($pedidos as $pedido){
        //     $pagamentos = $pedido->pagamentos;
        // }
        // dd($pagamentos[0]->pedido->cliente);
        // // return view('admin.pagamento.novo', compact('pedidos'));
    }
    public function buscar(Request $request)
    {
        // $pagamentos = Pagamento::where('initials', 'like', '%{{$request->get("busca_datatable")}}%')->get()->paginate(3);
        $pagamentos = DB::table('pagamentos')
            ->select('*')
            ->join('pedidos', 'pedidos.ped_codigo', '=', 'pagamentos.ped_codigo')
            ->join('clientes', 'clientes.cli_codigo', '=', 'pedidos.cli_codigo')
            ->where('initials', 'like', '%{{$request->get("busca_datatable")}}%')
            ->get()->paginate(10);

        return view('admin.pagamento.index', compact('pagamentos'));
    }
}
