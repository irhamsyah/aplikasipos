<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('barang_id',30);
            $table->foreign('barang_id')->references('barang_id')->on('barang');            
            $table->string('nama_brg',75);
            $table->decimal('jumlah_transaksi',8,0)->default(0);
            $table->integer('jumlah_item_trans')->unsigned();
            $table->date('tgl_trans')->default(null);
            $table->integer('discount');
            $table->string('nota',40)->nullable();
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
        Schema::dropIfExists('transaksi');
    }
}
