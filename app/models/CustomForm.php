<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CustomForm extends Ardent{

    protected $table = 'custom_forms';

    protected $fillable = [];

    public static $relationsData = array(
        'subscription' => array(self::BELONGS_TO,'Subscription'),
        'customformfield' => array(self::HAS_MANY,'CustomFormField')
    );
    public static $rulesCreate = array(
        'name'                 => 'required|between:4,50',
    );
}