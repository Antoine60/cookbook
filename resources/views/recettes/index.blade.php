@extends('layouts.app')

@section('content')
    <h1>Mes recettes</h1>
    <div class="row">
        <div class="col-xs-4">
            <select class="mdb-select" id="country" name="country">
                <option value="">Par Pays</option>
                @foreach($countries as $country)
                    <option value="{{$country}}">{{$country}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-4">
            <select class="mdb-select" id="repas" name="repas">
                <option value="">Type de repas</option>
                @foreach($repas_types as $repas_type)
                    <option value="{{$repas_type}}">{{$repas_type}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-xs-4">
            <form class="form-inline md-form form-sm active-pink active-pink-2">
                <i class="fa fa-search" aria-hidden="true"></i>
                <input class="form-control form-control-sm ml-3" type="text" id="search" placeholder="Recherche..."
                       name="search" aria-label="Search"/>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4">
            <button id="addRecetteForm" data-toggle="modal" data-toggle="modal" data-target="#myModal" class="btn">
                Ajout d'une recette
            </button>
        </div>
    </div>
    <div class="content-ajax">
    </div>


    <div class="loader-spinner"></div>



@endsection
