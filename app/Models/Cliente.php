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
    protected $fillable = [
        'cli_nome_razao_social',
        'cli_nome_social_fantasia',
        'cli_rg_inscricao_estadual',
        'cli_cpf_cnpj',
        'cli_telefone',
        'cli_email',
        'cli_observacao'
    ];

    

    

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

    // public function enderecos()
    // {
    //     return $this->belongsToMany(Endereco::class, 'enderecos_clientes', 'cli_codigo', 'end_codigo');
    // }
    public function enderecos()
    {
        return $this->belongsToMany(Endereco::class, 'enderecos_clientes', 'cli_codigo', 'end_codigo')
            ->withPivot('end_cli_observacao');
    }


    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'cli_codigo');
    }
}
