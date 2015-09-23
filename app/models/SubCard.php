<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class SubCard extends Eloquent {

	protected $table = 'sub_cards';
	public $timestamps = false;
	
	public function setUpdatedAtAttribute($value)
	{
		// Do nothing.
	}

	public function setCreatedAtAttribute($value)
	{
		// Do nothing.
	}
}