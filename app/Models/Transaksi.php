<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //Fungsi dibawah menyatakan bahwa Tabel barang punya relasi ke Tabel transaksi
    //melaui ParentaKey barang_id pada Table  barang, artinya tabel transaksi punya barang

    public function barang(){

    	return $this->belongsTo('App\Barang');
    }

}
