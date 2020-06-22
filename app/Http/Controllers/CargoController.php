<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Http\Requests\MoneyValidationFormRequest;
use App\Models\Funcionario;

class CargoController extends Controller
{
    private $totalPage = 10;
    public function index()
    {
        return view('admin.cargos.index');
    }

    public function novo($id=null)
    {
        $cargo = Cargo::find($id);
        return view('admin.cargos.novo',compact('cargo'));
    }

    public function store(MoneyValidationFormRequest $request, Cargo $cargo)
    {

        $cargo = new Cargo;
        //$cargo = $cargo->firstOrCreate([]);
        $cargo->car_nome         = $request->car_nome;
        $cargo->car_descricao    = $request->car_descricao;
        
        $ammount = number_format($request->car_salario_base, 2,'.','');
        $cargo->car_salario_base = $ammount;

        $cargo->car_observacao   = $request->car_observacao;
        $response = $cargo->salvar();
        //$response = $cargo->save();
        if($response['success'])
            return redirect()->route('cargo.novo')->with('success',$response['message']);
        
            return redirect()->back()->with('error',$response['message']);
    }

    public function todos()
    {
        $cargos = Cargo::all();
        return view('admin.cargos.index',compact('cargos'));
    }

    public function updateGet($id)
    {
        $cargo = Cargo::find($id);
        return view('admin.cargos.editar',compact('cargo'));
    }

    public function updatePost(MoneyValidationFormRequest $request, $id)
    {
        $cargo = Cargo::findOrFail($id);
        $cargo->car_nome         = $request->car_nome;
        $cargo->car_descricao    = $request->car_descricao;

        $ammount = number_format($request->car_salario_base, 2,'.','');
        $cargo->car_salario_base = $ammount;

        $cargo->car_observacao   = $request->car_observacao;
        $cargo->save();
        return redirect()->route('cargo.todos')->with('sucess', 'Cargo Atualizado');
    }
  
    public function delete($id)
    {
        $cargo = Cargo::findOrFail($id);
        if($cargo->funcionarios()->count() > 0)
        {
            return redirect()->route('cargo.todos')->with('error','Há funcionários relacionados a esse cargo');
        }else
        {
            $cargo->delete();
        }
        return redirect()->route('cargo.todos')->with('success','Cargo Deletado');
    }

}
