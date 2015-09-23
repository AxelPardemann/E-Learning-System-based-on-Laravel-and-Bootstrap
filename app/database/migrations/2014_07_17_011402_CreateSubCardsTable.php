<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sub_cards', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('cards')->unsigned();
			$table->string('answer')->nullable();
			$table->tinyInteger('b_sound_option');
			$table->string('b_sound')->nullable();
			$table->string('b_sound_path')->nullable();
			$table->tinyInteger('b_image_option');
			$table->string('b_image')->nullable();
			$table->string('b_image_path')->nullable();
			$table->tinyInteger('correctanswer');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sub_cards');
	}

}
