<?php

use Illuminate\Support\MessageBag;

class CourseController extends Controller{

	//START the addAction Method
	public function addAction(){
		
		try {
			$name = Input::get('name');
			$description = Input::get('description');
			$publish = Input::get('publish');
			$user_id = Input::get('userID');
			
			$course = new Courses;
	        $course->name = $name;  
			$course->description = $description;
			$course->published = $publish;
			$course->created_by = $user_id;
	        $course->save();

			$id = DB::getPdo()->lastInsertId();

			//Session::put('id', $id);
			Session::flash('status_success', 'Successfully Updated.');
			return Redirect::route('admin/courseEdit', array('id' => $id));
			//return Redirect::route('admin/courseEdit');

		} catch(Exception $ex) {
			echo $ex;
			Session::flash('status_error', '');
		}		
	}
	//END the addAction Method.
	
	//START the updateAction Method
	public function updateAction(){
		try {
			$id = Input::get('courseID');
			$name = Input::get('name');
			$description = Input::get('description');
			$publish = Input::get('publish');
			
			$course = Courses::find($id);
	        $course->name = $name;  
			$course->description = $description;
			$course->published = $publish;
	        $course->save();
			
			Session::flash('status_success', 'Successfully Updated.');
			return Redirect::route('admin/courseEdit', array('id' => $id));
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

	//START the deleteAction Method
	public function deleteAction(){

		$input = Input::all();
		$id = $input["id"];
		
		$course = Courses::find($id);
		$course->deleted_at = new DateTime(date('Y-m-d H:i:s'));
		$course->save();
		//$status = $course->delete();

		DB::table('classcourse')->where('course', $id)->delete();
		$message = "";

		/*if ($status) {
			DB::table('classcourse')->where('course', $id)->delete();
			$message = "";
		} else {
			$message = "Sorry. you cannot delete this course.";
		}*/

		$responses = array(
			'idx'	  => $id,	
			'message' => $message,
			'status'  => true,
		);

		return Response::json( $responses );
	}
	//END the deleteAction Method.

	//START the teacherAddAction Method
	public function teacherAddAction(){
		
		try {
			$name = Input::get('name');
			$description = Input::get('description');
			$publish = Input::get('publish');
			$user_id = Input::get('userID');

			$classes = explode(',', Input::get('hiddenClasses'));
			
			$course = new Courses;
	        $course->name = $name;  
			$course->description = $description;
			$course->published = $publish;
			$course->created_by = $user_id;
	        $course->save();

	        $id = DB::getPdo()->lastInsertId();

	        for ($i = 0; $i < count($classes); $i ++) {
				if ($classes[$i] != "") {
					$classcourse = new Classcourse;
					$classcourse->class = $classes[$i];
					$classcourse->course = $id;
					$classcourse->save();
				}
			}			
			
			return Redirect::route('teacher/sprints');

		} catch(Exception $ex) {
			echo $ex;
			Session::flash('status_error', '');
		}		
	}
	//END the teacherAddAction Method.

	//START the teacherDeleteAction Method
	public function teacherDeleteAction(){

		$input = Input::all();
		$id = $input["id"];
		$user_id = $input["userID"];

		$course = Courses::find($id);
		if ($course->created_by == $user_id) {
			$course = Courses::find($id);
			$course->deleted_at = new DateTime(date('Y-m-d H:i:s'));
			$course->save();
			/*Courses::find($id)->delete();*/
		}
		
		DB::table('classcourse')->where('course', $id)->delete();		

		return Redirect::route('teacher/sprints');
		
	}
	//END the teacherDeleteAction Method.

	//START the addCourse Method
	public function addCourse(){
		
		try {
			$course_id = Input::get('course_id');
			$classes = explode(',', Input::get('classes'));

	        for ($i = 0; $i < count($classes); $i ++) {
				if ($classes[$i] != "") {
					$classcourse = new Classcourse;
					$classcourse->class = $classes[$i];
					$classcourse->course = $course_id;
					$classcourse->save();
				}
			}			
			
			return Redirect::route('teacher/sprints');

		} catch(Exception $ex) {
			echo $ex;
			Session::flash('status_error', '');
		}		
	}
	//END the addCourse Method.

}