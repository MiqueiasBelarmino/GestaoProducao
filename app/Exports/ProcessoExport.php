<?php

namespace App\Exports;

use App\Models\Processo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ProcessoExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        return view('admin.processo.pdf', [
            'processos' => Processo::all()
        ]);
    }
}
