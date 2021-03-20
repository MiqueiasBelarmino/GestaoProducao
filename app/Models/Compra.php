<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    public $timestamps = false;
    protected $table = "compras";
    protected $primaryKey = 'com_codigo';
    public $incrementing = true;

   
    public function enderecos()
    {
        return $this->belongsToMany(Material::class, 'material_compra', 'com_codigo', 'mat_codigo')
            ->withPivot('mat_com_quantidade','mat_com_custo');
    }

}
