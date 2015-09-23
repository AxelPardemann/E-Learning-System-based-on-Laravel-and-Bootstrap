<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Transaction extends Eloquent {

	protected $table = 'transaction';

	public function setUpdatedAtAttribute($value)
	{
		// Do nothing.
	}
}