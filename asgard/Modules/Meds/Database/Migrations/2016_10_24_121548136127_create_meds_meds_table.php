<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedsMedsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('meds__meds', function(Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->integer('patient_id')->unsigned();
			$table->integer('reply_id')->unsigned();
			$table->string('name');
			$table->string('category');
			$table->string('active_sub');
			$table->string('dosage');
			$table->smallInteger('package');
			$table->string('qty');
			$table->tinyInteger('urgent');
			$table->string('unavail_at');
			$table->string('manufacturer');
			$table->string('country')->nullable();
            $table->timestamps();
			
			$table->foreign('patient_id')->references('id')->on('meds__patients')->onDelete('cascade');
			$table->foreign('reply_id')->references('id')->on('meds__replies')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('meds__meds');
	}
}
