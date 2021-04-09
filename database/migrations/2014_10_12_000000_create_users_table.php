<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->date('dateofbirth');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->enum('type', ['regular', 'bill']);
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            ['id' => 1, 'firstname' => 'KW Hydro', 'lastname' => 'KW Hydro', 'dateofbirth' => '1990-01-01', 'gender' => 'other', 'type' => 'bill', 'username' => 'kwhydro', 'email' => 'kwhydro@bills.com', 'password' => 'kwhydro'],
            ['id' => 2, 'firstname' => 'Kitchener Utilities', 'lastname' => 'Kitchener Utilities', 'dateofbirth' => '1990-01-01', 'gender' => 'other', 'type' => 'bill', 'username' => 'KitchenerUtilities', 'email' => 'KitchenerUtilities@bills.com', 'password' => 'KitchenerUtilities'],
            ['id' => 3, 'firstname' => 'Home Rental', 'lastname' => 'Home Rental', 'dateofbirth' => '1990-01-01', 'gender' => 'other', 'type' => 'bill', 'username' => 'HomeRental', 'email' => 'HomeRental@bills.com', 'password' => 'HomeRental'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
