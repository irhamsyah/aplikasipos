<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeranjangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id();
            $table->string('barang_id',30)->unique();
<<<<<<< HEAD
            $table->integer('qty')->default(0);
=======
            $table->integer('qty');
            $table->decimal('hargadijual',8,0)->default(0);
>>>>>>> 0b86b91c7985603597d3c07406e6b0dd92b2c71a
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
        Schema::dropIfExists('keranjangs');
    }
}
