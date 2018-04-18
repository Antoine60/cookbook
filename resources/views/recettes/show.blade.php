@extends('layouts.app')

@section('content')
    <h1>Recette</h1>
    <div class="col-xs-4">
        @foreach($recette->ingredients as $ingredient)
            {{ $ingredient }}
        @endforeach
    </div>
    <div class="col-xs-4">
        @foreach($recette->etapes as $etape)
            {{ $etape }}
        @endforeach
    </div>
    <div class="row">
        <div class="col-xs-12">
            <img src="{{$recette->image}}"/>
        </div>
    </div>
@endsection