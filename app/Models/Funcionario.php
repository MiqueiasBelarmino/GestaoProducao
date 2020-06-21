<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Carbon\Carbon;
use DB;

class Funcionario extends Model implements AuthenticatableContract
{
    use Authenticatable;
    public $timestamps = false;
    protected $table = "funcionarios";
    protected $primaryKey = 'fun_codigo';
    public $incrementing = true;

    // protected $fillable = [
    //     'fun_nome', 'fun_rg',
    //     'fun_cpf','fun_email',
    //     'car_codigo','fun_comissao',
    //     'fun_telefone','fun_data_admissao',
    //     'fun_senha','fun_observacao',
    // ];


    //recurso mutator
    public function formatarData($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

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
