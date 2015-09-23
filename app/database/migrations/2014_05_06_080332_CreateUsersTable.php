<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
            $table->increments('id');          
            $table->string('first', 25);
			$table->string('last', 25);
			$table->string('password', 65);
			$table->string('permission', 20);
			$table->string('email');
			$table->string('birthday');
			$table->string('country');
			$table->string('token', 255);
			$table->tinyInteger('published');
			$table->datetime('created_at');
			$table->datetime('updated_at');
		});

		DB::table('users')->insert(
			array(	
					array(	'published' => 1, 
							'first'=> 'liu',                               
							'last'=> 'yunfei',   
							'password'=> Hash::make('password'), 
							'permission'=> 'administrator', 
							'email'=> 'admin@gmail.com',
							'created_at'=> $date = date('Y-m-d H:i:s')), 
							
			));

		DB::table('users')->insert(
			array(	
					array(	'published' => 1, 
							'first'=> 'teacher',                               
							'last'=> 'teacher',   
							'password'=> Hash::make('password'), 
							'permission'=> 'teacher', 
							'email'=> 'teacher@gmail.com',
							'created_at'=> $date = date('Y-m-d H:i:s')), 
							
			));

		DB::table('users')->insert(
			array(	
					array(	'published' => 1, 
							'first'=> 'student',                               
							'last'=> 'student',   
							'password'=> Hash::make('password'), 
							'permission'=> 'student', 
							'email'=> 'student@gmail.com',
							'created_at'=> $date = date('Y-m-d H:i:s')), 
							
			));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
		DB::table('users')->delete();
	}

}
