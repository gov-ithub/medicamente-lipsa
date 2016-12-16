<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMedsNotifications extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meds__notifications', function(Blueprint $table)
        {
            $table->increments('id');
			$table->integer('patient_id')->unsigned();
			$table->string('email');
            $table->timestamps();
			
			$table->foreign('patient_id')->references('id')->on('meds__patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('meds__notifications');
    }

}
