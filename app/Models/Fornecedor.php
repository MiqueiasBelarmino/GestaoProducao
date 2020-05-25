<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    public $timestamps = false;


    public function materiais()
    {
        return $this->hasMany(Material::class);
    }
}
