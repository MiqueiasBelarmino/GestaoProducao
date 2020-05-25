<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public $timestamps = false;

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }
}
