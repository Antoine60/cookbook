<?php

use Faker\Generator as Faker;

$factory->define(App\Ingredient::class, function (Faker $faker) {
    return [
        'nom' => $faker->name,
        'quantite' => $faker->numberBetween($min = 1, $max = 10),
        'mesure' => $faker->randomElement($array = array ('g','L','kg')),
        'recette_id' => $faker->numberBetween(1,50),
    ];
});