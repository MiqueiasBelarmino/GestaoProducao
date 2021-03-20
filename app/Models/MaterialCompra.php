<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class MaterialCompra extends Model
{
    public $timestamps = false;
    protected $table = "material_compra";
    protected $primaryKey = ['com_codigo', 'mat_codigo'];
    public $incrementing = false;

    protected $casts = [
        'mat_codigo' => 'int',
        'com_codigo' => 'int',
        'mat_com_valor' => 'float',
        'mat_com_quantidade' => 'int'
    ];

    protected $fillable = [
        'mat_com_valor',
        'mat_com_quantidade'
    ];

    public function salvar()
    {
        DB::beginTransaction();

        $item = $this->save();

        if ($item) {
            DB::commit();
            return true;
        } else {
            DB::rollback();
            return false;
        }
    }

   
    public function material()
    {
        return $this->belongsTo(Material::class, 'mat_codigo');
    }

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'com_codigo');
    }
}
