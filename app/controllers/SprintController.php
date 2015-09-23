<?php

use Illuminate\Support\MessageBag;

class SprintController extends Controller{
	//START the progressAction Method
	public function progressAction() {
		if (Input::server("REQUEST_METHOD") == "POST") {
			try {
				$message = "";
				$type = Input::get('type');				
				$id = Input::get('id');
				if ($type == "update") {
					$state = Input::get('state');
					$response = Input::get('response');
					$loops = Input::get('loops');
					$active = Input::get('active');
					$message = "It's updated successfully.";
				} else if ($type == "reset") {
					$setting = Config::get('general.sprint');
					$state = "Active";
					$response = $setting['response_time'];
					$loops = $setting['loops'];
					$active = $setting['active'];		
					$message = "It's reseted successfully";			
				}

				$progress = Studentprogress::find($id);
				$progress->response = $response;
				$progress->loops = $loops;
				$progress->active = $active;
				$progress->status = $state;
				$progress->updated_at = date("Y-m-d H:i:s");
				$result = $progress->save();

				$success = false;
				if ($result) {
					$success = true;
				}

				$responses = array(
					'id' => $id,
					'wait' => $response,
					'loops' => $loops,
					'active' => $active,
					'state' => $state,
					'result' => $success,
					'message' => $message,
				);

				return Response::json( $responses );
			} catch (Exception $ex) {
				echo $ex;
			}
		}	
	}
	//END the progressAction Method

