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

    protected $fillable = [
        'fun_nome', 'fun_rg',
        'fun_cpf','fun_email',
        'car_codigo','fun_comissao',
        'fun_telefone','fun_data_admissao',
        'fun_senha','fun_observacao',
    ];

    public function getFunCpf($value)
    {
       // $cpf = $this->attributes['fun_cpf'];
       $cpf = $value;
        $cpf = substr($cpf,0,3).'.'.substr($cpf,3,3).'.'.substr($cpf,7,3).'-'.substr($cpf,-2);
        return $cpf;
    }

    //recurso mutator
    public function formatarData($value)//getFunDataAdmissaoAttribute()
    {
        return Carbon::parse($this->attributes['fun_data_admissao'])->format('d/m/Y');
        //return Carbon::parse($value)->format('d/m/Y');
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

    public function enderecos()
    {
        return $this->belongsToMany(Endereco::class, 'enderecos_funcionarios');
    }

}
