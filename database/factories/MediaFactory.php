<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Media;
use Faker\Generator as Faker;

$factory->define(Media::class, function (Faker $faker) {
    return [
        'title'        => $faker->sentence,
        'description'    => $faker->sentence,
        'link'           => $faker->url,
        'header_image'   => $faker->imageUrl(),
        'status'          => 1,
    ];
});
