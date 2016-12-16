<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueUserReplies extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meds__replies', function(Blueprint $table)
        {
			$table->unique(['user_id', 'med_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meds__replies', function(Blueprint $table)
        {
			$table->dropUnique('meds__replies_user_id_med_id_unique');
        });
    }

}
