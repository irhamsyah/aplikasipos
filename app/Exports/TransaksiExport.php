<?php

namespace App\Exports;
use DB;
use App\Models\Transaksi;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransaksiExport implements FromView
{
    /*
    /* @return \Illuminate\Support\Collection */
    // use ExpoExportable;
    public function view(): View
    {
        return view('export.tempexport', [
            'transaksi' => Transaksi::all()
        ]);
    }
}
