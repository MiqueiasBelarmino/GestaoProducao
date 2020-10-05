<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $primaryKey = 'end_codigo';
    public $incrementing = true;
    public $timestamps = false;

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'enderecos_clientes');
    }

    // public function funcionarios()
    // {
    //     return $this->belongsToMany(Funcionario::class, 'enderecos_funcionarios','fun_codigo','end_codigo');
    // }

    public function funcionarios()
    {
        return $this->belongsToMany(Funcionario::class,'enderecos_funcionarios','fun_codigo','end_codigo');
    }
}
