@extends('layouts.app')

@section('content')
    <h1>Les dernières recettes</h1>
    <div class="row form-inline md-form form-sm">
        <div class="col-xs-4">
            <select class="mdb-select" id="country" name="country">
                <option value="" selected>Par Pays</option>
                @foreach($countries as $country)
                    <option value="{{$country}}">{{$country}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-4">
            <select class="mdb-select" id="repas" name="repas">
                <option value="" selected>Type de repas</option>
                @foreach($repas_types as $repas_type)
                    <option value="{{$repas_type}}">{{$repas_type}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-4">
            <form class=" active-orange active-orange-2">
                <i class="fa fa-search" aria-hidden="true"></i>
                <input class="form-control form-control-sm ml-3" type="text" id="search" placeholder="Recherche..."
                       name="search" aria-label="Search"/>
            </form>
        </div>
    </div>
    <div class="content-ajax">
    </div>
@endsection