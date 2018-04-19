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

class UserController extends Controller
{

    public function show($id)
    {
        return view('users.show', ['user' => User::findOrFail($id)]);

    }

    public function top()
    {
        $users = User::all();
        foreach ($users as $user) {

            $recettes = $user->recettes;
            $totalSumRating = 0;
            $moyRating = 0;
            $topRecetteRating = 0;
            foreach ($recettes as $recette) {
                $totalSumRating += $recette->sumRating;
                $moyRating += $recette->sumRating * $recette->averageRating;
                if ($recette->averageRating > $topRecetteRating) {
                    $topRecetteRating = $recette->averageRating;
                    $user->topRecette = $recette;
                }
            }
            $user->totalSumRating = $totalSumRating;
            if ($totalSumRating > 0 ){
                $user->avgRating = $moyRating / $totalSumRating;
            }
            $users_displays[] = $user;

        }
        usort($users_displays, function($a, $b)
        {
            return strcmp($b->avgRating, $a->avgRating);
        });

        return view('users/top', ['users' => $users_displays]);


    }
}