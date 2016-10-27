<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAddMedFkOnReplies extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meds__replies', function(Blueprint $table)
        {
			$table->integer('med_id')->unsigned()->after('user_id');
			$table->tinyInteger('is_public')->default(0)->after('status');
			
			$table->foreign('med_id')->references('id')->on('meds__meds')->onDelete('cascade');
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
			$table->dropForeign('meds__replies_med_id_foreign');
			$table->dropColumn('med_id');
			$table->dropColumn('is_public');
        });
    }

}
