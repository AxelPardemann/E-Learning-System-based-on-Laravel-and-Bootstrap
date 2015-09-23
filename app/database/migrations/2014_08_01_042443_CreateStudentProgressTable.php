<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentProgressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('studentprogress', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->integer('user')->unsigned();
			$table->integer('sprint')->unsigned();
			$table->integer('correctCards');
			$table->integer('incorrectCards');
			$table->integer('totalCards');
			$table->string('speed', 10);
			$table->string('response', 5);
			$table->string('loops', 5);
			$table->string('maintenance', 5);
			$table->string('active', 5);
			$table->string('status', 10);
			$table->tinyInteger('flag');
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
		Schema::drop('studentprogress');
	}

}
