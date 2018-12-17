<?php

use Faker\Generator as Faker;

$factory->define(App\Series::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5),
        'slug' => str_slug($faker->sentence(5)),
        'image_url' => $faker->imageUrl(),
        'description' => $faker->paragraph()
    ];
});
