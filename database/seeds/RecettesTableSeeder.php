<?php

use Illuminate\Database\Seeder;

class RecettesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Recette::class, 50)->create()->each(function ($u) {
            for ($i = 0; $i < rand(3, 8); $i++)
                $u->ingredients()->save(factory(App\Ingredient::class)->make());

            for ($i = 0; $i < rand(3, 8); $i++)
                $u->etapes()->save(factory(App\Etape::class)->make());

            for ($i = 0, $j = 1; $i < rand(3, 20); $i++, $j++) {
                $rating = new willvincent\Rateable\Rating;
                $rating->rating = rand(1, 5);
                $rating->user_id = $j;
                $u->ratings()->save($rating);
            }
        });
    }
}
