<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiUsers extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'name',
        'username',
        'email',
        'street',
        'city',
        'zipcode',
        'phone',
        'website',
        'companyname'
    ];
}