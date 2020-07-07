<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratjalansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suratjalans', function (Blueprint $table) {
            $table->string('barang_id',30)->nullable();;
            $table->string('nama_brg')->nullable();;
            $table->integer('qty')->default(0);
            $table->integer('isi_persatuan')->default(0);
            $table->string('nota',50)->nullable();
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
        Schema::dropIfExists('suratjalans');
    }
}
