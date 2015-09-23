<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSTARTEDATToStudentProgressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('studentprogress', function(Blueprint $table)
		{			
			$table->datetime('started_at')->after('flag')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('studentprogress', function(Blueprint $table)
		{
			$table->dropColumn('started_at');
		});
	}

}
