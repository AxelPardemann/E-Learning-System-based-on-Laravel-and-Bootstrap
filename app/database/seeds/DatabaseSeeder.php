<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		//$this->call('SentrySeeder');
        //$this->command->info('Sentry tables seeded!');
 
        //$this->call('UserTableSeeder');
        //$this->command->info('Content tables seeded!');
	}

}