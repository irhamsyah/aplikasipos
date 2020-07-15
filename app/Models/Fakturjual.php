<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fakturjual extends Model
{
    //
    protected $table='fakturjuals';
    protected $fillable=['barang_id','nama_brg','qty','harga_jual','jumlah_transaksi','discount','nota','nama','alamat','tgl_jt_bayar'];

}
