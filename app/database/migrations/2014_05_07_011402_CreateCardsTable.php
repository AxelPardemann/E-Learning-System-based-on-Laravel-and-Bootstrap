<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cards', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('sprint')->unsigned();
			$table->string('name');
			$table->text('description');
			$table->string('card_type', 20);

			$table->string('f_text')->nullable();
			$table->tinyInteger('f_sound_option');
            $table->string('f_sound')->nullable();
			$table->string('f_sound_path')->nullable();
			$table->tinyInteger('f_image_option');
            $table->string('f_image')->nullable();
			$table->string('f_image_path')->nullable();

			$table->string('b_text')->nullable();
			$table->tinyInteger('b_sound_option');
            $table->string('b_sound')->nullable();
			$table->string('b_sound_path')->nullable();
			$table->tinyInteger('b_image_option');
            $table->string('b_image')->nullable();
			$table->string('b_image_path')->nullable();
			
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
		Schema::drop('cards');
	}

}
