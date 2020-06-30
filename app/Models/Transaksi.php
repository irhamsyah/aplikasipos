<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //Fungsi dibawah menyatakan bahwa Tabel barang punya relasi ke Tabel transaksi
    //melaui ParentaKey barang_id pada Table  barang, artinya tabel transaksi punya barang
    protected $table ='transaksi';

    protected $fillable=['barang_id','nama_brg','jumlah_transaksi','jumlah_item_trans','tgl_trans','discount'];

    public function barang(){

        return $this->belongsTo('App\Models\Barang');
        
    }

    public function pembelis(){

        return $this->belongsTo('App\Models\Pembeli');
        
    }


}
