<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateReplyIdToMeds extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meds__meds', function(Blueprint $table)
        {
			$table->integer('reply_id')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meds__meds', function(Blueprint $table)
        {
			$table->integer('reply_id')->unsigned()->change();
        });
    }

}
