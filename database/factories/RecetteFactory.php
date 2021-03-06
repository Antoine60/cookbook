<?php

use Faker\Generator as Faker;

$factory->define(App\Recette::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'pays' => $faker->country,
        'region' => $faker->countryCode,
        'user_id' => rand(1,10),
        'keyswords' => $faker->word,
        'image' => $faker->imageUrl($width = 200, $height = 200, 'food'),
        'type_repas' => $faker->randomElement($array = array('Matin', 'Midi', 'En-Cas', 'Soir')),
    ];
});