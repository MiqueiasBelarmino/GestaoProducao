<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\HistoricoView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;

class AdminController extends Controller
{
    public function index(Request $request, Cliente $clientes)
    {
        // dd(Session::all());
        $clientes = DB::table('clientes')->count();
        $materiais = DB::table('materiais')->count();
        $producoes = HistoricoView::select('*')->where('his_pro_data_saida', '=', null)->count();
        return view('admin.home.index', compact('clientes', 'materiais','producoes'));
    }
}
