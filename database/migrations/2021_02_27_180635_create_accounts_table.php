<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->enum('type', ['chequing', 'savings', 'bill']);
            $table->float('balance', 12, 2);
            $table->timestamps();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
        });

        DB::table('accounts')->insert([
            ['user_id' => 1, 'type' => 'bill', 'balance' => 0],
            ['user_id' => 2, 'type' => 'bill', 'balance' => 0],
            ['user_id' => 3, 'type' => 'bill', 'balance' => 0],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
