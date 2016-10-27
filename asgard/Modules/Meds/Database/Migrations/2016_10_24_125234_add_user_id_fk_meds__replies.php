<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdFkMedsReplies extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meds__replies', function(Blueprint $table)
        {
			$table->integer('user_id')->unsigned()->after('id');
			
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
        Schema::table('', function(Blueprint $table)
        {

        });
    }

}
