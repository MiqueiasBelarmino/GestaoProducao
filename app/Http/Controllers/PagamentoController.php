<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    public function novo()
    {
        return view('admin.pagamento.novo');
    }
}
