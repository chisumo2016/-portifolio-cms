<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected  $fillable = [
        'message',
        'email'
    ];
}
