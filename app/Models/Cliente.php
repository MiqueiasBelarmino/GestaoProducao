<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Cliente extends Model
{
    public $timestamps = false;
    protected $table = "clientes";
    protected $primaryKey = 'cli_codigo';
    public $incrementing = true;

    public function salvar()
    {
        DB::beginTransaction();

        $cliente = $this->save();

        if ($cliente) {
            DB::commit();
            return [
                'success' => true,
                'message' => 'Cliente registrado'
            ];
        } else {
            DB::rollback();

            return [
                'success' => false,
                'message' => 'Falha ao registrar'
            ];
        }
    }

    public function enderecos()
    {
        return $this->belongsToMany(Endereco::class,'enderecos_clientes','cli_codigo','end_codigo');
    }
}
