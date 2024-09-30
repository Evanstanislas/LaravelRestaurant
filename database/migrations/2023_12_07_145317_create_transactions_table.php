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
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('transactions_id', 10)->unique()->primary();
            $table->string('fullname')->required;
            $table->string('phonenumber')->required;
            $table->string('address')->required;
            $table->string('city')->required;
            $table->string('cardname')->required;
            $table->string('cardnumber')->required;
            $table->string('country')->required;
            $table->string('zip')->required;
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('receipt')->required;
            $table->date('date')->required;
            $table->integer('total')->required;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
