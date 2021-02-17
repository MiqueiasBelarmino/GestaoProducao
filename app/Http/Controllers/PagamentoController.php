<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use Illuminate\Http\Request;
use DB;

class PagamentoController extends Controller
{
    public function index()
    {
        $pagamentos = Pagamento::orderBy('pag_data_pagamento', 'ASC')->orderBy('pag_data_vencimento', 'ASC')->simplePaginate(10);
        return view('admin.pagamento.index', compact('pagamentos'));
    }

    public function store($id)
    {
        $pagamento = Pagamento::findOrFail($id);
        $pagamento->pag_data_pagamento = date("Y-m-d");

        $response = $pagamento->salvar();
        if ($response['success']) {
            return redirect()->route('pagamento')->with('success', 'Pagamento Efetuado');
        }
        return redirect()->route('pagamento')->with('error', $response['message']);
    }
}
