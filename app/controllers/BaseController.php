<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	static public function checkSprint($course, $sprint) {
		$sprint = DB::table('coursesprint')
							->where('course', '=', $course)
							->where('sprint', $sprint)
							->first();
		if ($sprint != null)
			return true;
		else
			return false;
	}

	static public function checkSchool($school, $class) {
		$school = DB::table('schoolclass')
							->where('school', $school)
							->where('class', $class)->first();
		if ($school != null)
			return true;
		else
			return false;
	}

	static public function checkUser($school, $user) {
		$users = DB::table('schooluser')
							->where('school', $school)
							->where('user', $user)->first();
		if ($users != null)
			return true;
		else
			return false;
	}

	static public function checkCourse($class, $course) {
		$courses = DB::table('classcourse')
							->where('class', $class)
							->where('course', $course)->first();
		if ($courses != null)
			return true;
		else
			return false;
	}

	static public function checkStudent($school, $class) {
		$student = DB::table('classstudent')
							->where('user', $school)
							->where('class', $class)->first();
		if ($student != null)
			return true;
		else
			return false;
	}

	static public function getSchool($user) {
		
		$schools_info = DB::table('schooluser')
					->where('user', $user)
					->orderBy('school', 'asc')->get();
		
		$result = "";
		foreach($schools_info as $school) {
			$result = $result . $school->school;
			$result = $result . ",";
		}
		return $result;
	}

	static public function checkCategory($categoryId, $storyCategories) {

		if ($storyCategories != null) {
			foreach($storyCategories as $category) {
				if ($categoryId == $category->category_id) {
					return true;
				}
			}		
		} else {
			return false;
		}
	}

	static public function getSubcards($card) {
		
		$subcards = DB::table('sub_cards')
					->where('cards', $card)
					->orderBy('cards', 'asc')->get();		

		return $subcards;
	}

	static public function getUsersBySchool($school) {
		
		$users = DB::table('schooluser')
					->where('school', $school)
					->orderBy('school', 'asc');

		return $users->count();
	}

	static public function getCoursesCountBySchool($school) {
		
		$courses = DB::table('classcourse')
					->join('schoolclass', 'schoolclass.class', '=', 'classcourse.class')
					->where('schoolclass.school', $school)
					->get();

		return sizeof($courses);
	}	

	static public function getClassesBySchool($school) {
		

		$classes = DB::table('classes')
					->join('schoolclass', 'classes.id', '=', 'schoolclass.class')
					->where('schoolclass.school', $school)
					->orderBy('classes.name', 'asc')
					->get();

		return $classes;
	}	

	static public function getCoursesBySchool($school) {
		

		$classes = DB::table('courses')
					->join('classcourse', 'courses.id', '=', 'classcourse.course')
					->join('schoolclass', 'schoolclass.class', '=', 'classcourse.class')
					->where('schoolclass.school', $school)
					->orderBy('courses.name', 'asc')
					->get();

		return $classes;
	}		

}