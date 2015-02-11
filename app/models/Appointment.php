<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Appointment extends Ardent {

    use SoftDeletingTrait;
    protected $softDelete = true;

    protected $table = 'appointments';

    protected $dates = ['deleted_at'];

    protected $fillable = [];

    public static $relationsData = array(
        'customer'  => array(self::BELONGS_TO, 'Customer'),
        'appointmentService' => array(self::HAS_MANY, 'AppointmentService')
    );

    public static $rulesCreate = array(
        'customer_id'   =>  'required|number',
        'confirmation_number'   =>  'required|alpha_num',
        'note'   =>  'alpha_num|min:5',
        'price'   =>  'required|number',
        'price_tax'   =>  'required|number',
        'price_deposit'   =>  'required|number',
        'price_total'   =>  'required|number',
        'status'   =>  'required',

    );
    public static $rulesUpdate = array(
        'customer_id'   =>  'required|number',
        'confirmation_number'   =>  'required|alpha_num',
        'note'   =>  'alpha_num|min:5',
        'price'   =>  'required|number',
        'price_tax'   =>  'required|number',
        'price_deposit'   =>  'required|number',
        'price_total'   =>  'required|number',
        'status'   =>  'required',

    );
    public static function getForUser(){
        return Subscription::find(Sentry::getUser()->subscription_id)->appointment()->get();
    }
}