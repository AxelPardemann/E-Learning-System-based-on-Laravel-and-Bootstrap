<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTextOptionToSubCardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sub_cards', function(Blueprint $table)
		{			
			$table->string('b_text_option')->after('cards');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sub_cards', function(Blueprint $table)
		{
			$table->dropColumn('b_text_option');
		});
	}

}
