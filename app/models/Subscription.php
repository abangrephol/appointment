<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Subscription extends Ardent {

    use SoftDeletingTrait;

    protected $table = 'subscriptions';

    protected $dates = ['deleted_at'];

	protected $fillable = [];

    public static $relationsData = array(
        'user'  => array(self::HAS_MANY, 'User'),
        'customer'  => array(self::HAS_MANY, 'Customer'),
        'employee'  => array(self::HAS_MANY, 'Employee'),
        'appointment'  => array(self::HAS_MANY, 'Appointment'),
        'service'  => array(self::HAS_MANY, 'Services'),
        'customform'  => array(self::HAS_MANY, 'CustomForm'),
        'specialize' => array(self::HAS_MANY,'Specialize')
    );
}