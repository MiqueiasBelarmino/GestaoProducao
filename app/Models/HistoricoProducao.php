<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricoProducao extends Model
{
    public $timestamps = false;
    protected $table = "historico_producao";
    protected $primaryKey = 'his_pro_codigo';
}
