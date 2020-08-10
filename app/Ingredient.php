<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $table = 'ingredients';
    protected $fillable = ['nom', 'quantite', 'mesure', 'recette_id'];

    public function recette()
    {
        return $this->hasOne('App\Recette');
    }
}
