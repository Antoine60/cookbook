@extends('layouts.app')

@section('content')
    <h1>Recette : {{ $recette->name }}</h1>
    <div class="col-xs-4">
        <ul>
            @foreach($recette->ingredients as $ingredient)
                <li>{{ $ingredient->quantite }} {{ $ingredient->mesure }} - {{ $ingredient->nom }}
            @endforeach
        </ul>
    </div>
    <div class="col-xs-4">
        <ol>
            @foreach($recette->etapes->sortBy('position') as $etape)
                <li>{{ $etape->description }}</li>
            @endforeach
        </ol>

    </div>
    <div class="row">
        <div class="col-xs-12">
            <img src="{{$recette->image}}"/>
        </div>
    </div>
@endsection