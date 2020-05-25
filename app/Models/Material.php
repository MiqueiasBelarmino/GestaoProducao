<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public $timestamps = false;

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }
}
