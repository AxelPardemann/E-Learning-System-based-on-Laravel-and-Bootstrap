<?php

use Carbon\Carbon;

class Studentprogress extends Eloquent {

	protected $table = 'studentprogress';

	public static function getUpdatedAtAttribute($value)
	{
		return Carbon::parse($value)->format('m-d');
	}

}