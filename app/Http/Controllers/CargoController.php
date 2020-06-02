<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;

class CargoController extends Controller
{
    private $totalPage = 10;
    public function index()
    {
        return view('rh.cargos.index');
    }

    public function novo()
    {
        return view('rh.cargos.novo');
    }

    public function store(Request $request, Cargo $cargo)
    {

        $cargo = new Cargo;
        //$cargo = $cargo->firstOrCreate([]);
        $cargo->car_nome         = $request->car_nome;
        $cargo->car_descricao    = $request->car_descricao;
        $cargo->car_salario_base = $request->car_salario_base;
        $cargo->car_observacao   = $request->car_observacao;
        $response = $cargo->salvar();
        //$response = $cargo->save();
        if($response['success'])
            return redirect()->route('cargo.novo')->with('success',$response['message']);
        
            return redirect()->back()->with('error',$response['message']);
    }

    public function cargos()
    {
        $cargos = Cargo::all();
        return view('rh.cargos.index',compact('cargos'));
    }
}
