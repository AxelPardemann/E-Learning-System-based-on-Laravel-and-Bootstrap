<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddMasteredCardsToStudentProgressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('studentprogress', function(Blueprint $table)
		{			
			$table->string('masteredCards')->after('totalCards');
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
			$table->dropColumn('masteredCards');
		});
	}

}
