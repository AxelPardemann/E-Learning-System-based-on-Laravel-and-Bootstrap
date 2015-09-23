<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassStudentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classstudent', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->integer('school')->unsigned();
			$table->integer('user')->unsigned();
			$table->integer('class')->unsigned();
			$table->integer('complete');
			$table->datetime('date_joined');
			$table->datetime('date_completed');
			$table->datetime('created_at');
			$table->datetime('updated_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('classstudent');
	}

}
