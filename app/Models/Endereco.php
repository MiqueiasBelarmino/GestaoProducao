<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    public $timestamps = false;

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'enderecos_clientes');
    }

    public function funcionarios()
    {
        return $this->belongsToMany(Funcionario::class, 'enderecos_funcionarios');
    }
}
