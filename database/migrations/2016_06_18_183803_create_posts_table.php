<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            /** Field for main image. */
            $table->integer('media_id')->nullable()->unsigned()->index();

            $table->integer('category_id')->unsigned()->index();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('body');
            $table->string('author');
            $table->boolean('visibility')->default(1);
            $table->timestamp('published_date');
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
        Schema::drop('posts');
    }
}
