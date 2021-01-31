<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Pedido extends Model
{
    protected $table = 'pedidos';
	protected $primaryKey = 'ped_codigo';
    public $timestamps = false;
    public $incrementing = true;

    public function salvar()
    {
        DB::beginTransaction();

        $pedido = $this->save();

        if ($pedido) {
            DB::commit();
            return [
                'success' => true,
                'message' => 'Pedido registrado'
            ];
        } else {
            DB::rollback();

            return [
                'success' => false,
                'message' => 'Falha ao registrar'
            ];
        }
    }

	protected $casts = [
		'cli_codigo' => 'int',
		'fun_codigo' => 'int',
		'ped_total' => 'float'
	];

	protected $dates = [
		'ped_data',
		'ped_data_aprovacao',
		'ped_data_entrega'
	];

	protected $fillable = [
		'cli_codigo',
		'fun_codigo',
		'ped_total',
		'ped_data',
		'ped_data_aprovacao',
		'ped_data_entrega',
		'ped_status',
		'ped_observacao'
	];
}
