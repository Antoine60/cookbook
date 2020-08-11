<?php

namespace App\Http\Controllers;

use App\Etape;
use App\Ingredient;
use App\Recette;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use willvincent\Rateable\Rating;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class RecetteController extends Controller
{

    public function paginate($items, $perPage = 6, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function ajax(Request $request)
    {
        $q = $request->query('q');
        $page = $request->query('page');
        $search = $request->query('s');
        $repas = $request->query('r');
        $pays = $request->query('c');
        $recettes = [];

        switch ($q) {
            case 'currentUser':
                $modelRecette = Recette::where('user_id', '=', Auth::user()->id);
                break;
            case 'top':
                $recettes = Recette::all()->sortByDesc(function ($item) {
                    return $item->averageRating;
                });
                break;
            case 'last':
                $modelRecette = Recette::orderBy('created_at', 'desc');
                break;
        }
        if (isset($modelRecette)) {
            if (isset($search)) {
                $modelRecette = $modelRecette->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('keyswords', 'like', '%' . $search . '%');
                });
            }
            if (!empty($repas)) {
                $modelRecette = $modelRecette->where('type_repas', $repas);
            }
            if (!empty($pays)) {
                $modelRecette = $modelRecette->where('pays', $pays);
            }
            if (!$modelRecette instanceof Collection) {
                $recettes = $modelRecette->get();
            }
        }

        $recettes = $this->paginate($recettes);
        if ($recettes->count()) {
            return view('recettes.ajax', ['recettes' => $recettes, 'page' => $page]);
        } else {
            abort(404, 'No more results found');
        }
    }

    public
    function all()
    {
        $recettes = Recette::all();
        $countries = $repas_type = [];
        foreach ($recettes as $recette) {
            if (!in_array($recette->pays, $countries) && !empty($recette->pays)) {
                $countries[] = $recette->pays;
            }
            if (!in_array($recette->type_repas, $repas_type) && !empty($recette->type_repas)) {
                $repas_type[] = $recette->type_repas;
            }
        }
        sort($countries);
        return view('home', ['countries' => $countries, 'repas_types' => $repas_type]);
    }

    public
    function update_note(Request $request, $id)
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

    public
    function top()
    {
        return view('recettes/top');
    }

    public
    function index()
    {
        $user = User::find(Auth::user()->id);
        $recettes = $user->recettes;
        $countries = $repas_type = [];
        foreach ($recettes as $recette) {
            if (!in_array($recette->pays, $countries) && !empty($recette->pays)) {
                $countries[] = $recette->pays;
            }
            if (!in_array($recette->type_repas, $repas_type) && !empty($recette->type_repas)) {
                $repas_type[] = $recette->type_repas;
            }
        }
        return view('recettes.index', ['countries' => $countries, 'repas_types' => $repas_type]);

    }


    public
    function show($id)
    {
        $recette = Recette::findOrFail($id);
        $canVote = 0;
        if (null !== \Auth::id() && $recette->user->id != \Auth::id())
            $canVote = 1;
        return view('recettes.show', ['recette' => $recette, 'canVote' => $canVote]);

    }

    public
    function create()
    {
        return view('recettes/create');
    }

    public
    function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'photo' => 'required',
            'pays' => 'required',
            'region' => 'required',
            'keyswords' => 'required',
        ]);

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
