<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Services extends Ardent {

    use SoftDeletingTrait;
    protected $softDelete = true;

    protected $table = 'services';

    protected $dates = ['deleted_at'];

    protected $fillable = [];
    public static $relationsData = array(
        'subscription' => array(self::BELONGS_TO, 'Subscription'),
        'customforms' => array(self::HAS_MANY,'ServiceCustomForm'),
        'customform' => array(self::BELONGS_TO_MANY,'CustomForm','table'=>'services_custom_forms')
    );
    public static $rulesCreate = array(
        'name'                 => 'required|between:5,50',
        'description'                  => 'required|min:5',
        'price'                 => 'required|numeric|digits_between:1,20',
        'duration'                 => 'required|numeric|digits_between:1,3',
        'interval'                 => 'required|numeric|digits_between:1,3',
        'capacity'                 => 'required|numeric',
    );
    public static $rulesUpdate = array(
        'name'                 => 'required|between:5,50',
        'description'                  => 'required|min:5',
        'price'                 => 'required|numeric|digits_between:1,20',
        'duration'                 => 'required|numeric|digits_between:1,3',
        'interval'                 => 'required|numeric|digits_between:1,3',
        'capacity'                 => 'required|numeric',
    );

    public function scopeUserServices(){
        return $this->belongsTo('User');
    }
}
