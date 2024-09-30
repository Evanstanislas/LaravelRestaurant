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
        Schema::create('food_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_id')->constrained()->onDelete('cascade');
            $table->string('transactions_id', 10);
            $table->foreign('transactions_id')->references('transactions_id')->on('transactions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_transactions');
    }
};
