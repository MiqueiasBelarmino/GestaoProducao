<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class HistoricoView extends Model
{

    protected $table = 'historico';

    public function getHisProDataSaida($value)
    {
        if ($value == '0000-00-00')
            return "";
        return $value;
    }
}
