<?php

namespace App\Exports;

use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

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
        return DB::table('barang')
        ->join('transaksi','barang.barang_id','=','transaksi.barang_id')
        ->select('transaksi.barang_id','transaksi.nama_brg','transaksi.tgl_trans','barang.harga_brg','barang.harga_jual','transaksi.discount',DB::raw('SUM(transaksi.jumlah_transaksi) as jumlah_transaksi'),DB::raw('SUM(transaksi.jumlah_item_trans) as jumlah_item_trans'))
        ->whereDate('transaksi.tgl_trans','>=',$this->tgl1)
        ->whereDate('transaksi.tgl_trans','<=',$this->tgl2)
        ->groupBy('transaksi.barang_id','transaksi.nama_brg','transaksi.tgl_trans','transaksi.discount','barang.harga_brg','barang.harga_jual')
        ->orderBy('transaksi.tgl_trans');

        // return Transaksi::query()->whereDate('tgl_trans','>=', $this->tgl1)
        //                        ->whereDate('tgl_trans','<=', $this->tgl2);

    }

}
