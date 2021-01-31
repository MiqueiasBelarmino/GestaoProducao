<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
/**
 * Class ItemPedido
 * 
 * @property int $prod_codigo
 * @property int $ped_codigo
 * @property int $ite_ped_quantidade
 * @property string|null $ite_ped_cor
 * @property float $ite_ped_valor
 * @property string $ite_ped_observacao
 * 
 * @property Pedido $pedido
 * @property Produto $produto
 *
 * @package App\Models
 */
class ItemPedido extends Model
{
	protected $table = 'item_pedido';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'prod_codigo' => 'int',
		'ped_codigo' => 'int',
		'ite_ped_quantidade' => 'int',
		'ite_ped_valor' => 'float'
	];

	protected $fillable = [
		'ite_ped_quantidade',
		'ite_ped_cor',
		'ite_ped_valor',
		'ite_ped_observacao'
	];

	public function salvar()
    {
        DB::beginTransaction();

        $item = $this->save();

        if ($item) {
            DB::commit();
            return [
                'success' => true,
                'message' => 'Item registrado'
            ];
        } else {
            DB::rollback();
            return [
                'success' => false,
                'message' => 'Falha ao registrar'
            ];
        }
    }

	public function pedido()
	{
		return $this->belongsTo(Pedido::class, 'ped_codigo');
	}

	public function produto()
	{
		return $this->belongsTo(Produto::class, 'prod_codigo');
	}
}
