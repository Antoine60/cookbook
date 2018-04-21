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
use willvincent\Rateable\Rating;

class RecetteController extends Controller
{
    public function all()
    {
        $recettes = Recette::all();
        return view('home', ['recettes' => $recettes]);
    }

    public function update_note(Request $request, $id)
    {

        $recette = Recette::find($id);
        $newRating = $request->input('note');

        $rating = Rating::where([
            ['user_id', Auth::id()],
            ['rateable_id', $recette->id]
        ])->first();

        $rating->rating = $newRating;

        $recette->ratings()->save($rating);

        return redirect(route('recettes.show', ['recette' => $id]));
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
        $recette = Recette::findOrFail($id);
        $canVote = 0;
        if ($recette->user->id != \Auth::id())
            $canVote = 1;
        return view('recettes.show', ['recette' => $recette, 'canVote' => $canVote]);

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
        $position = 0;
        //register etapes
        foreach ($request->etapes as $etape_description) {
            $etape = new Etape();
            $etape->recette_id = $recette->id;
            $etape->position = ++$position;
            $etape->description = $etape_description;
            $etape->save();
        }

        return redirect(route('recettes.index'));
    }

}
