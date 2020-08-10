<?php

use Faker\Generator as Faker;

$factory->define(App\Etape::class, function (Faker $faker) {
    return [
        'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'recette_id' => $faker->numberBetween($min = 1, $max = 50),
        'position' => $faker->numberBetween($min = 1, $max = 5),
    ];
});