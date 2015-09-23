<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseSprintTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coursesprint', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->integer('course')->unsigned();
			$table->integer('sprint')->unsigned();			
			$table->datetime('created_at');
			$table->datetime('updated_at');
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('coursesprint');
	}

}
