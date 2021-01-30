<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Produto extends Model
{
    public $timestamps = false;
    protected $table = "produtos";
    protected $primaryKey = 'prod_codigo';
    public $incrementing = true;

    public function salvar()
    {
        DB::beginTransaction();

        $material = $this->save();

        if ($material) {
            DB::commit();
            return [
                'success' => true,
                'message' => 'Produto registrado'
            ];
        } else {
            DB::rollback();

            return [
                'success' => false,
                'message' => 'Falha ao registrar'
            ];
        }
    }


    // public function fornecedor()
    // {
    //     return $this->belongsTo(Fornecedor::class, 'for_codigo');
    // }
}
