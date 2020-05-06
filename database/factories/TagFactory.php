<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tag;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Tag::class, function (Faker $faker) {
    $title = $faker->word;
    return [
        'title'     => $title,
        'slug'      =>  Str::slug($title),
        'status'    => 1
    ];
});
