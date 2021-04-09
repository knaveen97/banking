<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('from_user_id')->unsigned();
            $table->bigInteger('to_user_id')->unsigned();
            $table->bigInteger('from_account_id')->unsigned();
            $table->bigInteger('to_account_id')->unsigned();
            $table->float('amount', 12, 2);
            $table->enum('trans_type', ['transfer', 'bill']);
            $table->timestamps();
            $table->foreign('from_user_id')
                    ->references('id')
                    ->on('users');
            $table->foreign('to_user_id')
                    ->references('id')
                    ->on('users');
            $table->foreign('from_account_id')
                    ->references('id')
                    ->on('accounts');
            $table->foreign('to_account_id')
                    ->references('id')
                    ->on('accounts');
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
}
