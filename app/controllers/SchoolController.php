<?php

use Illuminate\Support\MessageBag;

class SchoolController extends Controller{

	//START the addAction Method
	public function addAction(){
		
		try {

		$name = Input::get('name');
		$description = Input::get('description');
		$address = Input::get('address');
		$publish = Input::get('publish');

		$school = new School;
        $school->name = $name;  
		$school->description = $description;
		$school->address = $address;
		$school->published = $publish;
        $school->save();

		$id = DB::getPdo()->lastInsertId();

		$schools = explode(',', $school);		

		//Session::put('id', $id);
		Session::flash('status_success', 'Successfully Updated.');
		return Redirect::route('admin/schoolEdit', array('id' => $id));
		//return Redirect::route('admin/classEdit');

		} catch(Exception $ex) {
			echo $ex;
			Session::flash('status_error', '');
		}	
	}
	//END the addAction Method.
	
	//START the updateAction Method
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
		Session::flash('status_success', 'Successfully Updated.');
		return Redirect::route('admin/schoolEdit', array('id' => $id));
		//return Redirect::route('admin/schoolEdit');

		} catch(Exception $ex) {
			echo $ex;
			Session::flash('status_error', '');
		}		
	}
	//END the updateAction Method.

	//START the classesAction Method
	public function classesAction() {
		try {
			
			$id = Input::get('school');
			$class = Input::get('hiddenClasses');

			$classes_info = substr($class, 0, strlen($class) - 1);
			$classes_array = explode(',', $classes_info);
			
			DB::table('schoolclass')->where('school', $id)
				->delete();
		
			for ($i = 0; $i < count($classes_array); $i ++) { 
				if ($classes_array[$i] != "") {
					$schoolclass = new Schoolclass;
					$schoolclass->school = $id;
					$schoolclass->class = $classes_array[$i];
					$schoolclass->save();
				}
			}
			return Redirect::route('admin/schoolEdit', array('id' => $id));
		} catch(Exception $ex) {
			echo $ex;
			Session::flash('status_error', '');			
		}
	}
	//END the classesAction Method.

	//START the usersAction Method
	public function usersAction() {
		try {
			
			$id = Input::get('school');
			$users = Input::get('hiddenUsers');

			$users_info = substr($users, 0, strlen($users) - 1);
			$users_array = explode(',', $users_info);
			
			DB::table('schooluser')->where('school', $id)
				->delete();
		
			for ($i = 0; $i < count($users_array); $i ++) { 
				if ($users_array[$i] != "") {
					$schooluser = new Schooluser;
					$schooluser->school = $id;
					$schooluser->user = $users_array[$i];
					$schooluser->save();
				}
			}
			return Redirect::route('admin/schoolEdit', array('id' => $id));
		} catch(Exception $ex) {
			echo $ex;
			Session::flash('status_error', '');			
		}
	}
	//END the usersAction Method.

	//START the deleteAction Method
	public function deleteAction(){

		$input = Input::all();
		$id = $input["id"];

		$schoolToUser = DB::table('schooluser')->where('school', $id);
		$schoolToClass = DB::table('schoolclass')->where('school', $id);
		
		$status = false;
		if ($schoolToUser->count() < 1 || $schoolToClass->count() < 1) {
			$school = School::find($id);
			$school->deleted_at = new DateTime(date('Y-m-d H:i:s'));
        	$school->save();

			$status = true;
			$message = "";
		} else {
			$message = "Sorry. You cannot delete this school. \n To delete this class, you should remove the students from class and then remove this class from school first.";
		}

		$responses = array(
			'idx'	  => $id,
			'message' => $message,
			'status' => $status,
		);

		return Response::json( $responses );
	}
	//END the deleteAction Method.

}