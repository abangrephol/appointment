<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Customer extends Ardent {

    use SoftDeletingTrait;
    protected $softDelete = true;

    public static $passwordAttributes  = array('password');
    public $autoHashPasswordAttributes = true;

    protected $table = 'customers';

    protected $dates = ['deleted_at'];

    protected $fillable = [];

    public static $rulesCreate = array(
        'first'                 => 'required|between:4,50',
        'last'                  => 'between:4,50',
        'email'                 => 'required|email',
        'address_1'              => 'between:1,30',
        'address_2'              => 'between:4,50',
        'zip'                    => 'between:4,10',
        'username'              => 'required_with:password|alpha_num|min:5',
        'password'              => 'required_with:username|alpha_num|between:4,8|confirmed',
        'password_confirmation' => 'alpha_num|between:4,8',


    );
    public static $rulesUpdate = array(
        'first'                 => 'required|between:4,50',
        'last'                  => 'between:4,50',
        'email'                 => 'required|email',
        'address_1'              => 'between:1,30',
        'address_2'              => 'between:4,50',
        'zip'                    => 'between:4,10',
        'username'              => 'required_with:password|alpha_num|min:5',
        'old_password'              => 'required_with:password|alpha_num|between:4,8',
        'password'          => 'required_with:old_password|alpha_num|between:4,8|confirmed',
        'password_confirmation' => 'alpha_num|between:4,8',


    );
}