<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Ardent implements UserInterface, RemindableInterface{
    use SoftDeletingTrait, UserTrait, RemindableTrait;
    protected $softDelete = true;

    public static $passwordAttributes  = array('password');
    public $autoHashPasswordAttributes = true;

    protected $table = 'users';

    protected $dates = ['deleted_at'];

	protected $fillable = ['first','last','email','username','password','subscription_id','is_active'];

    public static $relationsData = array(
        'subscription'  => array(self::BELONGS_TO, 'Subscription'),
        'service' => array(self::HAS_MANY, 'Services')
    );
    public static $rulesCreate = array(
        'first'                 => 'required|between:4,50',
        'last'                  => 'between:4,50',
        'email'                 => 'required|email',
        'username'              => 'required|alpha_num|min:5',
        'password'              => 'required|alpha_num|between:4,8|confirmed',
        'password_confirmation' => 'alpha_num|between:4,8',

    );
    public  static  $rulesUpdate = array(
        'first'                 => 'required|between:4,50',
        'last'                  => 'between:4,50',
        'email'                 => 'required|email',
        'username'              => 'required|alpha_num|min:5',
        'old_password'              => 'required_with:password|alpha_num|between:4,8',
        'password'          => 'required_with:old_password|alpha_num|between:4,8|confirmed',
        'password_confirmation' => 'alpha_num|between:4,8',
    );
}