<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $title  = $faker->sentence;
    return [
        'title'         => $title,
        'content'       => $faker->paragraph,
        'description'   => $faker->sentence,
        'slug'          => Str::slug($title),
        'header_img'    => $faker->imageUrl(),
        'status'        => 1,
        'published_on'  => now(),
//        'publish_at'    => now(),
        'author_id'     =>  function() {
              return  factory(User::class)->create();
        }
    ];
});
