<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Fornecedor extends Model
{
    public $timestamps = false;
    
    protected $table = "fornecedores";
    protected $primaryKey = 'for_codigo';
    public $incrementing = true;


    public function getForCpfCnpj()//XX. XXX. XXX/XXXX-XX
    {
        $cpf = $this->attributes['for_cpf_cnpj'];
        if(strlen($cpf) == 11)
        {
            $cpf = substr($cpf,0,3).'.'.substr($cpf,3,3).'.'.substr($cpf,7,3).'-'.substr($cpf,-2);
        }else
        {
            $cpf = substr($cpf,0,2).'.'.substr($cpf,2,3).'.'.substr($cpf,5,3).'/'.substr($cpf,8,4).'-'.substr($cpf,-2);
        }
        return $cpf;
    }

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
