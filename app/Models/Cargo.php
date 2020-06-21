<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Cargo extends Model
{
    public $timestamps = false;
    protected $table = "cargos";
    protected $primaryKey = 'car_codigo';
    public $incrementing = true;

    public function salvar()
    {
        DB::beginTransaction();

        $cargo = $this->save();

        if ($cargo) {
            DB::commit();
            return [
                'success' => true,
                'message' => 'Cargo registrado'
            ];
        } else {
            DB::rollback();

            return [
                'success' => false,
                'message' => 'Falha ao registrar'
            ];
        }
    }


    public function funcionarios()
    {
        return $this->hasMany(Funcionario::class,'car_codigo');
    }
}
