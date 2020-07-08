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
    use Exportable;
    public function fordate($tgl1, $tgl2)
    {
        $this->tgl1 = $tgl1;
        $this->tgl2 = $tgl2;

        return $this;
    }

    public function query()
    {
        return Transaksi::query()->whereDate('tgl_trans','>=', $this->tgl1)
                               ->whereDate('tgl_trans','<=', $this->tgl2);

    }

}
