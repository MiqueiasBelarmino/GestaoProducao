<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetalhesCalca
 * 
 * @property int $det_cal_codigo
 * @property int $prod_codigo
 * @property int $det_cal_passadores
 * @property int $det_cal_elastico
 * @property int $det_cal_elastico_costas
 * @property int $det_cal_bolso_frente
 * @property int $det_cal_bolso_costas
 * @property int $det_cal_refletiva
 * 
 * @property Produto $produto
 *
 * @package App\Models
 */
class DetalhesCalca extends Model
{
	protected $table = 'detalhes_calca';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'det_cal_codigo' => 'int',
		'prod_codigo' => 'int',
		'det_cal_passadores' => 'int',
		'det_cal_elastico' => 'int',
		'det_cal_bolso_frente' => 'int',
		'det_cal_bolso_costas' => 'int',
		'det_cal_refletiva' => 'int'
	];

	protected $fillable = [
		'det_cal_passadores',
		'det_cal_elastico',
		'det_cal_bolso_frente',
		'det_cal_bolso_costas',
		'det_cal_refletiva'
	];

	public function produto()
	{
		return $this->belongsTo(Produto::class, 'prod_codigo');
	}
}
