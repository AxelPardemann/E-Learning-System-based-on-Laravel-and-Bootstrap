<?php
/*
//Get Routes
*/

Route::get('/', function()
{	
	return Redirect::route("user/login");
});

Route::get('/page', function() {
   return 'Hello world!';
});

Route::get('/admin', function()
{	
	return Redirect::route("user/login");
});

//Route to login page
Route::get("login", array(
	"as" => "user/login", function(){
		return View::make("user/signin");
}));

//Route to welcome page
Route::get("welcome", array(
	"as" => "user/welcome", function(){
    return View::make("user/welcome");
}));

//Route to welcome page
Route::get("verified", array(
	"as" => "user/verified", function(){
    return View::make("user/verified");
}));

//Route to error page
Route::get("errors", array(
	"as" => "user/error", function(){
    return View::make("user/error");
}));

//Route to password reset request form
Route::get("request", array("as" => "user/request", function(){
    return View::make("user/request");
}));

//Route to password reset form
Route::get("reset", array(
    "as"   => "user/reset",
    "uses" => "UserController@resetAction"
));

Route::get("verify", array(
    "as"   => "user/verify",
    "uses" => "UserController@verifyAction"
));

//Route to registration page
Route::get ("signup", array(
	"as" => "user/signup", function() {
	return View::make("user/signup");
}));

/* 
//Authorized BY Administrator
*/

Route::group(array("before" => "auth|auth.admin"), function(){
	//Route to admin dashboard
	Route::get("dashboard", array(
		"as" => "admin/dashboard", function(){
		$user = Auth::user();

		return View::make("admin/dashboard")
				->with("title","Dashboard")
				->with("sub_title", "")
				->with("user", $user);	
	}));
	
	//Route to new school for administrator

	Route::get("schoolAdd", array(
		"as" => "admin/schoolAdd", function(){
		$user = Auth::user();

		return View::make("admin/school_new")
				->with("title","School")
				->with("sub_title","schoolnew")
				->with("user", $user);
	}));

	//Route to users for administrator
	Route::get("users", array(
		"as" => "admin/users", function(){
		$user = Auth::user();
		$users = DB::table('users')->get();	

		
		return View::make("admin/users")
				->with("title", "User")
				->with("sub_title", "userall")
				->with("users", $users)
				->with("user", $user);		
	}));

	//Route to new user for administrator

	Route::get("userAdd", array(
		"as" => "admin/userAdd", function(){
		$user = Auth::user();

		return View::make("admin/user_new")
				->with("title","User")
				->with("sub_title", "usernew")
				->with("user", $user);	
	}));

	Route::get("users/{id}", array(
		"as" => "admin/edituser", function($id){
		$user = Auth::user();
		$userById = DB::table('users')
				->where('id', trim($id))
				->first();
		
		return View::make("admin/user_edit")
				->with("title","User")
				->with("sub_title", "userall")
				->with("userById", $userById)
				->with("user", $user);	
		
	}));

	Route::get("userDelete/{id}", array(		
		"as" => "admin/deleteuser", function($id){
		$user = Auth::user();		
		$userById = User::find($id);
		$userById->delete();

		return Redirect::route('admin/users');
	}));
	
	//Route to new school for administrator
	Route::get("schools", array(
		"as" => "admin/schools", function(){
		$user = Auth::user();
		$schools = DB::table('school')->where('deleted_at', NULL)->get();	
			
		return View::make("admin.schools")
				->with("title","School")				
				->with("sub_title","schoolall")
				->with("schools", $schools)
				->with("user", $user);	
	}));

	Route::get("schoolEdit/{id}", array(
		"as" => "admin/schoolEdit", function($id){
		$user = Auth::user();
		//$id = Session::get('id');
		$schoolByID = School::find($id);		
		$classes = DB::table('classes')
					->where('published', 1)
					->where('deleted_at', NULL)
					->select('id', 'name', 'description')
					->get();
		
		$users = DB::table('users')
					->where('published', 1)
					->where('permission', '!=', 'administrator')
					->select('id', 'first', 'last', 'permission')
					->get();	

		$courses = DB::table('courses')
					->where('published', 1)
					->where('deleted_at', NULL)
					->select('id', 'name', 'description')
					->get();	

		return View::make("admin.school_edit")
				->with("title","School")
				->with("sub_title", "schoolnew")
				->with("classes", $classes)
				->with("users", $users)
				->with("courses", $courses)
				->with("schoolByID", $schoolByID)
				->with("user", $user);
		
	}));	
	
	Route::get("sprintEdit/{id}", array(
		"as" => "admin/sprintEdit", function($id){
		$user = Auth::user();
		//$id = Session::get('id');
		$schoolByID = School::find($id);		
		$classes = DB::table('classes')
					->where('published', 1)
					->where('deleted_at', NULL)
					->select('id', 'name', 'description')
					->get();
		
		$users = DB::table('users')
					->where('published', 1)
					->where('permission', '!=', 'administrator')
					->select('id', 'first', 'last', 'permission')
					->get();	

		$courses = DB::table('courses')
					->where('published', 1)
					->where('deleted_at', NULL)
					->select('id', 'name', 'description')
					->get();	

		return View::make("admin.school_edit")
				->with("title","School")
				->with("sub_title", "schoolnew")
				->with("classes", $classes)
				->with("users", $users)
				->with("courses", $courses)
				->with("schoolByID", $schoolByID)
				->with("user", $user);
		
	}));	

	Route::get("courses", array(
		"as" => "admin/courses", function(){
		$user = Auth::user();
		$courses = DB::table('courses')->where('deleted_at', NULL)->get();	
			
		return View::make("admin.courses")
				->with("title","Course")
				->with("sub_title","courseall")
				->with("courses", $courses)
				->with("user", $user);	
	}));

	//Route to new course for administrator
	Route::get("courseAdd", array(
		"as" => "admin/courseAdd", function(){
		$user = Auth::user();

		return View::make("admin.course_new")
				->with("title","Course")
				->with("sub_title", "coursenew")
				->with("courseByID", null)
				->with("user", $user);	
	}));

	Route::get("courseEdit/{id}", array(
		"as" => "admin/courseEdit", function($id){
		$user = Auth::user();

		$courseByID = Courses::find($id);
		/*$sprints = DB::table('sprints')
					->where('published', 1)
					->select('id', 'name')
					->get();*/
		$sprints = DB::table('sprints')
					->where('published', 1)
					->where('course', $id)
					->where('deleted_at', NULL)
					->get();

		return View::make("admin.course_edit")
				->with("title","Course")
				->with("sub_title", "coursenew")
				->with("courseByID", $courseByID)
				->with("sprints", $sprints)
				->with("user", $user);
		
	}));

	Route::get("sprints", array(
		"as" => "admin/sprints", function(){
		$user = Auth::user();
		$sprints = DB::table('sprints')
				            ->join('courses', 'courses.id', '=', 'sprints.course')
				            ->where('sprints.deleted_at', NULL)
				            ->select('sprints.id', 'sprints.name', 'sprints.fluency_rate', 'sprints.cards', 'courses.id as courseid', 'courses.name as coursename')
				            ->get();

		return View::make("admin.sprints")
				->with("title","Sprint")
				->with("sub_title","sprintall")
				->with("sprints", $sprints)
				->with("user", $user);
	}));

	//Route to new course for administrator
	Route::get("sprintAdd", array(
		"as" => "admin/sprintAdd", function(){
		$user = Auth::user();
		$courses = DB::table('courses')
					->where('deleted_at', NULL)
					->get();

		$course = Input::get('course');
		return View::make("admin.sprint_new")
			->with("title","Sprint")
			->with("sub_title", "Create New Sprint")
			->with("fluency", null)
			->with("sprintById", null)
			->with("cardsBysprint", null)
			->with("course", $course)
			->with("courses", $courses)
			->with("user", $user);
	}));
/*
	Route::get("sprintEdit/{id}", array(
		"as" => "admin/sprintEdit", function($id){
		$user = Auth::user();
		//$id = Session::get('id');
		$courseByID = Courses::find($id);
		//$sprintsByCourse = $courseByID->sprints;

		return View::make("admin.course_new")
				->with("title","Sprint")
				->with("sub_title", "sprintnew")
				->with("courseByID", $courseByID)
				->with("user", $user);
		
	}));
*/
	Route::get("admin_sprintEdit/{id}", array(
		"as" => "admin/sprintEdit", function($id) {
		$user = Auth::user();

		$sprintById = Sprint::find($id);

		$cardsBysprint = DB::table('cards')
							->where('sprint', $id)
							->get();		
		
		$courses = DB::table('courses')
					->where('deleted_at', NULL)
					->get();

		return View::make("admin.sprint_new")
			->with("title","Sprint")
			->with("sub_title", "Edit the Sprint")
			->with("fluency", $sprintById->fluency_rate)
			->with("sprintById", $sprintById)
			->with("cardsBysprint", $cardsBysprint)
			->with("course", "")
			->with("courses", $courses)
			->with("user", $user);
	
	}));

	//Route to edit sprint for Teacher
	Route::post("admin_sprintEdit", array(
		"as" => "admin/sprintEdit", function() {
		$user = Auth::user();
		$id = Input::get('sprint');
		$course = Input::get('course');
		$sprintById = Sprint::find($id);

		$cardsBysprint = DB::table('cards')
							->where('sprint', $id)							
							->get();		
		
		$courses = DB::table('courses')
					->where('deleted_at', NULL)
					->get();

		return View::make("admin.sprint_new")
			->with("title","Sprint")
			->with("sub_title", "Edit the Sprint")
			->with("fluency", $sprintById->fluency_rate)
			->with("sprintById", $sprintById)
			->with("cardsBysprint", $cardsBysprint)
			->with("course", $course)
			->with("courses", $courses)			
			->with("user", $user);		
	}));

	//Route to new class for administrator
	Route::get("classes", array(
		"as" => "admin/classes", function(){
		$user = Auth::user();
		$classes = DB::table('classes')->where('deleted_at', NULL)->get();	
			
		return View::make("admin.classes")
				->with("title","Class")
				->with("sub_title","classall")
				->with("classes", $classes)
				->with("user", $user);	
	}));

	Route::get("classAdd", array(
		"as" => "admin/classAdd", function(){
		$user = Auth::user();
		$schools = DB::table('school')->where('deleted_at', NULL)->get();	

		return View::make("admin.class_new")
				->with("title","Class")
				->with("sub_title", "classnew")
				->with("schools", $schools)
				->with("user", $user);	
	}));	

	Route::get("classEdit/{id}", array(
		"as" => "admin/classEdit", function($id){
		$user = Auth::user();
		//$id = Session::get('id');
		$classByID = Classes::find($id);
		$schools = DB::table('school')->where('deleted_at', NULL)->get();
	
		$included_schools = DB::table('schoolclass')
					->where('class', $id)
					->get();		
		
		$school_array = array();
		$i = 0;
		foreach($included_schools as $school) {
			$school_array[$i] = $school->school;
			$i ++;
		}
		
		$students = array();
		if (sizeof($school_array) > 0) {
			$students = DB::table('users')
						->leftJoin('schooluser', 'users.id', '=', 'schooluser.user')
						->leftJoin('school', 'schooluser.school', '=', 'school.id')
						->whereIn('schooluser.school', $school_array)
						->orderBy('schooluser.school', 'asc')
						->select('users.id', 'users.first', 'users.last', 'school.name')
						->groupBy('schooluser.user')->get();
		}

		$courses = DB::table('courses')
					->where('published', 1)
					->where('deleted_at', NULL)
					->select('id', 'name', 'description')
					->get();

		return View::make("admin.class_edit")
				->with("title","Class")
				->with("sub_title", "classnew")
				->with("students", $students)
				->with("classByID", $classByID)
				->with("schools", $schools)
				->with("courses", $courses)
				->with("user", $user);
		
	}));	
});

