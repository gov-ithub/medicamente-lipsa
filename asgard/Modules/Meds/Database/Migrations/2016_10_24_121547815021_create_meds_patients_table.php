<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedsPatientsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('meds__patients', function(Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('address');
			$table->string('phone', 20);
			$table->string('alt_phone', 20)->nullable();
			$table->string('email');
			$table->tinyInteger('role');
			$table->tinyInteger('status')->default(0);
			$table->tinyInteger('allow_contact');
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
		Schema::drop('meds__patients');
	}
}
