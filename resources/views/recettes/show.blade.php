@extends('layouts.app')

@section('content')
    <h1>Recette : {{ $recette->name }} </h1> par {{ $recette->user->name }}
    <div>
        Note : {!! number_format($recette->averageRating, 1) !!}
    </div>
    <div class="col-xs-4">
        <h2>Ingrédients</h2>
        <ul>
            @foreach($recette->ingredients as $ingredient)
                <li>{{ $ingredient->quantite }} {{ $ingredient->mesure }} - {{ $ingredient->nom }}
            @endforeach
        </ul>
    </div>
    <div class="col-xs-4">
        <h2>Etapes</h2>
        <ol>
            @foreach($recette->etapes->sortBy('position') as $etape)
                <li>{{ $etape->description }}</li>
            @endforeach
        </ol>

    </div>
    <div class="row">
        <h2>Photo</h2>
        <div class="col-xs-12">
            <img src="{{$recette->image}}"/>
        </div>
    </div>
@endsection