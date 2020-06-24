<?php

namespace App\Exports;

use App\Models\Cliente;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ClienteExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Cliente::all();
    // }
    use Exportable;

    public function view(): View
    {
        return view('admin.cliente.pdf', [
            'clientes' => Cliente::all()
        ]);
    }
}
