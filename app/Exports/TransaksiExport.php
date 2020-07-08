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
<<<<<<< HEAD
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

=======
    // use ExpoExportable;
    public function view(): View
    {
        return view('export.tempexport', [
            'transaksi' => Transaksi::all()
        ]);
>>>>>>> 0b86b91c7985603597d3c07406e6b0dd92b2c71a
    }

}
