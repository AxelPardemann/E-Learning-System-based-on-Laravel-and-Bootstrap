<?php

use Illuminate\Support\MessageBag;

class ClassController extends Controller{

	//START the addAction Method
	public function addAction(){
		
		try {

		$school = Input::get('hiddenSchools');
		$name = Input::get('name');
		$description = Input::get('description');
		$publish = Input::get('publish');

		$class = new Classes;
        $class->name = $name;  
		$class->description = $description;
		$class->published = $publish;
        $class->save();

		$id = DB::getPdo()->lastInsertId();

		$schools = explode(',', $school);
		
		for ($i = 0; $i < count($schools); $i ++) {
			 
			if ($schools[$i] != "") {
				$schoolclass = new Schoolclass;
				$schoolclass->school = $schools[$i];
				$schoolclass->class = $id;
				$schoolclass->save();
			}
		}
		//Session::put('id', $id);
		Session::flash('status_success', 'Successfully Updated.');
		return Redirect::route('admin/classEdit', array('id' => $id));
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
		
			$id = Input::get('class');
			$school = Input::get('hiddenSchools');
			$name = Input::get('name');
			$description = Input::get('description');
			$publish = Input::get('publish');
			
			$class = Classes::find($id);
	        $class->name = $name;  
			$class->description = $description;
			$class->published = $publish;
	        $class->save();

			DB::table('schoolclass')
				->where('class', $id)
				->delete();

			$schools = explode(',', $school);
			
			for ($i = 0; $i < count($schools); $i ++) {
				 
				if ($schools[$i] != "") {
					$schoolclass = new Schoolclass;
					$schoolclass->school = $schools[$i];
					$schoolclass->class = $id;
					$schoolclass->save();
				}
			}
			//Session::put('id', $id);
			Session::flash('status_success', 'Successfully Updated.');
			return Redirect::route('admin/classEdit', array('id' => $id));
			//return Redirect::route('admin/classEdit');

		} catch(Exception $ex) {
			echo $ex;
			Session::flash('status_error', '');
		}		
	}
	//END the updateAction Method.

	//START the studentsAction Method
	public function studentsAction() {
		try {
			$class = Input::get('class');
			$students = Input::get('students');		
			$schools = Input::get('schools');	
			
			for($i = 0; $i < count($schools); $i ++) {
				$school_info = $schools[$i];
				
				$school_info = substr($school_info, 0, strlen($school_info) - 1);
				$schools_array = explode(',', $school_info);
				
				DB::table('classstudent')->where('class', $class)
					->whereIn('school', $schools_array)
					->delete();
			}

			for($i = 0; $i < count($students); $i ++) {
				$info = $students[$i];
				$infomations = explode('|', $info);
				$student = $infomations[0];
				$school_info = $infomations[1];	
				
				$school_info = substr($school_info, 0, strlen($school_info) - 1);
				$schools = explode(',', $school_info);				

				for ($j = 0; $j < count($schools); $j ++) { 
					
					if ($schools[$j] != "") {
						$classstudent = new Classstudent;
						$classstudent->school = $schools[$j];
						$classstudent->user = $student;
						$classstudent->class = $class;
						$classstudent->complete = 0;
						$classstudent->date_joined = date("Y-m-d H:i:s");
						$classstudent->save();
					}
				}
			}
			return Redirect::route('admin/classes');
		} catch(Exception $ex) {
			echo $ex;
			Session::flash('status_error', '');
		}
	}
	//END the studentsAction Method.

	//START the courseAction Method
	public function coursesAction() {
		try {
			$id = Input::get('class');
			$courses = Input::get('hiddenCourses');
			$courses_array = explode(',', $courses);

			DB::table('classcourse')->where('class', $id)
				->delete();
		
			for ($i = 0; $i < count($courses_array); $i ++) { 
				if ($courses_array[$i] != "") {
					$Classcourse = new Classcourse;
					$Classcourse->class = $id;
					$Classcourse->course = $courses_array[$i];
					$Classcourse->save();
				}
			}
			return Redirect::route('admin/classEdit', array('id' => $id));
		} catch(Exception $ex) {
			echo $ex;
			Session::flash('status_error', '');			
		}
	}
	//END the courseAction Method.

	//START the deleteAction Method
	public function deleteAction(){

		$input = Input::all();
		$id = $input["id"];

		$schoolToClass = DB::table('schoolclass')->where('class', $id);
		$classToStudent = DB::table('classstudent')->where('class', $id);
		
		$status = false;
		if ($schoolToClass->count() < 1 && $classToStudent->count() < 1) {
			$class = Classes::find($id);
			$class->deleted_at = new DateTime(date('Y-m-d H:i:s'));
			$class->save();

			$status = true;		
			$message = "";
		} else {
			$message = "Sorry. You cannot delete this class. \n To delete this class, you should remove the students from class and then remove this class from school first.";
		}

		$responses = array(
			'idx'	  => $id,	
			'message' => $message,
			'status'  => $status,
		);

		return Response::json( $responses );
	}
	//END the deleteAction Method.

}