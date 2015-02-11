<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Cartalyst\Sentry\Users\Eloquent\User implements UserInterface, RemindableInterface{
    use  UserTrait, RemindableTrait;


    public static $passwordAttributes  = array('password');
    public $autoHashPasswordAttributes = true;

    protected $table = 'users';

    protected $dates = ['deleted_at'];

	protected $fillable = ['first_name','last_name','email','username','password','subscription_id','is_active'];


    public static $rulesCreate = array(
        'first_name'                 => 'required|between:4,50',
        'last_name'                  => 'between:4,50',
        'email'                 => 'required|email',
        'username'              => 'required|alpha_num|min:5',
        'password'              => 'required|alpha_num|between:4,8|confirmed',
        'password_confirmation' => 'alpha_num|between:4,8',

    );
    public  static  $rulesUpdate = array(
        'first_name'                 => 'required|between:4,50',
        'last_name'                  => 'between:4,50',
        'email'                 => 'required|email',
        'username'              => 'required|alpha_num|min:5',
        'old_password'              => 'required_with:password|alpha_num|between:4,8',
        'password'          => 'required_with:old_password|alpha_num|between:4,8|confirmed',
        'password_confirmation' => 'alpha_num|between:4,8',
    );
}