<?php

namespace App\Http\Controllers;

use App\Etape;
use App\Ingredient;
use App\Recette;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecetteController extends Controller
{
    public function create()
    {
        return view('recettes/create');
    }

    public function store(Request $request)
    {
        //register recette
        $recette = new Recette();
        $fields = $request->only($recette->getFillable());
        $recette->name = $request->name;
        $recette->user_id = Auth::user()->id;
        $recette->fill($fields);
        $recette->save();

        //register ingredients
        foreach ($request->ingredients as $ingredient_brut) {
            $ingredient = new Ingredient();
            $fields = $request->only($ingredient->getFillable());
            $array_ingredient = explode('-', $ingredient_brut);
            $ingredient->nom = $array_ingredient[0];
            $ingredient->quantite = $array_ingredient[1];
            $ingredient->mesure = $array_ingredient[2];
            $ingredient->recette_id = $recette->id;
            $ingredient->fill($fields);
            $ingredient->save();
        }

        //register etapes
        foreach ($request->etapes as $etape_description) {
            $etape = new Etape();
            $etape->recette_id = $recette->id;
            $etape->description = $etape_description;
            $etape->save();
        }

    }

}
