<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usertype', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 20);
			$table->text('permission');
		});

		DB::table('usertype')->insert(
			array(
					array('name' => 'administrator', 'permission'=>'this is role for system administrator'),
					array('name' => 'teacher', 'permission'=>'this is role for Teacher'),
					array('name' => 'student', 'permission'=>'this is role for student'),                                
			));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usertype');
		DB::table('usertype')->delete();
	}

}
