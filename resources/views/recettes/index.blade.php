@extends('layouts.app')

@section('content')
    <h1>Mes recettes</h1>
    <div class="row">
        <div class="col-xs-4">
            <select id="country" name="country">
                <option value="">Par Pays</option>
                @foreach($countries as $country)
                    <option value="{{$country}}">{{$country}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-4">
            <select id="repas" name="repas">
                <option value="">Type de repas</option>
                @foreach($repas_types as $repas_type)
                    <option value="{{$repas_type}}">{{$repas_type}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-4">
            <input type="text" id="search" placeholder="search" name="search"/>
        </div>
    </div>

    <div class="content-ajax">
    </div>
    <div class="row">
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
    </div>



    <div class="loader-spinner"></div>



@endsection


