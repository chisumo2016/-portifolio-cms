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
       'slug',
   ];

    protected  $casts = [
        'status' => 'boolean'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public  function  adminPath()
    {
        return '/admin/media/' .  $this->slug;
    }


}
