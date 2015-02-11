<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ApiKey extends Ardent{

    use SoftDeletingTrait;

    protected $table = 'api_keys';

    protected $dates = ['deleted_at'];

    protected $fillable = [];

    public static $relationsData = array(
        'user'  => array(self::BELONGS_TO, 'User'),
        'subscription' => array(self::BELONGS_TO,'Subscription')
    );
    public function scopeCheck($scope,$apikey){
        return $scope->where('api_key','=',$apikey)->get();
    }
}