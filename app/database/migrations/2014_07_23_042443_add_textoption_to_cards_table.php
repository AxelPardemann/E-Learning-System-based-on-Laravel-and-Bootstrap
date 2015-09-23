<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTextOptionToCardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cards', function(Blueprint $table)
		{			
			$table->string('f_text_option')->after('card_type');
			$table->string('b_text_option')->after('f_image_path');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cards', function(Blueprint $table)
		{
			$table->dropColumn('f_text_option');
			$table->dropColumn('b_text_option');
		});
	}

}
