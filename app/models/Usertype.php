<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usertype extends Eloquent implements UserInterface, RemindableInterface {

	protected $table = 'usertype';

}