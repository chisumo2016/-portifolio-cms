<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
   protected  $fillable = [
       'title',
       'description',
       'link',
       'header_image',
       'status',
   ];

    protected  $casts = [
        'status' => 'boolean'
    ];
}
