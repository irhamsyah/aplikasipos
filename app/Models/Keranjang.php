<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    //
    protected $table ='keranjangs';
    // protected $primaryKey='barang_id';
    // public $incrementing = false;
    // protected $keyType = 'string';
    protected $fillable = ['barang_id', 'qty','hargadijual'];

    public function barang(){
        return $this->belongsTo('App\Models\Barang');
    }

}