	//START the addAction Method
	public function addAction() {		
		//var_dump(Input::all());
		if (Input::server("REQUEST_METHOD") == "POST") {
			try {
				$action = "insert";
				$id = Input::get('id');
				//$school = Input::get('school');				
				$course = Input::get('course');
				$name = Input::get('name');
				$description = Input::get('description');
				$fluency = Input::get('fluency');
				$publish = Input::get('publish');

				$cards_id = Input::get('card_ids');
				$f_text = Input::get('f_text');
				$f_cardtype = Input::get('cardtype');
				$f_text_option = Input::get('f_text_option');
				$f_sound = Input::get('f_sound');
				$f_image = Input::get('f_image');

				if (isset($id) && !empty($id)) {
					$sprint = Sprint::find($id);
					$action = "update";

					$cards = DB::table('cards')
						->where('sprint', $id)
						->get();

					foreach($cards as $card) {
						$flag = false;
						for ($i = 0; $i < sizeof($cards_id); $i++) {
							if ($card->id == $cards_id[$i])
								$flag = true;
						}
						if (!$flag)
							DB::table('cards')->where('id', $card->id)->delete();
					}
				} else {
					$sprint = new Sprint;
				}

				//$sprint->school = $school;
				$sprint->course = $course;  
		        $sprint->name = $name;  
				$sprint->description = $description;
				$sprint->fluency_rate = $fluency;
				$sprint->published = $publish;
				$sprint->save();

				if ($action == "insert") {
					$sprint_id = DB::getPdo()->lastInsertId();
				} else {
					$sprint_id = $id;
				}
				$cards = "";

				for( $i = 0; $i < count($f_text); $i ++) {			
					
					$idx = $i + 1;			
					$card_type = $f_cardtype[$i];

					$cardid = $cards_id[$i];					

					if ($action == "update" && $cardid > 0) {
						$card = Card::find($cardid);
					} else {
						$card = new Card;	
					}
					
					$card->sprint = $sprint_id;
					$card->card_type = $card_type;
					$card->f_text = $f_text[$i];

					if (!empty($f_text_option[$i])) {
						$card->f_text_option = $f_text_option[$i];
					} else {
						$card->f_text_option = 0;
					}

					if (!empty($f_sound[$i])) {
						$f_sound_path = "";
						$f_sound_file = "";

						if ($f_sound[$i] == "none") {
							$card->f_sound_option = 0;
						} else {
							$card->f_sound_option = 1;
							$f_sound_pos = strripos($f_sound[$i], "/");
							$f_sound_path = substr($f_sound[$i], 0, $f_sound_pos + 1);
							$f_sound_file = substr($f_sound[$i], $f_sound_pos + 1);
						}

						$card->f_sound = $f_sound_file;	
						$card->f_sound_path = $f_sound_path;
						
					} else {
						if ($f_sound[$i] == "none") {
							$card->f_sound_option = 0;
						} else {
							$card->f_sound_option = 1;
						}
						$card->f_sound = "";
						$card->f_sound_path = "";				
					}
						
					if (!empty($f_image[$i])) {
						$f_image_file = "";
						$f_image_path = "";	

						if ($f_image[$i] == "none") {
							$card->f_image_option = 0;
						} else {
							$card->f_image_option = 0;
							$f_image_pos = strripos($f_image[$i], "/");
							$f_image_path = substr($f_image[$i], 0, $f_image_pos + 1);
							$f_image_file = substr($f_image[$i], $f_image_pos + 1);
						} 
						$card->f_image = $f_image_file;
						$card->f_image_path = $f_image_path;				
					} else {	
						if ($f_image[$i] == "none") {
							$card->f_image_option = 0;
						} else {
							$card->f_image_option = 1;
						}
						
						$card->f_image = "";
						$card->f_image_path = "";
					}

					if (is_array(Input::get('b_text-' . $idx))) {

						$b_value = Input::get('b_text-' . $idx);
						$b_text_options = Input::get('b_text_option-' . $idx);
						$b_sounds = Input::get('b_sound-' . $idx);
						$b_images = Input::get('b_image-' . $idx);
						$subcard_id = Input::get('subcard_id-' . $idx);

						if ($card_type == 'singlecard') {				
							$card->b_text = $b_value[0];

							if (!empty($b_text_options[0])) {
								$card->b_text_option = $b_text_options[0];
							} else {
								$card->b_text_option = 0;
							}

							if (!empty($b_sounds[0])) {
								$b_sound_file = "";
								$b_sound_path = "";

								if ($b_sounds[0] == "none") {
									$card->b_sound_option = 0;
								} else {
									$card->b_sound_option = 1;
									$b_sound_pos = strripos($b_sounds[0], "/");
									$b_sound_path = substr($b_sounds[0], 0, $b_sound_pos + 1);
									$b_sound_file = substr($b_sounds[0], $b_sound_pos + 1);
								}

								$card->b_sound = $b_sound_file;
								$card->b_sound_path = $b_sound_path;					
							} else {
								if ($b_sounds[0] == "none") {
									$card->b_sound_option = 0;
								} else {
									$card->b_sound_option = 1;
								}
								$card->b_sound = "";
								$card->b_sound_path = "";						
							}

							if (!empty($b_images[0])) {
								$b_image_file = "";
								$b_image_path = "";

								if ($b_images[0] == "none") {
									$card->b_image_option = 0;
								} else {
									$card->b_image_option = 1;
				 					$b_image_pos = strripos($b_images[0], "/");
									$b_image_path = substr($b_images[0], 0, $b_image_pos + 1);
									$b_image_file = substr($b_images[0], $b_image_pos + 1); 
								}

								$card->b_image = $b_image_file;
								$card->b_image_path = $b_image_path;						
							} else {

								if ($b_images[0] == "none") {
									$card->b_image_option = 0;
								} else {
									$card->b_image_option = 1;
								}

								$card->b_image = "";
								$card->b_image_path = "";
							}

							$card->save();

							if ($action == "update" && $cardid > 0) {
								$card_id = $cardid;
							} else {
								$card_id = DB::getPdo()->lastInsertId();
							}

							$cards .= $card_id;
							$cards .= ",";
						} else {
							$card->b_text = "";
							$card->b_sound = "";
							$card->b_sound_path = "";
							$card->b_image = "";
							$card->b_image_path = "";

							$card->save();

							if ($action == "update" && $cardid > 0) {
								$card_id = $cardid;
							} else {								
								$card_id = DB::getPdo()->lastInsertId();
							}

							$cards .= $card_id;
							$cards .= ",";	
							for ($j = 0; $j < count($b_value); $j ++) {
								$subcardid = $subcard_id[$j];
								$answer = 0;			
								$key = $j + 1;

								if ($card_type == 'radiocard') {
									$b_radios = Input::get('option-' . $idx);
									if ($key == $b_radios[0]) 
										$answer = 1;
								} else if ($card_type == 'checkcard') {
									$b_checks = Input::get('check-' . $idx);	

									for ($k = 0; $k < count($b_checks); $k ++) {						
										if ($key == $b_checks[$k]) {
											$answer = 1;
											break;
										}
									}
								}
								
								if ($action == "update" && $subcardid > 0) {									
									$subcard = SubCard::find($subcardid);
								} else {									
									$subcard = new SubCard;
								}

								$subcard->cards = $card_id;
								$subcard->answer = $b_value[$j];

								if (!empty($b_text_options[$j])) {
									$subcard->b_text_option = $b_text_options[$j];
								} else {
									$subcard->b_text_option = 0;
								}

								if (!empty($b_sounds[$j])) {
									$b_sound_file = "";
									$b_sound_path = "";

									if ($b_sounds[$j] == "none") {
										$subcard->b_sound_option = 0;
									} else {
										$subcard->b_sound_option = 1;
										$b_sound_pos = strripos($b_sounds[$j], "/");
										$b_sound_path = substr($b_sounds[$j], 0, $b_sound_pos + 1);
										$b_sound_file = substr($b_sounds[$j], $b_sound_pos + 1);
									}
									
									$subcard->b_sound = $b_sound_file;
									$subcard->b_sound_path = $b_sound_path;
								} else {
									if ($b_sounds[$j] == "none") {
										$subcard->b_sound_option = 0;
									} else {
										$subcard->b_sound_option = 1;
									}
									$subcard->b_sound = "";
									$subcard->b_sound_path = "";
								}

								if (!empty($b_images[$j])) {
									$b_image_file = "";
									$b_image_path = "";

									if ($b_images[$j] == "none") {
										$subcard->b_image_option = 0;
									} else {
										$subcard->b_image_option = 1;
										$b_image_pos = strripos($b_images[$j], "/");
										$b_image_path = substr($b_images[$j], 0, $b_image_pos + 1);
										$b_image_file = substr($b_images[$j], $b_image_pos + 1);								
									}

									$subcard->b_image = $b_image_file;
									$subcard->b_image_path = $b_image_path;

								} else {
									if ($b_images[$j] == "none") {
										$subcard->b_image_option = 0;
									} else {
										$subcard->b_image_option = 1;
									}							
									$subcard->b_image = "";
									$subcard->b_image_path = "";							
								}

								$subcard->correctanswer = $answer;
								$subcard->save();
							}
						}		
					}
				}

				$cards = substr($cards, 0, strlen($cards) - 1);
				$sprint = Sprint::find($sprint_id);
				if ($cards == "")
					$sprint->cards = "";
				else 
					$sprint->cards = $cards;
				$sprint->save();	
				if (strcmp(strtolower(Auth::user()->permission), "teacher") == 0 ) {
					return Redirect::route('teacher/sprints');
				} else if (strcmp(strtolower(Auth::user()->permission), "administrator") == 0 ) {
					return Redirect::route('admin/sprints');
				}
			} catch(Exception $ex) {
				echo $ex;
				Session::flash('status_error', '');
			}		
		}
	}
	//END the addAction Method.
	
