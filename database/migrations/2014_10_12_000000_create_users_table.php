<?php

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
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->string('avatar')->nullable();
            $table->string('status', 60)->default('active');
            $table->string('user_status')->nullable();
            $table->string('caption')->nullable();
            $table->string('token')->nullable();
            $table->integer('karma')->default(100);
            $table->string('ip')->nullable();
            $table->string('steam')->nullable();
            $table->boolean('sex')->default(0);
            $table->decimal('money', 10, 2)->default('0.00');
            $table->date('birthday')->nullable();
            $table->string('skype', 60)->nullable();
            $table->string('icq', 60)->nullable();
            // $table->timestamps();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
