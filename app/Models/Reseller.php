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

}
