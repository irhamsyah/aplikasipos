<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResellerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reseller', function (Blueprint $table) {
            $table->id();
            $table->string('no_ktp',30)->nullable();    
            $table->string('nama_reseller',79)->nullable();
            $table->string('alamat',150)->nullable();
            $table->string('email',65)->nullable();
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
        Schema::dropIfExists('reseller');
    }
}
