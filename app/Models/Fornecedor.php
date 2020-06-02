<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Fornecedor extends Model
{
    public $timestamps = false;
    
    protected $table = "fornecedores";
    protected $primaryKey = 'for_codigo';


    public function salvar()
    {
        DB::beginTransaction();

        $fornecedor = $this->save();

        if ($fornecedor) {
            DB::commit();
            return [
                'success' => true,
                'message' => 'Fornecedor registrado'
            ];
        } else {
            DB::rollback();

            return [
                'success' => false,
                'message' => 'Falha ao registrar'
            ];
        }
    }

    public function materiais()
    {
        return $this->hasMany(Material::class);
    }
}
