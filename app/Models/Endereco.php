<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Endereco extends Model
{
    protected $primaryKey = 'end_codigo';
    public $incrementing = true;
    public $timestamps = false;


    public function salvar()
    {
        DB::beginTransaction();

        $endereco = $this->save();

        if ($endereco) {
            DB::commit();
            return [
                'success' => true,
                'message' => 'Endereço registrado'
            ];
        } else {
            DB::rollback();

            return [
                'success' => false,
                'message' => 'Falha ao registrar'
            ];
        }
    }

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'enderecos_clientes','cli_codigo','end_codigo');
    }

    public function funcionarios()
    {
        return $this->belongsToMany(Funcionario::class,'enderecos_funcionarios','fun_codigo','end_codigo');
    }
}
