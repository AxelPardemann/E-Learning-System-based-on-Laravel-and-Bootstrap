<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('country', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->string('name', 255);
		});

		DB::table('country')->insert(
			array( array(	'name'=> 'United States', )));

		DB::table('country')->insert(
			array(	array(	'name'=> 'United Kingdom', )));

		DB::table('country')->insert(
			array(	array(	'name'=> 'Afghanistan', )));

		DB::table('country')->insert(
			array(	array(	'name'=> 'Aland Islands', )));

		DB::table('country')->insert(
			array(	array(	'name'=> 'Albania', )));

		DB::table('country')->insert(
			array(	array(	'name'=> 'Algeria', )));

		DB::table('country')->insert(
			array(	array(	'name'=> 'American Samoa', )));

		DB::table('country')->insert(
			array(	array(	'name'=> 'Andorra', )));

		DB::table('country')->insert(
			array(	array(	'name'=> 'Angola', )));

		DB::table('country')->insert(
			array(	array(	'name'=> 'Anguilla', )));

		DB::table('country')->insert(
			array(	array(	'name'=> 'Antarctica', )));
		
		DB::table('country')->insert(
			array(	array(	'name'=> 'Antigua and Barbuda', )));
				
		DB::table('country')->insert(
			array(	array(	'name'=> 'Argentina', )));
				
		DB::table('country')->insert(
			array(	array(	'name'=> 'Armenia', )));
				
		DB::table('country')->insert(
			array(	array(	'name'=> 'Aruba', )));
				
		DB::table('country')->insert(
			array(	array(	'name'=> 'Australia', )));
				
		DB::table('country')->insert(
			array(	array(	'name'=> 'Austria', )));
				
		DB::table('country')->insert(
			array(	array(	'name'=> 'Azerbaijan', )));
				
		DB::table('country')->insert(
			array(	array(	'name'=> 'Bahamas', )));
						
		DB::table('country')->insert(
			array(	array(	'name'=> 'Bahrain', )));
						
		DB::table('country')->insert(
			array(	array(	'name'=> 'Bangladesh', )));
						
		DB::table('country')->insert(
			array(	array(	'name'=> 'Barbados', )));
						
		DB::table('country')->insert(
			array(	array(	'name'=> 'Belarus', )));
						
		DB::table('country')->insert(
			array(	array(	'name'=> 'Belgium', )));
						
		DB::table('country')->insert(
			array(	array(	'name'=> 'Belize', )));
						
		DB::table('country')->insert(
			array(	array(	'name'=> 'Benin', )));
						
		DB::table('country')->insert(
			array(	array(	'name'=> 'Bermuda', )));
						
		DB::table('country')->insert(
			array(	array(	'name'=> 'Bhutan', )));
						
		DB::table('country')->insert(
			array(	array(	'name'=> 'Bolivia, Plurinational State of', )));
						
		DB::table('country')->insert(
			array(	array(	'name'=> 'Bonaire, Sint Eustatius and Saba', )));
						
		DB::table('country')->insert(
			array(	array(	'name'=> 'Bosnia and Herzegovina', )));
						
		DB::table('country')->insert(
			array(	array(	'name'=> 'Botswana', )));
						
		DB::table('country')->insert(
			array(	array(	'name'=> 'Bouvet Island', )));
						
		DB::table('country')->insert(
			array(	array(	'name'=> 'Brazil', )));
						
		DB::table('country')->insert(
			array(	array(	'name'=> 'British Indian Ocean Territory', )));
						
		DB::table('country')->insert(
			array(	array(	'name'=> 'Brunei Darussalam', )));
						
		DB::table('country')->insert(
			array(	array(	'name'=> 'Bulgaria', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Burkina Faso', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Burundi', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Cambodia', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Cameroon', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Canada', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Cape Verde', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Cayman Islands', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Central African Republic', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Chad', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Chile', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'China', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Christmas Island', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Cocos (Keeling) Islands', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Colombia', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Comoros', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Congo', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Congo, The Democratic Republic of The', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Cook Islands', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Costa Rica', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Cote D\'ivoire', )));
								
		DB::table('country')->insert(
			array(	array(	'name'=> 'Croatia', )));
										
		DB::table('country')->insert(
			array(	array(	'name'=> 'Cuba', )));
										
		DB::table('country')->insert(
			array(	array(	'name'=> 'Curacao', )));
										
		DB::table('country')->insert(
			array(	array(	'name'=> 'Cyprus', )));
										
		DB::table('country')->insert(
			array(	array(	'name'=> 'Czech Republic', )));
										
		DB::table('country')->insert(
			array(	array(	'name'=> 'Denmark', )));
										
		DB::table('country')->insert(
			array(	array(	'name'=> 'Djibouti', )));
										
		DB::table('country')->insert(
			array(	array(	'name'=> 'Dominica', )));
										
		DB::table('country')->insert(
			array(	array(	'name'=> 'Dominican Republic', )));
										
		DB::table('country')->insert(
			array(	array(	'name'=> 'Ecuador', )));
										
		DB::table('country')->insert(
			array(	array(	'name'=> 'Egypt', )));
										
		DB::table('country')->insert(
			array(	array(	'name'=> 'El Salvador', )));
										
		DB::table('country')->insert(
			array(	array(	'name'=> 'Equatorial Guinea', )));
										
		DB::table('country')->insert(
			array(	array(	'name'=> 'Eritrea', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Estonia', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Ethiopia', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Falkland Islands (Malvinas)', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Faroe Islands', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Fiji', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Finland', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'France', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'French Guiana', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'French Polynesia', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'French Southern Territories', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Gabon', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Gambia', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Georgia', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Germany', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Ghana', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Gibraltar', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Greece', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Greenland', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Grenada', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Guadeloupe', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Guam', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Guatemala', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Guernsey', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Guinea', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Guinea-bissau', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Guyana', )));
												
		DB::table('country')->insert(
			array(	array(	'name'=> 'Haiti', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'Heard Island and Mcdonald Islands', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'Holy See (Vatican City State)', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'Honduras', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'Hong Kong', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'Hungary', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'Iceland', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'India', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'Indonesia', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'Iran, Islamic Republic of', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'Iraq', )));		
															
		DB::table('country')->insert(
			array(	array(	'name'=> 'Ireland', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'Isle of Man', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'Italy', )));
																
		DB::table('country')->insert(
			array(	array(	'name'=> 'Jamaica', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'Japan', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'Jersey', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'Jordan', )));
		/*												
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));		
															
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
																
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));		
															
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
																
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));		
															
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
																
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));		
															
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
																
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));		
															
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
																
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));		
															
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
														
		DB::table('country')->insert(
			array(	array(	'name'=> 'admin', )));
		*/
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('country');
	}

}
