@extends('layouts.app')

@section('content')
    <h1>Les dernières recettes</h1>
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
@endsection