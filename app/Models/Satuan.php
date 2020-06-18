<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    //
    protected $table='satuan';
    protected $fillable=['nama_satuan'];

    public function barang()
    {
        return $this->hasMany('App\Models\Barang', 'satuan', 'id');

    }
}
