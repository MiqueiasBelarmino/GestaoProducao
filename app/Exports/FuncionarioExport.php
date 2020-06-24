<?php

namespace App\Exports;

use App\Models\Funcionario;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class FuncionarioExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Funcionario::all();
    // }
    use Exportable;

    public function view(): View
    {
        return view('admin.funcionario.pdf', [
            'funcionarios' => Funcionario::all()
        ]);
    }
}
