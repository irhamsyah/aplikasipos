<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //
    protected $table ='barang';
    protected $primaryKey='barang_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['barang_id', 'nama_brg','harga_brg','harga_jual','harga_jual_reseller','satuan','isi_persatuan','jumlah_brg','photo'];

    //Fungsi dibawah menyatakan bahwa tabel barang punya relasi ke Tabel transaksi 
    //Relasi One -> To Many melaui foreignkey barang_id pada Table  transaksi

    public function transaksi()
    {
        return $this->hasMany('App\Models\Transaksi', 'barang_id', 'barang_id');
    }

    //Fungsi dibawah menyatakan bahwa Tabel barang punya relasi ke Tabel satuan
    //melaui ParentaKey satuan pada Table  barang, artinya tabel barang punya satuan

    public function satuan(){

    	return $this->belongsTo('App\Models\Satuan');
    }

    public function getPhotoPathAttribute()
    {
        if ($this->photo !== '') {
            return url('/img/' . $this->photo);
        } else {
            return 'http://placehold.it/850x618';
        }
    }

}
