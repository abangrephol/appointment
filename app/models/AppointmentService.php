<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AppointmentService extends Ardent {

    use SoftDeletingTrait;

    protected $table = 'appointment_services';

    protected $dates = ['deleted_at'];

    protected $fillable = [];

    public static $relationsData = array(
        'appointment'  => array(self::BELONGS_TO, 'Appointment'),
        'service'  => array(self::BELONGS_TO, 'Services'),
        'employee'  => array(self::BELONGS_TO, 'Employee')
    );
}