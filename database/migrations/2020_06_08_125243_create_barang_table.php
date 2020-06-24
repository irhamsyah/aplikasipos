<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $value1=0;
        Schema::create('barang', function (Blueprint $table) {
            // $table->id();
            $table->string('barang_id',30)->unique();
            $table->string('nama_brg',75);
            $table->decimal('harga_brg',7,0)->default(0);
            $table->decimal('harga_jual',7,0)->default(0);
            $table->decimal('harga_jual_reseller',7,0)->default(0);
            $table->bigInteger('satuan')->unsigned();
            $table->bigInteger('isi_persatuan')->unsigned();
            $table->bigInteger('jumlah_brg')->unsigned();
            $table->string('photo',150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
