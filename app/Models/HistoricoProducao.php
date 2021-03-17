<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricoProducao extends Model
{
    public $timestamps = false;
    protected $table = "historico_producoes";
	protected $primaryKey = 'his_pro_codigo';
    // protected $primaryKey = ['his_pro_codigo','ped_codigo','proc_codigo'];

	protected $casts = [
		'ped_codigo' => 'int',
		'proc_codigo' => 'int'
	];

	protected $dates = [
		'his_pro_data_entrada',
		'his_pro_data_saida'
	];

	protected $fillable = [
		'his_pro_data_entrada',
		// 'his_pro_data_saida',
		'his_pro_observacao'
	];

    public function pedido()
	{
		return $this->belongsTo(Pedido::class, 'ped_codigo');
	}

	public function processo()
	{
		return $this->belongsTo(Processo::class, 'proc_codigo');
	}

}
