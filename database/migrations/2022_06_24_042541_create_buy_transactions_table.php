<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id');
            $table->string('forex_id')->references('id')->on('forexes');
            $table->integer('jumlah');
            $table->integer('harga_satuan');
            $table->integer('total');
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
        Schema::dropIfExists('buy_transactions');
    }
};
