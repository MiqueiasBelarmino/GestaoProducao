<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Processo extends Model
{
    public $timestamps = false;
    protected $table = "processos";
    protected $primaryKey = 'proc_codigo';
    public $incrementing = true;

    public function salvar()
    {
        DB::beginTransaction();

        $processo = $this->save();

        if ($processo) {
            DB::commit();
            return [
                'success' => true,
                'message' => 'Processo registrado'
            ];
        } else {
            DB::rollback();

            return [
                'success' => false,
                'message' => 'Falha ao registrar'
            ];
        }
    }


    public function getProcCodigo($codigo)
	{
		$processo = Processo::find($codigo);
		return $processo->proc_nome;
	}

    public function historico_producao()
    {
        return $this->hasMany(HistoricoProducao::class,'proc_codigo');
    }
}
