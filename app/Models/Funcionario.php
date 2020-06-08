<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Funcionario extends Model
{
    public $timestamps = false;
    
    protected $table = "funcionarios";
    protected $primaryKey = 'fun_codigo';
    public $incrementing = true;


    public function salvar()
    {
        DB::beginTransaction();

        $funcionario = $this->save();

        if ($funcionario) {
            DB::commit();
            return [
                'success' => true,
                'message' => 'Funcionário registrado'
            ];
        } else {
            DB::rollback();

            return [
                'success' => false,
                'message' => 'Falha ao registrar'
            ];
        }
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class,'car_codigo');
    }

}
