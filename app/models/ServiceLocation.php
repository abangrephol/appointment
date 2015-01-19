<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ServiceLocation extends Ardent {

    use SoftDeletingTrait;
    protected $softDelete = true;

    protected $table = 'service_locations';

    protected $dates = ['deleted_at'];

    protected $fillable = [];

    public static $rulesCreate = array(
        'name'                 => 'required|between:5,50',
        'description'                  => 'required|min:5',
        'address'                  => 'required|min:5',
        'timezone'                  => 'required|min:5',
        'gmap'                  => 'min:5',
    );
    public static $rulesUpdate = array(
        'name'                 => 'required|between:5,50',
        'description'                  => 'required|min:5',
        'address'                  => 'required|min:5',
        'timezone'                  => 'required|min:5',
        'gmap'                  => 'min:5',
    );
}