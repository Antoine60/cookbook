<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Recette extends Model
{
    use Rateable;

    protected $table = 'recettes';
    protected $fillable = ['name', 'pays', 'image', 'region', 'user_id', 'keyswords', 'type_repas'];

    public function ingredients()
    {
        return $this->hasMany('App\Ingredient');
    }

    public function etapes()
    {
        return $this->hasMany('App\Etape');
    }
}