/* 
//Authorized BY Teacher
*/

Route::group(array("before" => "auth|auth.teacher"), function(){
	//Route to teacher dashboard
	Route::get("teacher", array(
		"as" => "teacher/home", function(){
		$user = Auth::user();

		$schoolsByUser = DB::table('school')
					->leftJoin('schooluser', 'school.id', '=', 'schooluser.school')
					->where('schooluser.user', $user->id)
					->where('school.deleted_at', NULL)
					->orderBy('schooluser.school', 'asc')
					->get();

		return View::make("teacher.home")
			->with("title", "Dashboard")
			->with("sub_title", "")
			->with("schoolsByUser", $schoolsByUser)
			->with("studyroom", false)
			->with("user", $user);
	}));

	//Route to user account
	Route::get ("teacher_account", array(
		"as" =>"teacher/account", function(){
		$user = Auth::user();
		return View::make("student.account")
			->with("title","Account Information")
			->with("sub_title","")
			->with("studyroom", false)
			->with("user", $user);
	}));

	Route::get("school/courses/{id}", array(
		"as" => "teacher/school", function($id){
		$user = Auth::user();

		$school = DB::table('school')
				->where('id', $id)
				->get();

		$school_name = $school[0]->name;

		$courses = DB::select("SELECT DISTINCT(lms_classcourse.course) FROM lms_classcourse
				LEFT JOIN lms_schoolclass ON lms_schoolclass.class = lms_classcourse.class
				LEFT JOIN lms_schooluser ON lms_schooluser.school = lms_schoolclass.school
				WHERE lms_schooluser.user = " . $user->id . 
				" AND lms_schooluser.school = " . $id);

		$course_name = array();
		$course_arr = array();

		foreach($courses as $course) {
			$coursename = DB::table('courses')
					->where('id', $course->course)
					->where('deleted_at', NULL)
					->select('name')
					->get();
			$course_name[$course->course] = $coursename[0]->name;

			array_push($course_arr, $course->course);
		}

		$classes = DB::select("SELECT DISTINCT(lms_schoolclass.class) FROM lms_schoolclass
				LEFT JOIN lms_schooluser ON lms_schooluser.school = lms_schoolclass.school
				WHERE lms_schooluser.user = " . $user->id);

		$class_name = array();

		foreach($classes as $class) {
			$classname = DB::table('classes')
					->where('id', $class->class)
					->where('deleted_at', NULL)
					->select('name')
					->get();

			$class_name[$class->class] = $classname[0]->name;
		}

		if (sizeof($course_arr) > 0)
			$other_courses = DB::table('courses')
					->whereNotIn('id', $course_arr)
					->where('deleted_at', NULL)
					->get();
		else
			$other_courses = DB::table('courses')
					->where('deleted_at', NULL)
					->get();

		$all_sprints = array();

		foreach($courses as $course) {
			$sprints = DB::table('sprints')
					->where('course', $course->course)
					->where('deleted_at', NULL)
					->get();

			if (sizeof($sprints) > 0) {
				foreach($sprints as $sprint) {
					array_push($all_sprints, $sprint);
				}
			}				
		}
		
		return View::make("teacher.courses")
			->with("title","Course")
			->with("parent_title","School")
			->with("school_id", $id)
			->with("school_name", $school_name)
			->with("courses", $courses)
			->with("course_name", $course_name)
			->with("classes", $classes)
			->with("class_name", $class_name)
			->with("sprints", $all_sprints)
			->with("other_courses", $other_courses)
			->with("studyroom", false)
			->with("user", $user);
		/*$coursesByschool = DB::table('courses')
					->leftJoin('classcourse', 'classcourse.course', '=', 'courses.id')
					->leftJoin('schoolclass', 'schoolclass.class', '=', 'classcourse.class')
					->where('schoolclass.school', $id)
					->where('courses.deleted_at', NULL)
					->orderBy('schoolclass.school', 'asc')
					->get();

		$countSprints = array();
		foreach($coursesByschool as $course) {
			$sprintsBycourse = DB::table('sprints')
						->where('course', $course->id)
						->where('deleted_at', NULL)
						->get();
			
			$countSprints[$course->id] = sizeof($sprintsBycourse);
		}
		
		Session::put('school', $id);			
		return View::make("teacher.courses")
			->with("title", "Course")
			->with("coursesByschool", $coursesByschool)
			->with("countSprints", $countSprints)
			->with("school", $id)
			->with("studyroom", false)
			->with("user", $user);*/
	}));

	//Route to sprint for Teacher
	Route::get("course/teacher_sprints/{course}", array(
		"as" => "teacher/sprintsBycourse", function($course){
			$user = Auth::user();

			//$course = Input::get('course');
			$school = Session::get('school');
			$sprints = DB::table('sprints')
						->where('course', $course)
						->where('deleted_at', NULL)
						->get();				
			$courseByID = Courses::find($course);

			return View::make("teacher.sprints")
				->with("title","Sprint")
				->with("parent_title","Course")
				->with("sprints", $sprints)
				->with("school", $school)
				->with("course", $course)
				->with("courseByID", $courseByID)
				->with("studyroom", false)
				->with("user", $user);
	}));

	Route::get("all_sprints", array(
		"as" => "teacher/sprints", function(){
		$user = Auth::user();

		$courses = DB::select("SELECT DISTINCT(lms_classcourse.course) FROM lms_classcourse
				LEFT JOIN lms_schoolclass ON lms_schoolclass.class = lms_classcourse.class
				LEFT JOIN lms_schooluser ON lms_schooluser.school = lms_schoolclass.school
				WHERE lms_schooluser.user = " . $user->id);

		$course_name = array();
		$course_arr = array();

		foreach($courses as $course) {
			$coursename = DB::table('courses')
					->where('id', $course->course)
					->where('deleted_at', NULL)
					->select('name')
					->get();
			$course_name[$course->course] = $coursename[0]->name;

			array_push($course_arr, $course->course);
		}

		$classes = DB::select("SELECT DISTINCT(lms_schoolclass.class) FROM lms_schoolclass
				LEFT JOIN lms_schooluser ON lms_schooluser.school = lms_schoolclass.school
				WHERE lms_schooluser.user = " . $user->id);

		$class_name = array();

		foreach($classes as $class) {
			$classname = DB::table('classes')
					->where('id', $class->class)
					->where('deleted_at', NULL)
					->select('name')
					->get();

			$class_name[$class->class] = $classname[0]->name;
		}

		if (sizeof($course_arr) > 0)
			$other_courses = DB::table('courses')
					->whereNotIn('id', $course_arr)
					->where('deleted_at', NULL)
					->get();
		else
			$other_courses = DB::table('courses')
					->where('deleted_at', NULL)
					->get();

		$all_sprints = array();

		foreach($courses as $course) {
			$sprints = DB::table('sprints')
					->where('course', $course->course)
					->where('deleted_at', NULL)
					->get();

			$schools = DB::table('schoolclass')
					->join('classcourse', 'schoolclass.class', '=', 'classcourse.class')
					->where('classcourse.course', $course->course)
					->get();

			if (sizeof($sprints) > 0) {
				foreach($sprints as $sprint) {
					foreach ($schools as $school) {
						$arr = get_object_vars($sprint);
						$arr['school'] = $school->school;
						array_push($all_sprints, $arr);
					}
				}
			}				
		}
		
		return View::make("teacher.sprints_all")
			->with("title","My Sprints")
			->with("parent_title","Course")
			->with("courses", $courses)
			->with("course_name", $course_name)
			->with("classes", $classes)
			->with("class_name", $class_name)
			->with("sprints", $all_sprints)
			->with("other_courses", $other_courses)
			->with("studyroom", false)
			->with("user", $user);
	}));

	Route::post("teacher_quizcomplete", array(
		"as" => "teacher_quizcomplete", function() {
		$user = Auth::user();
		$post = Input::all();

		$school = $post['school'];
		$sprint_id = $post['id'];
		$correct = $post['correct_cards'];
		$incorrect = $post['incorrect_cards'];
		$total = $post['total_time'];
		$break = $post['break'];
		$interval = $post['interval'];

		$last = DB::table('transaction')
			->where('user', $user->id)
			->where('school', $school)
			->where('sprint', $sprint_id)
			->orderBy('id', 'desc')
			->get();

		$last_id = $last[0]->card;

		$sprint = DB::table('sprints')
			->where('id', $sprint_id)->where('deleted_at', NULL);

		$course = DB::table('courses')
			->where('id', $sprint->first()->course)
			->get();

		if ($total == 0 || $correct == 0)
			$speed = 0;
		else
			$speed = round(60 / $total * $correct);

		$target = $cards = $sprint->first()->fluency_rate;

		return View::make("teacher.quizcomplete")
			->with("title", $sprint->first()->name)
			->with("school", $school)
			->with("sprint_id", $sprint_id)
			->with("last_id", $last_id)
			->with("correct", $correct)
			->with("incorrect", $incorrect)
			->with("speed", $speed)		
			->with("target", $target)
			->with("course", $course[0]->name)
			->with("break", $break)
			->with("interval", $interval)
			->with("studyroom", false)
			->with("user", $user);
	}));

	Route::post ("teacher_resume", array(
		"as" => "teacher/resumecards", function() {
		$user = Auth::user();
		$sprint_id = Input::get('id');
		$school_id = Input::get('school');
		$last_id = Input::get('last_id');

		DB::table('studentprogress')
			->where('correctCards', 0)
			->where('incorrectCards', 0)
			->where('totalCards', 0)
			->where('response', 3)
			->delete();

		$total_count = DB::table('cards')
				->where('sprint', $sprint_id)
				->count();

		$mastered_count = 0;

		$progress = DB::table('studentprogress')
			->where('user', $user->id)
			->where('school', $school_id)
			->where('sprint', $sprint_id);

		if ($progress->count() > 0) {			
			$progress = $progress->get();

			if ($progress[sizeof($progress) - 1]->status == "Active") {
				$mastered_cards = $progress[sizeof($progress) - 1]->masteredCards;
				if (trim($mastered_cards) != "") {
					$mastered_cards = explode(',', trim($mastered_cards));					
				}				
			} else {
				$mastered_cards = array();
			}
			
			if (!is_array($mastered_cards)) {
				$mastered_count = 0;
			} else {
				$mastered_count = sizeof($mastered_cards);
			}

			if ($mastered_count > 0) {
				$cards = DB::table('cards')
					->where('sprint', $sprint_id)
					->whereNotIn('id', $mastered_cards)
					->get();
			} else {
				$cards = DB::table('cards')
					->where('sprint', $sprint_id)
					->get();
			}

			$setting = array(
				'response_time' => $progress[sizeof($progress) - 1]->response,
				'loops' => $progress[sizeof($progress) - 1]->loops,
				'maintenance_loops' => $progress[sizeof($progress) - 1]->maintenance,
				'active' => $progress[sizeof($progress) - 1]->active
			);
		} else {
			$cards = DB::table('cards')
				->where('sprint', $sprint_id)
				->get();

			$setting = Config::get('general.sprint');
		}

		$subcards = array();

		$j = 0;
		$last_index = 0;

		foreach ($cards as $card) {			
			$temp = DB::table('sub_cards')
				->where('cards', $card->id)
				->get();
			for ($i = 0; $i < sizeof($temp); $i++)
				array_push($subcards, $temp[$i]);		

			if ($card->id == $last_id)
				$last_index = $j;
			$j++;
		}
		
		$sprint = Sprint::find($sprint_id);

		$data['school'] = $school_id;
		$data['user'] = $user->id;
		$data['sprint'] = $sprint_id;

		App::make('SprintController')->newProgress($data, $setting);

		$progress = DB::table('studentprogress')
				->where('user', $user->id)
				->where('school', $school_id)
				->where('sprint', $sprint_id)
				->orderBy('id', 'desc')
				->get();
		
		$progress_id = $progress[0]->id;

		return View::make("teacher.resumecards")
			->with("title", $sprint->first()->name)
			->with("sprint_id", $sprint_id)
			->with("school_id", $school_id)
			->with("rate", $sprint->fluency_rate)
			->with("cards", $cards)
			->with("subcards", $subcards)
			->with("setting", $setting)
			->with("last_index", $last_index)
			->with("total_count", $total_count)
			->with("mastered_count", $mastered_count)
			->with("progress_id", $progress_id)
			->with("studyroom", true)
			->with("user", $user);		
	}));
	
	//Route to add sprint for Teacher
	Route::post("teacher_sprintAdd", array(
		"as" => "teacher/sprintAdd", function() {
		$user = Auth::user();

		$classcourses = DB::table('classcourse')
					->select(DB::raw('DISTINCT(course)'))
					->leftJoin('classstudent', 'classstudent.class', '=', 'classcourse.class')
					->where('classstudent.user', $user->id)
					->distinct()
					->get();

		$i = 0;

		$courses = array();

		foreach($classcourses as $classcourse) {
			$tmpcourses = DB::table('courses')
						->where('id', $classcourse->course)
						->where('deleted_at', NULL)
						->get();

			if (sizeof($tmpcourses) > 0) {
				foreach($tmpcourses as $tmpcourse) {
					$courses[$i] = $tmpcourse;
					$i++;
				}
			}
		}

		$course = Input::get('course');

		return View::make("teacher.sprint_new")
			->with("title","Sprint")
			->with("sub_title", "Create New Sprint")
			->with("fluency", null)
			->with("sprintById", null)
			->with("cardsBysprint", null)
			->with("course", $course)
			->with("courses", $courses)
			->with("studyroom", false)
			->with("user", $user);
	}));

	//Route to edit sprint for Teacher
	Route::get("teacher_sprintEdit/{id}", array(
		"as" => "teacher/sprintEdits", function($id) {
		$user = Auth::user();

		$sprintById = Sprint::find($id);

		$cardsBysprint = DB::table('cards')
							->where('sprint', $id)
							->get();		
		
		$courses = DB::table('courses')
					->where('deleted_at', NULL)
					->get();

		return View::make("teacher.sprint_new")
			->with("title","Sprint")
			->with("sub_title", "Edit the Sprint")
			->with("fluency", $sprintById->fluency_rate)
			->with("sprintById", $sprintById)
			->with("cardsBysprint", $cardsBysprint)
			->with("course", "")
			->with("courses", $courses)
			->with("studyroom", false)
			->with("user", $user);
	
	}));

	//Route to edit sprint for Teacher
	Route::post("teacher_sprintEdit", array(
		"as" => "teacher/sprintEdit", function() {
		$user = Auth::user();
		$id = Input::get('sprint');
		$course = Input::get('course');
		$sprintById = Sprint::find($id);

		$cardsBysprint = DB::table('cards')
							->where('sprint', $id)
							->get();		
		
		$courses = DB::table('courses')
					->where('deleted_at', NULL)
					->get();

		return View::make("teacher.sprint_new")
			->with("title","Sprint")
			->with("sub_title", "Edit the Sprint")
			->with("fluency", $sprintById->fluency_rate)
			->with("sprintById", $sprintById)
			->with("cardsBysprint", $cardsBysprint)
			->with("course", $course)
			->with("courses", $courses)
			->with("studyroom", false)		
			->with("user", $user);		
	}));

	Route::post("teacher_courseAdd", array(
		"as" => "teacher/courseAdd", function() {
		$user = Auth::user();

		$data = Input::all();

		if (isset($data['school_id']))
			$classes = DB::select("SELECT DISTINCT lms_classes.* FROM lms_classes, lms_schooluser, lms_schoolclass
						WHERE lms_classes.id=lms_schoolclass.class
						AND lms_schooluser.school = lms_schoolclass.school
						AND lms_schooluser.user = " . $user->id
						. " AND lms_schooluser.school = " . $data['school_id'] 
						. " AND lms_classes.deleted_at IS NULL ORDER BY lms_schoolclass.class");
		else
			$classes = DB::select("SELECT DISTINCT lms_classes.* FROM lms_classes, lms_schooluser, lms_schoolclass
						WHERE lms_classes.id=lms_schoolclass.class
						AND lms_schooluser.school = lms_schoolclass.school
						AND lms_schooluser.user = " . $user->id
						. " AND lms_classes.deleted_at IS NULL ORDER BY lms_schoolclass.class");
		
		return View::make("teacher.course_new")
			->with("title", "Course")
			->with("classes", $classes)
			->with("studyroom", false)
			->with("user", $user);
	}));

	Route::post("student_progress/teacher/viewProgress", array(
		"as" => "teacher/viewProgress", function() {
		$data = Input::all();
	    if(Request::ajax())
	    {
	    	$progress = DB::table('studentprogress')
	    		->where('sprint', $data['id'])
	    		->where('school', $data['school_id'])
	    		->get();

	    	$data_arr = array();
	    	$i = 0;
	    	
	    	foreach($progress as $row) {
	    		$data_arr[$i][0] = $row->updated_at;
	    		$data_arr[$i][1] = $row->correctCards;
	    		$data_arr[$i][2] = $row->incorrectCards;
	    		$i++;
	    	}

	    	return json_encode($data_arr);
	    }
	}));

	Route::post ("teacher_sprint", array(
		"as" => "teacher/flashcards", function() {
		$user = Auth::user();
		$sprint_id = Input::get('id');
		$school_id = Input::get('school');

		$total_count = DB::table('cards')
				->where('sprint', $sprint_id)
				->count();

		$cards = DB::table('cards')
			->where('sprint', $sprint_id)
			->get();

		$setting = Config::get('general.sprint');

		$subcards = array();

		foreach ($cards as $card) {
			$temp = DB::table('sub_cards')
				->where('cards', $card->id)
				->get();
			for ($i = 0; $i < sizeof($temp); $i++)
				array_push($subcards, $temp[$i]);
		}
		
		$sprint = Sprint::find($sprint_id);
		
		return View::make("teacher.play_cards")
			->with("title", $sprint->first()->name)
			->with("sprint_id", $sprint_id)
			->with("school_id", $school_id)
			->with("rate", $sprint->fluency_rate)
			->with("cards", $cards)
			->with("subcards", $subcards)
			->with("setting", $setting)
			->with("total_count", $total_count)
			->with("mastered_count", 0)
			->with("studyroom", true)
			->with("user", $user);
		
	}));

	Route::post("student_progress/teacher/viewTransaction", array(
		"as" => "teacher/viewTransaction", function() {
		$data = Input::all();
	    if(Request::ajax())
	    {
	    	$cards = DB::table('transaction')
					->select(DB::raw('DISTINCT(card)'))
					->where('sprint', $data['id'])
					->where('school', $data['school_id'])
					->orderBy('card')
					->get();

				$data_arr = array();
	    	$i = 0;

        foreach($cards as $card) {
        	$max = DB::table('transaction')
        		->select(DB::raw('MAX(response_time) as max'))
	    			->where('sprint', $data['id'])
	    			->where('card', $card->card)
	    			->get();

        	$min = DB::table('transaction')
        		->select(DB::raw('MIN(response_time) as min'))
	    			->where('sprint', $data['id'])
	    			->where('card', $card->card)
	    			->get();

	    		$data_arr[$i][0] = $card->card;
	    		$data_arr[$i][1] = $max[0]->max;
	    		$data_arr[$i][2] = $min[0]->min;
	    		$i++;
        }

	    	return json_encode($data_arr);
	    }
	}));

	Route::post("student_progress/teacher/viewDetail", array(
		"as" => "teacher/viewDetail", function() {
		$data = Input::all();
	    if(Request::ajax())
	    {
				$data_arr = array();
	    	$i = 0;

	    	$times = DB::table('transaction')
	    		->where('sprint', $data['sprint_id'])
	    		->where('school', $data['school_id'])
	    		->where('card', $data['card'])
	    		->get();

        foreach($times as $time) {
	    		$data_arr[$i][0] = $time->created_at;
	    		$data_arr[$i][1] = $time->response_time;
	    		$i++;
        }

	    	return json_encode($data_arr);
	    }
	}));

	//Route to students for Teacher
	Route::get("students", array(
		"as" => "teacher/students", function(){
		$user = Auth::user();

		$students = array();

		/*$students = DB::table('users')
					->leftJoin('schooluser', 'users.id', '=', 'schooluser.user')
					->leftJoin('school', 'school.id', '=', 'schooluser.school')
					->where('users.id', '<>', $user->id)
					->where('users.permission', '=', 'student')
					->select('users.id AS user_id', 'users.first', 'users.last', 'school.id AS school_id', 'school.name', 'school.description')
					->get();*/

		$schools = DB::table('school')
					->leftJoin('schooluser', 'school.id', '=', 'schooluser.school')
					->where('schooluser.user', '=', $user->id)
					->where('school.deleted_at', NULL)
					->get();		
		$i = 0;

		foreach($schools as $school) {
			$users = DB::table('users')
						->leftJoin('schooluser', 'users.id', '=', 'schooluser.user')
						->where('schooluser.school', $school->id)
						->where('users.permission', '=', 'student')
						->get();

			if (sizeof($users) > 0) {
				foreach($users as $user_v) {
					$students[$i]['user_id'] = $user_v->id;
					$students[$i]['first'] = $user_v->first;
					$students[$i]['last'] = $user_v->last;
					$students[$i]['interval'] = $user_v->interval;
					$students[$i]['school_id'] = $school->id;
					$students[$i]['name'] = $school->name;

					$last_progress = DB::table('studentprogress')
							->where('school', $school->id)
							->where('user', $user_v->id)
							->orderBy('id', 'desc')
							->get();

					if (sizeof($last_progress) > 0) {
						$students[$i]['last_date'] = substr($last_progress[0]->updated_at, 0, 10);

						$sprint = DB::table('sprints')
								->where('id', $last_progress[0]->sprint)
								->where('deleted_at', NULL)
								->get();

						if (sizeof($sprint) > 0)
							$students[$i]['rate'] = $last_progress[0]->speed . " / " . $sprint[0]->fluency_rate;
						else
							$students[$i]['rate'] = $last_progress[0]->speed . " / --";
					} else {
						$students[$i]['last_date'] = "--";
						$students[$i]['rate'] = "-- / --";
					}
					
					$i++;
				}
			}			
		}
		
		return View::make("teacher.students")
			->with("title","Student Progress")
			->with("students", $students)
			->with("studyroom", false)
			->with("user", $user);
	}));		
	
	Route::get("student_progress/{user_id}/{school_id}", array(
		"as" => "teacher/progress", function($user_id, $school_id){
		$user = Auth::user();

		$all_sprints = DB::table('sprints')
			->leftJoin('classcourse', 'classcourse.course', '=', 'sprints.course')
			->leftJoin('schoolclass', 'schoolclass.class', '=', 'classcourse.class')
			->leftJoin('school', 'school.id', '=', 'schoolclass.school')
			->leftJoin('schooluser', 'school.id', '=', 'schooluser.school')
			->where('schooluser.user', $user_id)
			->where('school.id', $school_id)
			->where('sprints.deleted_at', NULL)
			->select('sprints.id AS id', 'school.id AS school',
							 'sprints.course AS course', 'sprints.name AS name',
							 'sprints.description AS description', 'sprints.cards AS cards')->get();	

		$setting = Config::get('general.sprint');

		$response = $setting['response_time'];
		$loops = $setting['loops'];
		$maintenance = $setting['maintenance_loops'];
		$active = $setting['active'];
		$status = "Active";

		foreach ($all_sprints as $key => $value) {
			$is_include = DB::table('studentprogress')
					->where('studentprogress.user', $user_id)
					->where('studentprogress.school', '=', $school_id)
					->where('studentprogress.sprint', '=', $value->id);

			if ($is_include->count() <= 0) {
				$data = array(
					'school' => $value->school,
					'user' => $user_id,
					'sprint' => $value->id,
					'correctCards' => 0,
					'incorrectCards' => 0,
					'totalCards' => 0,
					'masteredCards' => "",
					'speed' => "",
					'response' => $response,
					'loops' => $loops,
					'maintenance' => $maintenance,
					'active' => $active,
					'status' => $status
				);
				App::make('SprintController')->newProgress($data, $setting);
			}
		}

		$progress = new Studentprogress();
		$sprints = DB::table('studentprogress')			
					->leftJoin('sprints', 'sprints.id', '=', 'studentprogress.sprint')
					->leftJoin('classcourse', 'classcourse.course', '=', 'sprints.course')
					->leftJoin('schoolclass', 'schoolclass.class', '=', 'classcourse.class')
					->leftJoin('courses', 'courses.id', '=', 'sprints.course')
					->where('studentprogress.user', $user_id)
					->where('schoolclass.school', '=', $school_id)
					->where('studentprogress.updated_at', '=', DB::raw("(SELECT MAX(lms_studentprogress.updated_at) 
						FROM lms_studentprogress WHERE lms_sprints.id = lms_studentprogress.sprint)"))
					->select('sprints.name AS sprint_name', 'courses.name AS course_name', 
						'studentprogress.correctCards', 'studentprogress.incorrectCards', 
						'studentprogress.speed', 'studentprogress.response', 
						'studentprogress.status', 'studentprogress.loops', 
						'studentprogress.active', 'studentprogress.updated_at', 
						'studentprogress.id', 'studentprogress.sprint')
					->get();
		
		$loops = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10");
		$wait = array("1", "1.5", "2", "2.5", "3", "3.5", "4", "4.5", "5", "5.5", 
			"6", "6.5", "7", "7.5", "8", "8.5", "9", "9.5", "10");
		$active = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10");
		$status = array("Active", "Maintenance", "Master", "Inactive");

		return View::make("teacher.progress")
			->with("title","Student Progress")
			->with("sprints", $sprints)
			->with("school_id", $school_id)
			->with("loops", $loops)
			->with("wait", $wait)
			->with("active", $active)
			->with("status", $status)
			->with("studyroom", false)
			->with("user", $user);
		
	}));

	Route::post("user/interval/", array(
		"as" => "user/interval", function() {

		$user = Input::get('user');
		$interval = Input::get('interval');

		App::make('UserController')->updateInterval($user, $interval);

		return Redirect::route('teacher/students');
	}));
});

/* 
//Authorized BY Student
*/

Route::group(array("before" => "auth|auth.student"), function(){
	
	Route::get("/", array(
		"as" => "student/home", function(){
		$user = Auth::user();

		DB::table('studentprogress')
			->where('correctCards', 0)
			->where('incorrectCards', 0)
			->where('totalCards', 0)
			->where('response', 3)
			->delete();

		$last = DB::table('transaction')
			->where('user', $user->id)
			->orderBy('id', 'desc')
			->first();

		$sprint = array();
		$sprint[0] = '';
		$last_id = '';

		if ($last != null) {
			$progress = DB::table('studentprogress')
				->where('school', $last->school)
				->where('user', $last->user)
				->where('sprint', $last->sprint)
				->orderBy('id', 'desc')
				->first();

			if ($progress == null) {
				$last = null;
			} else {
				if ($progress->status == "Active") {
					$sprint = DB::table('sprints')
						->where('id', $progress->sprint)
						->where('deleted_at', NULL)
						->get();

					if ($sprint != null) {
						$last_id = $last->card;	
					} else {
						$last = null;
					}
				} elseif ($progress->status == "Maintenance") {
					$sprint = DB::table('sprints')
						->where('id', $progress->sprint)
						->where('deleted_at', NULL)
						->get();

					$current = new DateTime(date('Y-m-d H:i:s'));
					$past = $current->diff(new DateTime($progress->updated_at));

					if ($past->days > 6) {
						$cards = DB::table('cards')
							->where('sprint', $progress->sprint)
							->orderBy('id')
							->get();
						
						$last_id = $cards[0]->id;
					} else {
						$last = null;
					}
				} else {
					$last = null;
				}
				
			}
		}
		
		return View::make("student.home")
			->with("title", "Dashboard")
			->with("studyroom", false)
			->with("last", $last)
			->with("last_id", $last_id)
			->with("sprint", $sprint[0])
			->with("user", $user);
	}));

	//Route to student dashboard
	Route::get("student", array(
		"as" => "student/home", function(){
		$user = Auth::user();

		DB::table('studentprogress')
			->where('correctCards', 0)
			->where('incorrectCards', 0)
			->where('totalCards', 0)
			->where('response', 3)
			->delete();
		
		$last = DB::table('transaction')
			->where('user', $user->id)
			->orderBy('id', 'desc')
			->first();

		$sprint = array();
		$sprint[0] = '';
		$last_id = '';

		if ($last != null) {
			$progress = DB::table('studentprogress')
				->where('school', $last->school)
				->where('user', $last->user)
				->where('sprint', $last->sprint)
				->orderBy('id', 'desc')
				->first();

			if ($progress == null) {
				$last = null;
			} else {
				if ($progress->status == "Active") {
					$sprint = DB::table('sprints')
						->where('id', $progress->sprint)
						->where('deleted_at', NULL)
						->get();

					if ($sprint != null) {
						$last_id = $last->card;	
					} else {
						$sprint[0] = '';
						$last = null;
					}
				} elseif ($progress->status == "Maintenance") {
					$sprint = DB::table('sprints')
						->where('id', $progress->sprint)
						->where('deleted_at', NULL)
						->get();

					$current = new DateTime(date('Y-m-d H:i:s'));
					$past = $current->diff(new DateTime($progress->updated_at));

					if ($past->days > 6) {
						$cards = DB::table('cards')
							->where('sprint', $progress->sprint)
							->orderBy('id')
							->get();
						
						$last_id = $cards[0]->id;
					} else {
						$last = null;
					}
				} else {
					$last = null;
				}
				
			}
		}
		
		return View::make("student.home")
			->with("title", "Dashboard")
			->with("studyroom", false)
			->with("last", $last)
			->with("last_id", $last_id)
			->with("sprint", $sprint[0])
			->with("user", $user);
	}));

	Route::get("student_sprints", array(
		"as" => "student/sprints", function(){
		$user = Auth::user();

		DB::table('studentprogress')
			->where('correctCards', 0)
			->where('incorrectCards', 0)
			->where('totalCards', 0)
			->where('response', 3)
			->delete();

		$sprints = DB::table('sprints')
			->Join('classcourse', 'classcourse.course', '=', 'sprints.course')
			->Join('schoolclass', 'schoolclass.class', '=', 'classcourse.class')
			->Join('school', 'school.id', '=', 'schoolclass.school')
			->Join('schooluser', 'school.id', '=', 'schooluser.school')
			->where('schooluser.user', $user->id)
			->where('sprints.deleted_at', NULL)
			->select('sprints.id AS id', 'school.id AS school', 
					 'school.name AS schoolName', 'sprints.level',
					 'sprints.course AS course', 'sprints.name AS name',
					 'sprints.description AS description', 'sprints.cards AS cards')
			->get();

		$course_name = array();
		$masteredCards = array();
		$masteredCard = array();
		$status = array();
		$play_status = array();

		$last_id = array();

		foreach ($sprints as $sprint) {
			$progress = DB::table('studentprogress')
					->where('school', $sprint->school)
					->where('user', $user->id)
					->where('sprint', $sprint->id)
					->get();

			if (sizeof($progress) > 0) {
				$index = sizeof($progress) - 1;				
				$masteredCards[$sprint->school . '-' . $sprint->id] = $progress[$index]->masteredCards;
				$status[$sprint->school . '-' . $sprint->id] = $progress[$index]->status;

				if ($status[$sprint->school . '-' . $sprint->id] == "Active") {
					$play_status[$sprint->school . '-' . $sprint->id] = true;
				} elseif ($status[$sprint->school . '-' . $sprint->id] == "Maintenance") {
					$play_status[$sprint->school . '-' . $sprint->id] = false;

					if ($progress[sizeof($progress) - 1]->maintenance > 0) {
						$current = new DateTime(date('Y-m-d H:i:s'));
						$past = $current->diff(new DateTime($progress[$index]->updated_at));

						if ($past->days > 6)
							$play_status[$sprint->school . '-' . $sprint->id] = true;
					}
				} elseif ($status[$sprint->school . '-' . $sprint->id] == "Master") {
					$play_status[$sprint->school . '-' . $sprint->id] = false;
				}
			} else {				
				$masteredCards[$sprint->school . '-' . $sprint->id] = "";
				$status[$sprint->school . '-' . $sprint->id] = "Active";
				$play_status[$sprint->school . '-' . $sprint->id] = true;
			}

			$course = DB::table('courses')
				->where('id', $sprint->course)
				->where('deleted_at', NULL)
				->get();

			$course_name[$sprint->school . '-' . $sprint->id] = $course[0]->name;

			$last_card = DB::table('transaction')
					->where('user', $user->id)
					->where('school', $sprint->school)
					->where('sprint', $sprint->id)
					->orderBy('id', 'desc')
					->first();

			if ($last_card == null)
				$last_id[$sprint->school . '-' . $sprint->id] = '';
			else
				$last_id[$sprint->school . '-' . $sprint->id] = $last_card->card;
		}

		return View::make("student.sprints")
			->with("title","Sprint")
			->with("sprints", $sprints)
			->with("course_name", $course_name)
			->with("masteredCards", $masteredCards)
			->with("play_status", $play_status)
			->with("status", $status)
			->with("last_id", $last_id)
			->with("studyroom", false)
			->with("user", $user);
	}));

	Route::get("course/student_sprints/{course}", array(
		"as" => "student/sprintsBycourse", function($course){
		$user = Auth::user();
		$sprints = DB::table('sprints')
					->where('course', $course)
					->where('deleted_at', NULL)
					->get();

		return View::make("student.sprints")
			->with("title","Sprint")
			->with("sprints", $sprints)
			->with("user", $user);
	}));

	Route::get("student_school/{school}", array(
		"as" => "students/school", function($school){
		$user = Auth::user();
		$schoolInfo = School::find($school);

		$schools = DB::table('school')
					->leftJoin('schooluser', 'school.id', '=', 'schooluser.school')
					->where('schooluser.user', $user->id)
					->where('school.deleted_at', NULL)
					->orderBy('schooluser.school', 'asc')
					->get();


		$classes = DB::table('classes')
					->join('schoolclass', 'classes.id', '=', 'schoolclass.class')
					->where('schoolclass.school', $school)
					->where('classes.deleted_at', NULL)
					->orderBy('classes.name', 'asc');


		return View::make("student.schools")
			->with("title", "My School")
			->with("schoolInfo", $schoolInfo)
			->with("classes", $classes)
			->with("schools", $schools)
			->with("user", $user);
	}));

	//Route to user account
	Route::get ("account", array(
		"as" =>"student/account", function(){
		$user = Auth::user();

		return View::make("student.account")
			->with("title","Account Information")
			->with("sub_title","")
			->with("studyroom", false)
			->with("user", $user);
	}));

	/* Card START*/
	Route::post ("student_card", array(
		"as" => "student/card", function() {
		$user = Auth::user();
		$id = Input::get('id');
		
		$cards = DB::table('cards')
			->where('sprint', $id)
			->get();

		$subcards = array();
		foreach ($cards as $card) {
			$temp = DB::table('sub_cards')
				->where('cards', $card->id)
				->where('correctanswer', 1)
				->get();
			if (sizeof($temp) > 0) {
				array_push($subcards, $temp[0]);
			}
		}

		$sprint = DB::table('sprints')
			->where('id', $id)
			->where('deleted_at', NULL);
			
		return View::make("student.cards")
			->with("title", $sprint->first()->name)
			->with("sprint_id", $id)
			->with("cards", $cards)
			->with("subcards", $subcards)
			->with("studyroom", false)
			->with("user", $user);
	}));
	
	Route::post ("student_resume", array(
		"as" => "student/resumecards", function() {
		$user = Auth::user();
		$sprint_id = Input::get('id');
		$school_id = Input::get('school');
		$last_id = Input::get('last_id');

		DB::table('studentprogress')
			->where('correctCards', 0)
			->where('incorrectCards', 0)
			->where('totalCards', 0)
			->where('response', 3)
			->delete();

		$total_count = DB::table('cards')
				->where('sprint', $sprint_id)
				->count();

		$mastered_count = 0;

		$progress = DB::table('studentprogress')
			->where('user', $user->id)
			->where('school', $school_id)
			->where('sprint', $sprint_id);

		if ($progress->count() > 0) {			
			$progress = $progress->get();

			if ($progress[sizeof($progress) - 1]->status == "Active") {
				$mastered_cards = $progress[sizeof($progress) - 1]->masteredCards;
				if (trim($mastered_cards) != "") {
					$mastered_cards = explode(',', trim($mastered_cards));					
				}				
			} else {
				$mastered_cards = array();
			}
			
			if (!is_array($mastered_cards)) {
				$mastered_count = 0;
			} else {
				$mastered_count = sizeof($mastered_cards);
			}

			if ($mastered_count > 0) {
				$cards = DB::table('cards')
					->where('sprint', $sprint_id)
					->whereNotIn('id', $mastered_cards)
					->get();
			} else {
				$cards = DB::table('cards')
					->where('sprint', $sprint_id)
					->get();
			}

			$setting = array(
				'response_time' => $progress[sizeof($progress) - 1]->response,
				'loops' => $progress[sizeof($progress) - 1]->loops,
				'maintenance_loops' => $progress[sizeof($progress) - 1]->maintenance,
				'active' => $progress[sizeof($progress) - 1]->active
			);
		} else {
			$cards = DB::table('cards')
				->where('sprint', $sprint_id)
				->get();

			$setting = Config::get('general.sprint');
		}

		$subcards = array();

		$j = 0;
		$last_index = 0;

		foreach ($cards as $card) {			
			$temp = DB::table('sub_cards')
				->where('cards', $card->id)
				->get();
			for ($i = 0; $i < sizeof($temp); $i++)
				array_push($subcards, $temp[$i]);		

			if ($card->id == $last_id)
				$last_index = $j;
			$j++;
		}
		
		$sprint = Sprint::find($sprint_id);

		$data['school'] = $school_id;
		$data['user'] = $user->id;
		$data['sprint'] = $sprint_id;

		App::make('SprintController')->newProgress($data, $setting);

		$progress = DB::table('studentprogress')
				->where('user', $user->id)
				->where('school', $school_id)
				->where('sprint', $sprint_id)
				->orderBy('id', 'desc')
				->get();
		
		$progress_id = $progress[0]->id;

		return View::make("student.resumecards")
			->with("title", $sprint->first()->name)
			->with("sprint_id", $sprint_id)
			->with("school_id", $school_id)
			->with("rate", $sprint->fluency_rate)
			->with("cards", $cards)
			->with("subcards", $subcards)
			->with("setting", $setting)
			->with("last_index", $last_index)
			->with("total_count", $total_count)
			->with("mastered_count", $mastered_count)
			->with("progress_id", $progress_id)
			->with("studyroom", true)
			->with("user", $user);		
	}));

	Route::post ("student_quiz", array(
		"as" => "student/flashcards", function() {
		$user = Auth::user();
		$sprint_id = Input::get('id');
		$school_id = Input::get('school');

		DB::table('studentprogress')
			->where('correctCards', 0)
			->where('incorrectCards', 0)
			->where('totalCards', 0)
			->where('response', 3)
			->delete();

		$total_count = DB::table('cards')
				->where('sprint', $sprint_id)
				->count();

		$mastered_count = 0;

		$progress = DB::table('studentprogress')
				->where('user', $user->id)
				->where('school', $school_id)
				->where('sprint', $sprint_id)
				->orderBy('id');

		if ($progress->count() > 0) {
			$progress = $progress->get();

			if ($progress[sizeof($progress) - 1]->status == "Active") {
				$mastered_cards = $progress[sizeof($progress) - 1]->masteredCards;
				$mastered_cards = explode(',', $mastered_cards);
			} else {
				$mastered_cards = array();
			}

			if (!is_array($mastered_cards)) {
				$mastered_count = 0;
			} else {
				$mastered_count = sizeof($mastered_cards);
			}

			if (sizeof($mastered_cards) > 0) {
				$cards = DB::table('cards')
					->where('sprint', $sprint_id)
					->whereNotIn('id', $mastered_cards)
					->get();
			} else {
				$cards = DB::table('cards')
					->where('sprint', $sprint_id)
					->get();
			}

			$setting = array(
				'response_time' => $progress[sizeof($progress) - 1]->response,
				'loops' => $progress[sizeof($progress) - 1]->loops,
				'maintenance_loops' => $progress[sizeof($progress) - 1]->maintenance,
				'active' => $progress[sizeof($progress) - 1]->active
			);
		} else {
			$cards = DB::table('cards')
				->where('sprint', $sprint_id)
				->get();

			$setting = Config::get('general.sprint');
		}

		$subcards = array();

		foreach ($cards as $card) {
			$temp = DB::table('sub_cards')
				->where('cards', $card->id)
				->get();
			for ($i = 0; $i < sizeof($temp); $i++)
				array_push($subcards, $temp[$i]);
		}
		
		$sprint = Sprint::find($sprint_id);

		$data['school'] = $school_id;
		$data['user'] = $user->id;
		$data['sprint'] = $sprint_id;

		App::make('SprintController')->newProgress($data, $setting);

		$progress = DB::table('studentprogress')
				->where('user', $user->id)
				->where('school', $school_id)
				->where('sprint', $sprint_id)
				->orderBy('id', 'desc')
				->get();
		
		$progress_id = $progress[0]->id;
		
		return View::make("student.flashcards")
			->with("title", $sprint->first()->name)
			->with("sprint_id", $sprint_id)
			->with("school_id", $school_id)
			->with("rate", $sprint->fluency_rate)
			->with("cards", $cards)
			->with("subcards", $subcards)
			->with("setting", $setting)
			->with("total_count", $total_count)
			->with("mastered_count", $mastered_count)
			->with("progress_id", $progress_id)
			->with("studyroom", true)
			->with("user", $user);		
		
	}));

	Route::post("student_quizcomplete", array(
		"as" => "student/quizcomplete", function() {
		$user = Auth::user();
		$post = Input::all();

		$school = $post['school'];
		$sprint_id = $post['id'];
		$correct = $post['correct_cards'];
		$incorrect = $post['incorrect_cards'];
		$total = $post['total_time'];
		$break = $post['break'];
		$interval = $post['interval'];

		$last = DB::table('transaction')
			->where('user', $user->id)
			->where('school', $school)
			->where('sprint', $sprint_id)
			->orderBy('id', 'desc')
			->get();

		$last_id = $last[0]->card;

		$sprint = DB::table('sprints')
			->where('id', $sprint_id)->where('deleted_at', NULL);

		$course = DB::table('courses')
			->where('id', $sprint->first()->course)
			->get();

		if ($total == 0 || $correct == 0)
			$speed = 0;
		else
			$speed = round(60 / $total * $correct);

		$target = $cards = $sprint->first()->fluency_rate;

		return View::make("student.quizcomplete")
			->with("title", $sprint->first()->name)
			->with("school", $school)
			->with("sprint_id", $sprint_id)
			->with("last_id", $last_id)
			->with("correct", $correct)
			->with("incorrect", $incorrect)
			->with("speed", $speed)		
			->with("target", $target)
			->with("course", $course[0]->name)
			->with("break", $break)
			->with("interval", $interval)
			->with("studyroom", false)
			->with("user", $user);			
	}));
});

Route::get("student/transaction/{student}/{school}/{sprint}/{card}/{is_corrected}/{no_answer}/{response_time}/{random}", array(
	"as" => "student/transaction", function($student, $school, $sprint, $card, $is_corrected, $no_answer, $response_time, $random) {

	if(Request::ajax())
    {	
    	App::make('SprintController')->setTransaction($school, $student, $sprint, $card, 
    		$response_time, $is_corrected, $no_answer);
    }
}));

Route::get("student/progress/{id}/{student}/{school}/{sprint}/{correct}/{incorrect}/{total}/{mastered}/{time}/{random}", array(
	"as" => "student/progress", function($id, $student, $school, $sprint, $correct, $incorrect, $total, $mastered, $time, $random) {

	if(Request::ajax())
    {
    	$speed = round(60 / $total * $correct);

    	$data['correctCards'] = $correct;
    	$data['incorrectCards'] = $incorrect;
    	$data['totalCards'] = $total;
    	$data['masteredCards'] = $mastered;
    	$data['speed'] = $speed;

    	$progress = DB::table('studentprogress')
    			->where('school', $school)
    			->where('user', $student)
    			->where('sprint', $sprint)
    			->where('id', '<>', $id)
    			->orderBy('id', 'desc')
    			->get();

    	if (sizeof($progress) > 0) {
    		$data['response'] = $progress[0]->response;
    		$data['loops'] = $progress[0]->loops;
    		$data['active'] = $progress[0]->active;

    		$mastered_array = explode(',', $mastered);

    		if ($progress[0]->status == "Active") {
    			$original_array = explode(',', $progress[0]->masteredCards);
    			$mastered_array = array_merge($mastered_array, $original_array);
    			sort($mastered_array);

    			$mastered = '';
    			foreach($mastered_array as $value)
    				$mastered .= ($value . ',');

					$data['masteredCards'] = substr($mastered, 0, strlen($mastered) - 1);	    			
    		}

    		$sprints = DB::table('sprints')
    				->where('id', $sprint)
    				->where('deleted_at', NULL)
    				->get();

    		$card_array = explode(',', $sprints[0]->cards);

    		if (sizeof($mastered_array) == sizeof($card_array)) {
    			$data['maintenance'] = $progress[0]->maintenance--;
    			if ($progress[0]->maintenance > 0)
    				$data['status'] = 'Maintenance';
    			else
    				$data['status'] = 'Master';
    		} else {
					$data['maintenance'] = $progress[0]->maintenance;
					$data['status'] = 'Active';
				}
    	} else {
    		$setting = Config::get('general.sprint');

	  		$data['response'] = $setting['response_time'];
	  		$data['loops'] = $setting['loops'];
	  		$data['maintenance'] = $setting['maintenance_loops'];
	  		$data['active'] = $setting['active'];
	  		$data['status'] = 'Active';

	  		$mastered_array = explode(',', $mastered);
	  		sort($mastered_array);

	  		$mastered = '';
				foreach($mastered_array as $value)
					$mastered .= ($value . ',');

				$data['masteredCards'] = substr($mastered, 0, strlen($mastered) - 1);

	  		$sprints = DB::table('sprints')
	  				->where('id', $sprint)
	  				->where('deleted_at', NULL)
	  				->get();

	  		$card_array = explode(',', $sprints[0]->cards);

	  		if (sizeof($mastered_array) == sizeof($card_array)) {
	  			$data['maintenance']--;
	  			if ($data['maintenance'] > 0)
	  				$data['status'] = 'Maintenance';
	  			else
	  				$data['status'] = 'Master';
	  		} else {
					$data['status'] = 'Active';
				}
    	}

    	App::make('SprintController')->setProgress($id, $data);
    }
}));

/*
//POST Routes
*/
//Route to UserController login method
Route::post("user/login", array(
	"uses" => "UserController@loginAction"
));
//Route to UserController password reset request method
Route::post("user/request", array(
	"uses" => "UserController@requestAction"
));

//Route to UserController password reset method
Route::post("reset", array(
	"uses" => "UserController@resetAction"
));

//Route to UserController password reset method
Route::post("verify", array(
	"uses" => "UserController@verifyAction"
));

//Route to UserController registration method
Route::post ("user/register", array(
	"before" => "csrf", 
	"uses" => "UserController@registerAction"
));

//Route to UserController account method
Route::post ("account/update", array(
	"before" => "csrf",
	"uses" => "UserController@accountInfo"
));

//Route to UserController addUser method
Route::post ("user/add", array(
	"as" => "user/add",
	"before" => "csrf",
	"uses" => "UserController@addUser"
));

//Route to UserController update method
Route::post ("user/update", array(
	"as" => "user/update",
	"uses" => "UserController@updateAction"
));

//Route to UserController delete method
Route::post ("user/delete", array(
	"as" => "user/delete",
	"uses" => "UserController@deleteAction"
));

/* Progress START */
Route::post ("progress/update", array(
	"as" => "progress/update",
	"before" => "csrf",
	"uses" => "SprintController@progressAction"
));

/* Progress END */
/* school START */
//Route to SchoolController add method
Route::post ("school/add", array(
	"as" => "school/add",
	"before" => "csrf",
	"uses" => "SchoolController@addAction"
));

//Route to SchoolController delete method
Route::post ("school/delete", array(
	"as" => "school/delete",
	"uses" => "SchoolController@deleteAction"
));

//Route to ClassController update method
Route::post ("school/update", array(
	"as" => "school/update",
	"before" => "csrf",
	"uses" => "SchoolController@updateAction"
));

//Route to ClassController studentsAction method
Route::post ("school/classes", array(
	"as" => "school/classes",
	"before" => "csrf",
	"uses" => "SchoolController@classesAction"
));

//Route to ClassController studentsAction method
Route::post ("course/sprints", array(
	"as" => "course/sprints",
	"before" => "csrf",
	"uses" => "SchoolController@classesAction"
));

//Route to ClassController studentsAction method
Route::post ("school/users", array(
	"as" => "school/users",
	"before" => "csrf",
	"uses" => "SchoolController@usersAction"
));

//Route to ClassController studentsAction method
Route::post ("class/courses", array(
	"as" => "class/courses",
	"before" => "csrf",
	"uses" => "ClassController@coursesAction"
));
/* school END */

/* course START */
//Route to CourseController add method
Route::post ("course/add", array(
	"as" => "course/add",
	"before" => "csrf",
	"uses" => "CourseController@addAction"
));

Route::post ("teacher/course/add", array(
	"as" => "course/add",
	"before" => "csrf",
	"uses" => "CourseController@teacherAddAction"
));

Route::post ("teacher/course/delete", array(
	"as" => "course/delete",
	"before" => "csrf",
	"uses" => "CourseController@teacherDeleteAction"
));

Route::post("teacher_courseInclude", array(
	"as" => "teacher/courseInclude",
	"before" => "csrf",
	"uses" => "CourseController@addCourse"	
));

//Route to CourseController delete method
Route::post ("course/delete", array(
	"as" => "course/delete",
	"uses" => "CourseController@deleteAction"
));

//Route to CourseController update method
Route::post ("course/update", array(
	"as" => "course/update",
	"before" => "csrf",
	"uses" => "CourseController@updateAction"
));
/* course END */

//Route to ClassController delete method
Route::post ("class/delete", array(
	"as" => "class/delete",
	"uses" => "ClassController@deleteAction"
));

//Route to ClassController add method
Route::post ("class/add", array(
	"as" => "class/add",
	"before" => "csrf",
	"uses" => "ClassController@addAction"
));

//Route to ClassController update method
Route::post ("class/update", array(
	"as" => "class/update",
	"before" => "csrf",
	"uses" => "ClassController@updateAction"
));

//Route to ClassController studentsAction method
Route::post ("class/students", array(
	"as" => "class/students",
	"before" => "csrf",
	"uses" => "ClassController@studentsAction"
));
/* class END */

/* Sprint START */
//Route to SprintController add method
Route::post ("sprint/add", array(
	"as" => "sprint/add",
	"before" => "csrf",
	"uses" => "SprintController@addAction"
));

//Route to SprintController delete method
Route::post ("sprint/delete", array(
	"as" => "sprint/delete",
	"before" => "csrf",
	"uses" => "SprintController@deleteAction"
));
/* Sprint END */

Route::post('charge/pro_checkout',  array(
	"uses" => "ChargeController@proPlanAction"
));

Route::post('charge/premium_checkout',  array(
	"uses" => "ChargeController@premiumPlanAction"
));

Route::post('charge/free_checkout',  array(
	"uses" => "ChargeController@freePlanAction"
));

Route::post('register/pro_checkout',  array(
	"uses" => "UserController@registerAction"
));

Route::post('register/premium_checkout',  array(
	"uses" => "UserController@registerAction"
));

Route::post('register/free_checkout',  array(
	"uses" => "UserController@registerAction"
));

/*
// Log user out
*/
Route::get('logout', array('as' => 'logout', function () {
    Auth::logout();

    return Redirect::route('user/login')
        ->with('flash_notice', 'You are successfully logged out.');
}))->before('auth');

/*
//Modal views
*/
//Add new addSound modal
Route::get ("modals/addSound/{type}/{id}", array(
	"as" => "modals/addSound", function($type, $id){

		if ($type == "back") {
			$params = explode(',', $id);
			$parent = $params[0];
			$key = $params[1];
		} else {
			$parent = $id;
			$key = 0;
		}

		return View::make('modals.addSound')
						->with('type', $type)
						->with('parent', $parent)
						->with('key', $key);

}));

//Add new addImage modal
Route::get ("modals/addImage/{type}/{id}", array(
	"as" => "modals/addImage", function($type, $id){

		if ($type == "back") {
			$params = explode(',', $id);
			$parent = $params[0];
			$key = $params[1];
		} else {
			$parent = $id;
			$key = 0;
		}

		return View::make('modals.addImage')
						->with('type', $type)
						->with('parent', $parent)
						->with('key', $key);
								
}));

Route::post( 'asset/delete', array(
	'uses' => 'SprintController@asssetAction'
) );

Route::post( '/addImageFile', array(
    'as' => 'addImageFile',
    'uses' => 'ImageUploadController@construct'
) );

//Settings: show form to create settings
Route::get( '/addSoundFile', array(
    'as' => 'addSoundFile',
    'uses' => 'ImageUploadController@construct'
) );

Route::post( '/addSoundFile', array(
    'as' => 'addSoundFile',
    'uses' => 'ImageUploadController@construct'
) );

//Settings: show form to create settings
Route::get( '/addImageFile', array(
    'as' => 'addImageFile',
    'uses' => 'ImageUploadController@construct'
) );

//Add new user modal
Route::get ("modals/userAdd", array(
	"as" => "modals/userAdd", function(){
		return View::make('modals.userAdd');
}));

Route::get ("modals/manageImage/{type}/{id}/{picture}", array(
	"as" => "modals/manageImage", function($type, $id, $picture){
		
		$viewer = "";
		
		if ($type == 'Story') {
			$viewer = "modals.storyImageAdd";
		} 

		if ($id == "add" && $picture == "add") {
			$id = 0;
			$picture = "";
		}

		return View::make($viewer)
			   ->with("picture", $picture)
			   ->with("path", '../../assets/uploads/original/')
			   ->with("id", $id);			  
}));