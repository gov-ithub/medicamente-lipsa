<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedsContactsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('meds__contacts', function(Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->integer('patient_id')->unsigned();
			$table->string('first_name');
			$table->string('last_name');
			$table->string('phone', 20);
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
		Schema::drop('meds__contacts');
	}
}
