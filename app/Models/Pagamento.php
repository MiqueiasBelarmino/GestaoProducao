<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pagamento
 * 
 * @property int $pag_codigo
 * @property int $ped_codigo
 * @property float $pag_valor
 * @property int $pag_parcela
 * @property Carbon $pag_data_vencimento
 * @property Carbon $pag_data_pagamento
 * 
 * @property Pedido $pedido
 *
 * @package App\Models
 */
class Pagamento extends Model
{
	protected $table = 'pagamentos';
	public $incrementing = true;
	public $timestamps = false;

	protected $casts = [
		'pag_codigo' => 'int',
		'ped_codigo' => 'int',
		'pag_valor' => 'float',
		'pag_parcela' => 'int'
	];

	protected $dates = [
		'pag_data_vencimento',
		'pag_data_pagamento'
	];

	protected $fillable = [
		'pag_valor',
		'pag_parcela',
		'pag_data_vencimento',
		'pag_data_pagamento'
	];

	public function pedido()
	{
		return $this->belongsTo(Pedido::class, 'ped_codigo');
	}
}
