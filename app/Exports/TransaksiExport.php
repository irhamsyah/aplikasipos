<?php

namespace App\Exports;

use App\Models\Transaksi;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class TransaksiExport implements FromQuery
{
    /*
    /* @return \Illuminate\Support\Collection */
    use ExpoExportable;
    public function query()
    {
        return Transaksi::query();
    }
}
