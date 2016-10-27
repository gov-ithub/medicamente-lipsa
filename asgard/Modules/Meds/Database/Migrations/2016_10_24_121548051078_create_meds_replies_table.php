<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedsRepliesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('meds__replies', function(Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->tinyInteger('category')->default(0);
			
			$table->text('cause');
            $table->text('action');
            $table->date('deadline')->nullable();

			$table->tinyInteger('status');
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
		Schema::drop('meds__replies');
	}
}
