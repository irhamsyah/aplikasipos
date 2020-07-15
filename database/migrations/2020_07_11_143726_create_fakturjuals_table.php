<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakturjualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fakturjuals', function (Blueprint $table) {
            $table->id();
            $table->string('barang_id',30)->nullable();
            $table->string('nama_brg',100)->nullable();
            $table->integer('qty')->default(0);
            $table->decimal('harga_jual',9,2)->default(0.00);
            $table->decimal('jumlah_transaksi',10,2)->default(0);
            $table->decimal('discount',3,2)->default(0.00);
            $table->string('nota',70)->nullable();
            $table->string('nama',70)->nullable();
            $table->string('alamat',100)->nullable();
            $table->date('tgl_jt_bayar')->nullable();
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
        Schema::dropIfExists('fakturjuals');
    }
}
