<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassCourseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classcourse', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->integer('class')->unsigned();
            $table->string('course', 255);
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
		Schema::drop('classcourse');
	}

}
