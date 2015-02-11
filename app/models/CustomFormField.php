<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CustomFormField extends Ardent{

    protected $table = 'custom_form_fields';

    protected $fillable = [];

    public static $relationsData = array(
        'customform' => array(self::BELONGS_TO,'CustomForm')
    );
}