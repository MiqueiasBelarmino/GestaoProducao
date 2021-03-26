<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class PedidoView extends Model
{

    protected $table = 'pedido_detalhe';

    public function getDataFormatada($value)
    {
        if ($value == '0000-00-00' || $value == '')
            return "";
        return date_format(date_create($value),"d-m-Y");
    }
}
