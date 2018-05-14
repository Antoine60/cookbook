@extends('layouts.app')

@section('content')
    <h1>Mes recettes</h1>
    <div class="row">
        <div class="col-xs-4">
            <select name="country">
                <option value="country">Par Pays</option>
                @foreach($countries as $country)
                    <option value="{{$country}}">{{$country}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-4">
            <select name="repas">
                <option value="repas">Type de repas</option>
                @foreach($repas_types as $repas_type)
                    <option value="{{$repas_type}}">{{$repas_type}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-4">
            <input type="text" placeholder="search" name="search"/>
        </div>
    </div>

    @foreach($recettes as $recette)
        <div class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">{{$recette->name}}</div>
                <div class="panel-body"><img src="{{$recette->image}}"/></div>
                <div class="panel-footer">
                    <div class="right">{!! number_format($recette->averageRating, 1) !!} / 5
                        ({{ $recette->userSumRating }} votes)
                        <a class="btn btn-default" href="recettes/{{$recette->id}}">Détail</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="col-xs-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <button id="addRecetteForm" data-toggle="modal" data-toggle="modal" data-target="#myModal" class="btn">
                    Ajout
                    d'une recette
                </button>
            </div>
        </div>
    </div>
@endsection


