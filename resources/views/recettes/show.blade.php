@extends('layouts.app')

@section('content')
    <div class="row center-block text-center">
        <h1>{{ $recette->name }}</h1>
    </div>
    <div class="row">
        <div class="col-xs-4">
            @if ($canVote)
                <div class="row">
                    Votre note
                    :
                    <form method="POST" action="{{route('recettes.update_note', ['id' => $recette->id])}}">
                        @csrf
                        <select name="note" onchange="this.form.submit();">
                            @for($i=1;$i<6;$i++)
                                <option value={{$i}} @if ($recette->userSumRating  == $i) selected @endif >
                                    {{$i}}
                                </option>
                            @endfor
                        </select>
                    </form>
                </div>
            @endif
            <div class="row">
                Note globale : {!! number_format($recette->averageRating, 1) !!} : ( {{ $recette->sumRating }} votes)
            </div>
            <div class="row">
                <div class="star-ratings-sprite"><span
                            style="width:{!! number_format($recette->averageRating*20) !!}%"
                            class="star-ratings-sprite-rating"></span></div>
            </div>
        </div>

        <div class="col-xs-offset-4 col-xs-4">
            <div class="row">
                Auteur : {{ $recette->user->name }}
            </div>
            <div class="row">
                Ajouté le {{ $recette->created_at }}
            </div>
        </div>
    </div>
    <div class="row">
        Mots clés :
        <span class="label label-default">
        {{ $recette->keyswords  }}
        </span>
    </div>
    <div class="row">
        <div class="col-xs-4">
            Pays : <span class="label label-default">{{ $recette->pays }}</span>
        </div>
        <div class="col-xs-4">
            Région : <span class="label label-default">{{ $recette->region }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <h2>Ingrédients</h2>
            <ul>
                @foreach($recette->ingredients as $ingredient)
                    <li>{{ $ingredient->quantite }} {{ $ingredient->mesure }} - {{ $ingredient->nom }}
                @endforeach
            </ul>
        </div>
        <div class="col-xs-6">
            <h2>Photo</h2>
            <div class="col-xs-12">
                <img src="{{$recette->image}}"/>
            </div>
        </div>
    </div>
    <div class="row">
        <h2>Etapes</h2>
        <ol>
            @foreach($recette->etapes->sortBy('position') as $etape)
                <li>{{ $etape->description }}</li>
            @endforeach
        </ol>
    </div>
@endsection