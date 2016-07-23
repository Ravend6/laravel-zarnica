<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('receiver_id')->unsigned()->nullable();
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
            //
            $table->boolean('is_read')->default(0);
            $table->boolean('type')->default(0); // 0 - отправлен, 1 - получен
            $table->text('body');

            // $table->integer('author_id')->unsigned()->nullable();
            // $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            //
            // $table->boolean('is_read')->default(0);
            // $table->text('body');

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
        Schema::drop('messages');
    }
}
