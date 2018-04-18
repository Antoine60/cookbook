@extends('layouts.app')

@section('content')
    <h1>Mes recettes</h1>
    @foreach($recettes as $recette)
        <div class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">{{$recette->name}}</div>
                <div class="panel-body"><img src="{{$recette->image}}"/></div>
                <div class="panel-footer"><a href="recettes/{{$recette->id}}">Détail</a>{{$recette->rating}}</div>
            </div>
        </div>
    @endforeach
@endsection