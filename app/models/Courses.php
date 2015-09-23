<?php

class Courses extends Eloquent {

	protected $table = 'courses';

	public function sprints(){
		return $this->hasMany('Sprint', 'course', 'id');
	}	
}