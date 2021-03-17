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
        'ped_status_pagamento',
        'ped_observacao'
    ];

    public function getDataFormatada($value)
    {
        if ($value != null)
            return $value->format('d/m/Y');
        return $value;
    }
    public function confirmaQuitacao($id)
    {
        DB::table($this->table)
            ->where('id', $id)
            ->update(['ped_status_pagamento' => 'Pago']);
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cli_codigo');
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'fun_codigo');
    }

    public function historico_producao()
    {
        return $this->hasMany(HistoricoProducao::class, 'ped_codigo');
    }

    public function item_pedidos()
    {
        return $this->hasMany(ItemPedido::class, 'ped_codigo');
    }

    public function pagamentos()
    {
        return $this->hasMany(Pagamento::class, 'ped_codigo');
    }
}
