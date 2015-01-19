<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Payment extends Ardent {

    use SoftDeletingTrait;

    protected $table = 'payments';

    protected $dates = ['deleted_at'];

    protected $fillable = [];


}