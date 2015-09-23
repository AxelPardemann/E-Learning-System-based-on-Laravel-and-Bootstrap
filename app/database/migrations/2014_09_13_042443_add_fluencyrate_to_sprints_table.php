<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFluencyrateToSprintsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sprints', function(Blueprint $table)
		{			
			$table->integer('fluency_rate')->after('description')->unsigned();
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
			$table->dropColumn('fluency_rate');
		});
	}

}
