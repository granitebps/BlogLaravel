<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('post_id');
            $table->string('post_title');
            $table->string('post_slug');
            $table->text('post_content');
            $table->string('featured');
            $table->integer('category_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('publish')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('category_id')->on('category');
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
        Schema::dropIfExists('post');
    }
}
