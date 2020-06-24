<?php

namespace App\Exports;

use App\Models\Fornecedor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class FornecedorExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Fornecedor::all();
    // }
    use Exportable;

    public function view(): View
    {
        return view('admin.fornecedor.pdf', [
            'fornecedores' => Fornecedor::all()
        ]);
    }
}