	//START the updateAction Method
	/*
	public function updateAction(){
		try {
		
		$id = Input::get('school');
		$name = Input::get('name');
		$description = Input::get('description');
		$address = Input::get('address');
		$publish = Input::get('publish');
		
		$school = School::find($id);
        $school->name = $name;  
		$school->description = $description;
		$school->address = $address;
		$school->published = $publish;
        $school->save();
		
		//Session::put('id', $id);
		return Redirect::route('admin/schoolEdit', array('id' => $id));
		//return Redirect::route('admin/schoolEdit');

		} catch(Exception $ex) {
			echo $ex;
			Session::flash('status_error', '');
		}		
	}
	*/
	//END the updateAction Method.

	//START the deleteAction Method
	public function asssetAction(){
		if (Input::server("REQUEST_METHOD") == "POST") {
			try {
				$file = Input::get('assetFile');
				$type = Input::get('assetType');

				$orignal_path = str_replace("thumbnail/", "", $file);
				if ($type == "img") {
					$orignal_file = str_replace("100crop.jpg", ".jpg", $orignal_path);
					$orignal264Image_file = str_replace("100crop.jpg", "264crop.jpg", $file);				

					if (file_exists(public_path() . $orignal_file)) {
						unlink(public_path() . $orignal_file);
					}

					if (file_exists(public_path() . $orignal264Image_file)) {
						unlink(public_path() . $orignal264Image_file);
					}

					if (file_exists(public_path() . $file)) {
						unlink(public_path() . $file);
					}	
				} else  {
					if (file_exists(public_path() . $orignal_path)) {
						unlink(public_path() . $orignal_path);
					}	
					
					if (file_exists(public_path() . $file)) {
						unlink(public_path() . $file);
					}
				}

				$status = true;
			} catch (Exception $ex) {
				echo $ex;
				$status = false;
			}

			$responses = array(
				'status' => $status,
			);

			return Response::json( $responses );			
		}
	}
	//END the deleteAction Method


