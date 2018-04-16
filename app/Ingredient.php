<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public function recette()
    {
        return $this->hasOne('App\Recette');
    }
}
