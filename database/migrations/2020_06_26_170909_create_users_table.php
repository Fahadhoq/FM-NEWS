<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('first_name' , 128);
            $table->string('last_name' , 128);
            $table->string('full_name' , 128);
            $table->string('user_name' , 128);
            $table->string('image');
            $table->string('email')->unique();
            $table->tinyInteger('email_verified')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verification_token')->nullable();
            $table->string('password' , 96);
            $table->string('phone' , 11)->unique();
            $table->tinyInteger('role_id')->default(1);
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('is_pay')->default(0);
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
