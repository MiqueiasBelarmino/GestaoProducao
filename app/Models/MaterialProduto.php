<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class MaterialProduto extends Model
{
    public $timestamps = false;
    protected $table = "material_produtos";
    protected $primaryKey = ['mat_codigo', 'prod_codigo'];
    public $incrementing = false;

    protected $casts = [
        'mat_codigo' => 'int',
        'prod_codigo' => 'int',
        'mat_pro_valor' => 'float',
        'mat_pro_quantidade' => 'int'
    ];

    protected $fillable = [
        'mat_pro_valor',
        'mat_pro_quantidade'
    ];

    public function salvar()
    {
        DB::beginTransaction();

        $material = $this->save();

        if ($material) {
            DB::commit();
            return [
                'success' => true,
                'message' => 'Material registrado'
            ];
        } else {
            DB::rollback();
            return [
                'success' => false,
                'message' => 'Falha ao registrar'
            ];
        }
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'mat_codigo');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'prod_codigo');
    }
}
