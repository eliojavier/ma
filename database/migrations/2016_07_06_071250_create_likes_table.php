<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('motivador')->unsigned()->default(0);
            $table->integer('interesante')->unsigned()->default(0);
            $table->integer('satisfactorio')->unsigned()->default(0);
            $table->integer('informativo')->unsigned()->default(0);
            $table->integer('soso')->unsigned()->default(0);
            $table->integer('aburrido')->unsigned()->default(0);

            $table->integer('user_id')->unsigned()->index();
            $table->integer('post_id')->unsigned()->index();

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
        Schema::drop('likes');
    }
}
