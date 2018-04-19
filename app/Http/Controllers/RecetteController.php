<?php

namespace App\Http\Controllers;

use App\Etape;
use App\Ingredient;
use App\Recette;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class RecetteController extends Controller
{
    public function all()
    {
        $recettes = Recette::all();
        return view('home', ['recettes' => $recettes]);
    }

    public function top()
    {
        $recettes = Recette::all();

        $custom = $recettes->sortByDesc(function ($item) {
            return $item->userAverageRating;
        })->values();
        return view('recettes/top', ['recettes' => $custom]);
    }

    public function index()
    {
        $user = User::find(Auth::user()->id);
        $recettes = $user->recettes;
        return view('recettes/index', ['recettes' => $recettes]);
    }

    public function show($id)
    {
        return view('recettes.show', ['recette' => Recette::findOrFail($id)]);

    }

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
        $imageManager = new ImageManager();
        $image = $imageManager->make($request->file('photo'))->resize(200, 200);
        $image->save('images/' . $image->filename . '.jpg');
        $recette->image = '/images/' . $image->filename . '.jpg';
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
