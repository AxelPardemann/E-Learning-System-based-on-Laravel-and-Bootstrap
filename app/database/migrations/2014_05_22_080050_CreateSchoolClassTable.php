<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolClassTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('schoolclass', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
            $table->integer('school')->unsigned();
			$table->integer('class')->unsigned();
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
		Schema::drop('schoolclass');
	}

}
