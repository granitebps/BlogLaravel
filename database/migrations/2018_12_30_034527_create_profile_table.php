<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('avatar')->nullable();
            $table->text('user_about')->nullable();
            $table->text('address')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('instagram')->default('https://www.instagram.com');
            $table->string('facebook')->default('https://www.facebook.com');
            $table->string('twitter')->default('https://www.twitter.com');
            $table->string('linkedin')->default('https://www.linkedin.com');
            $table->string('youtube')->default('https://www.youtube.com');
            $table->string('github')->default('https://www.github.com');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile');
    }
}
