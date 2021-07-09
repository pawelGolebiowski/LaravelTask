<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiPosts extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'title',
        'body'
    ];
}