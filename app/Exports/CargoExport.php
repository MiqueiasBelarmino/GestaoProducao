<?php

namespace App\Exports;

use App\Models\Cargo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class CargoExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Cargo::all();
    // }
    use Exportable;

    public function view(): View
    {
        return view('admin.cargos.pdf', [
            'cargos' => Cargo::all()
        ]);
    }
}