	//START the deleteAction Method
	public function deleteAction(){

		$input = Input::all();
		$id = $input["id"];

		$sprint = Sprint::find($id);
		$sprint->deleted_at = new DateTime(date('Y-m-d H:i:s'));
		$sprint->save();
		//$result = $sprint->delete();

		$message = "";	

		/*$cards = Card::where('sprint', $id);

		foreach ($cards->get() as $card) {
			SubCard::where('cards', $card->id)->delete();
		}

		$cards->delete();
		if ($result == 1) {
			$status = true;
		}*/
		
		$responses = array(
			'idx'	  => $id,
			'message' => $message,
			'status' => true,
		);

		return Response::json( $responses );
	}
	//END the deleteAction Method.

	//START Create New Progress Action
	public function newProgress($data, $setting) {
		$setting = Config::get('general.sprint');
		
		$progress = new Studentprogress;
		$progress->school = $data['school'];
		$progress->user = $data['user'];
		$progress->sprint = $data['sprint'];
		$progress->correctCards = 0;
		$progress->incorrectCards = 0;
		$progress->totalCards = 0;
		$progress->masteredCards = '';
		$progress->speed = '';
		$progress->response = $setting['response_time'];
		$progress->loops = $setting['loops'];
		$progress->maintenance = $setting['maintenance_loops'];
		$progress->active = $setting['active'];
		$progress->status = 'Active';
		$progress->flag = 1;

		$progress->save();
	}
	//END Create New Progress Action

	//START Update Progress Action
	public function setProgress($id, $data) {
		DB::table('studentprogress')
            ->where('id', $id)
            ->update(array(
            	'correctCards' => $data['correctCards'],
            	'incorrectCards' => $data['incorrectCards'],
            	'totalCards' => $data['totalCards'],
            	'masteredCards' => $data['masteredCards'],
            	'speed' => $data['speed'],
            	'response' => $data['response'],
            	'loops' => $data['loops'],
            	'maintenance' => $data['maintenance'],
            	'active' => $data['active'],
            	'status' => $data['status']
            ));

		/*$progress = new Studentprogress;
		$progress->school = $data['school'];
		$progress->user = $data['user'];
		$progress->sprint = $data['sprint'];
		$progress->correctCards = $data['correctCards'];
		$progress->incorrectCards = $data['incorrectCards'];
		$progress->totalCards = $data['totalCards'];
		$progress->masteredCards = $data['masteredCards'];
		$progress->speed = $data['speed'];
		$progress->response = $data['response'];
		$progress->loops = $data['loops'];
		$progress->maintenance = $data['maintenance'];
		$progress->active = $data['active'];
		$progress->status = $data['status'];
		$progress->flag = 1;

		$progress->save();*/
	}
	//END Update Progress Action

	public function setTransaction($school, $user, $sprint, $card, $response, $is_corrected, $no_answer) {
    	$transaction = new Transaction;
    	$transaction->user = $user;
    	$transaction->school = $school;
    	$transaction->sprint = $sprint;
    	$transaction->card = $card;
    	$transaction->response_time = $response;
    	$transaction->is_corrected = $is_corrected;
    	$transaction->no_answer = $no_answer;
    	$transaction->created_at = date("Y-m-d H:i:s");

    	$transaction->save();
	}

}