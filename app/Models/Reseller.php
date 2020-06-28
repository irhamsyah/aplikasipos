<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    //
    protected $table ='reseller';
    protected $primaryKey='no_ktp';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['no_ktp', 'nama_reseller','alamat','email'];

    //Fungsi dibawah menyatakan bahwa tabel reseller punya relasi ke Tabel transaksiresellers 
    //Relasi One -> To Many melaui foreignkey barang_id pada Table  transaksiresellers
    public function transaksiresellers()
    {
        return $this->hasMany('App\Models\Transaksireseller', 'no_ktp', 'no_ktp');
    }

}
