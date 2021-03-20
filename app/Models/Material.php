<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Material extends Model
{
    public $timestamps = false;
    protected $table = "materiais";
    protected $primaryKey = 'mat_codigo';
    public $incrementing = true;

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


    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class, 'for_codigo');
    }

    public function materiais()
    {
        return $this->belongsToMany(MaterialProduto::class,'material_produtos','mat_codigo',['mat_codigo','prod_codigo']);
    }

    public function materiais_compra()
    {
        return $this->belongsToMany(COmpra::class,'material_compra','mat_codigo',['com_codigo','mat_codigo']);
    }
}
