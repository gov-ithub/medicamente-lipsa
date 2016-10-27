<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedsRecipesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('meds__recipes', function(Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->integer('patient_id')->unsigned();
			$table->tinyInteger('required');
			$table->string('issued_by')->nullable();
			$table->string('doctor')->nullable();
			$table->string('phone', 20);
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
		Schema::drop('meds__recipes');
	}
}
