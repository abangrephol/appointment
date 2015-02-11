<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Auth\Reminders\RemindableTrait;

class Specialize extends Ardent{

    protected $table = 'specializes';

    protected $dates = ['deleted_at'];

    public static $relationsData = array(
        'subscription'  => array(self::BELONGS_TO, 'Subscription')
    );

}