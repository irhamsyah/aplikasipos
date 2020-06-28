<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksireseller extends Model
{
    //
    protected $fillable=['barang_id','nama_brg','jumlah_transaksi','jumlah_item_trans','no_ktp','tgl_trans','discount'];

    public function barang(){
        return $this->belongsTo('App\Models\Barang');
    }

    public function reseller(){
        return $this->belongsTo('App\Models\Reseller');
    }

}
