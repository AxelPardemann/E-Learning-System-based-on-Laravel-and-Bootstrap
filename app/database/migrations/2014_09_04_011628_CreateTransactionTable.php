<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transaction', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->integer('user')->unsigned();
			$table->integer('school')->unsigned();
			$table->integer('sprint')->unsigned();
			$table->integer('card')->unsigned();
			$table->string('response_time', 10);			
			$table->tinyInteger('is_corrected');
			$table->tinyInteger('no_answer');
			$table->datetime('created_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transaction');
	}

}
