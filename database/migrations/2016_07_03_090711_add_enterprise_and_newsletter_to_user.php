<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnterpriseAndNewsletterToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
//            $table->integer('enterprise')->default(0);
            $table->integer('newsletter')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
//            $table->dropColumn('enterprise');
            $table->dropColumn('newsletter');
        });
    }
}
