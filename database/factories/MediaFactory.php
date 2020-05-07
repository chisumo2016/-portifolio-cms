<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Media;
use Faker\Generator as Faker;

$factory->define(Media::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'title'           => $title,
        'description'     => $faker->sentence,
        'link'           => $faker->url,
        'header_image'   => $faker->imageUrl(),
        'status'          => 1,
        'slug'              =>\Illuminate\Support\Str::slug($title),
    ];
});
