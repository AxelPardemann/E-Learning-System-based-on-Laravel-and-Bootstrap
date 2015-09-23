<?php

class Message extends Eloquent {

	protected $table = 'messages';

	public function setCreatedAtAttribute($value)
	{
		// Do nothing.
	}

}