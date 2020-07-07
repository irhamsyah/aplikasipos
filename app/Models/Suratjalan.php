<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suratjalan extends Model
{
    protected $table='suratjalans';
    protected $fillable =['barang_id','nama_brg','qty','isi_persatuan','nota'];
}
