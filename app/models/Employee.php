<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Employee extends Ardent {

    use SoftDeletingTrait;
    protected $softDelete = true;

    protected $table = 'employees';

    protected $dates = ['deleted_at'];

    protected $fillable = [];

    public static $rulesCreate = array(
        'first'                 => 'required|between:4,50',
        'last'                  => 'between:4,50',
        'email'                 => 'required|email',
        'title'              => 'between:1,30',
        'phone'              => 'between:4,50',
        'phone_ext'              => 'between:1,6',


    );
    public  static  $rulesUpdate = array(
        'first'                 => 'required|between:4,50',
        'last'                  => 'between:4,50',
        'email'                 => 'required|email',
        'title'                  => 'between:1,30',
        'phone'                  => 'between:4,50',
        'phone_ext'              => 'between:1,6',
    );

}