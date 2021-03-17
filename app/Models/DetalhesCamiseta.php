<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetalhesCamisetum
 * 
 * @property int $det_cam_codigo
 * @property int $prod_codigo
 * @property int $det_cam_manga_tipo
 * @property int $det_cam_manga_tamanho
 * @property int $det_cam_manga_cor
 * @property int $det_cam_manga_galao
 * @property int $det_cam_gola_tipo
 * @property int $det_cam_gola_decote
 * @property int $det_cam_bolso_frente
 * 
 * @property Produto $produto
 *
 * @package App\Models
 */
class DetalhesCamiseta extends Model
{
	protected $table = 'detalhes_camiseta';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'det_cam_codigo' => 'int',
		'prod_codigo' => 'int',
		'det_cam_manga_tipo' => 'int',
		'det_cam_manga_tamanho' => 'int',
		'det_cam_manga_galao' => 'int',
		'det_cam_gola_tipo' => 'int',
		'det_cam_gola_decote' => 'int',
		'det_cam_bolso_frente' => 'int'
	];

	protected $fillable = [
		'det_cam_manga_tipo',
		'det_cam_manga_tamanho',
		'det_cam_manga_cor',
		'det_cam_manga_galao',
		'det_cam_gola_tipo',
		'det_cam_gola_decote',
		'det_cam_bolso_frente'
	];

	public function produto()
	{
		return $this->belongsTo(Produto::class, 'prod_codigo');
	}
}
