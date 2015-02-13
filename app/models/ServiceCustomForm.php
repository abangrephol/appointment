<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ServiceCustomForm extends Ardent{

    protected $table = 'services_custom_forms';

    protected $fillable = [];

    public static $relationsData = array(
        'customformfield' => array(self::BELONGS_TO,'CustomFormField'),
        'service' => array(self::BELONGS_TO,'Service')
    );
}