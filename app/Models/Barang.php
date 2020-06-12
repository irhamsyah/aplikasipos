<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //
    protected $table ='barang';
    protected $primaryKey='kode_brg';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['kode_brg', 'nama_brg','harga_brg','harga_jual','harga_jual_reseller','satuan','isi_persatuan','jumlah_brg'];

    //Fungsi dibawah menyatakan bahwa  tabel barang punya relasi ke Tabel transaksi 
    //Relasi One -> To Many melaui foreignkey barang_id pada Table  transaksi

    public function transaksi()
    {
        return $this->hasMany('App\Transaksi', 'barang_id', 'barang_id');
    }

}
