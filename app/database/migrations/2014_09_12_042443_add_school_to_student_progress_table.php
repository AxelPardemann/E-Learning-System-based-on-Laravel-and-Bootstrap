<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSchoolToStudentProgressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('studentprogress', function(Blueprint $table)
		{			
			$table->integer('school')->after('id')->unsigned();
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
			$table->dropColumn('school');
		});
	}

}
