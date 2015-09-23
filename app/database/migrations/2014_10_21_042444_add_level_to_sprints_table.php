<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddLevelToSprintsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sprints', function(Blueprint $table)
		{			
			$table->integer('level')->after('fluency_rate')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sprints', function(Blueprint $table)
		{
			$table->dropColumn('level');
		});
	}

}
