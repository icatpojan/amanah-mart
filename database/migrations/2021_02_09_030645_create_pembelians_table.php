<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('kulakan_id');
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->string('merek');
            $table->integer('jumlah_product');
            $table->integer('harga');
            $table->integer('harga_jual');
            $table->integer('jumlah_harga');
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('pembelians');
    }
}
