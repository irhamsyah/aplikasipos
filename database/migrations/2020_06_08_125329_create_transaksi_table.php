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
            $table->string('kode_brg',30);
        $table->foreign('kode_brg')->references('kode_brg')->on('barang');            
            $table->string('nama_brg',75);
            $table->decimal('bayar',8,0)->default(0);
            $table->integer('jumlah_item_trans')->unsigned();
            $table->date('created_at', 0);
            $table->date('updateed_at',0);
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
