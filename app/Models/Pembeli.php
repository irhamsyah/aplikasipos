<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    //
    protected $table ='pembelis';
    protected $primaryKey='nota';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['nota', 'nama','alamat','tgl_trans','tgl_jt_bayar'];

    //Fungsi dibawah menyatakan bahwa tabel barang punya relasi ke Tabel transaksi 
    //Relasi One -> To Many melaui foreignkey barang_id pada Table  transaksi

    public function transaksi()
    {
        return $this->hasMany('App\Models\Transaksi', 'nota', 'nota');
    }

}
