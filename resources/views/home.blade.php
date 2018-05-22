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

    {{--@foreach($recettes->sortByDesc('created_at') as $recette)--}}
    {{--<div class="col-xs-4">--}}
    {{--<div class="panel panel-default">--}}
    {{--<div class="panel-heading">{{$recette->name}}</div>--}}
    {{--<div class="panel-body"><img src="{{$recette->image}}"/></div>--}}
    {{--<div class="panel-footer"><a href="recettes/{{$recette->id}}">Détail</a>--}}
    {{--<div class="right">{!! number_format($recette->averageRating, 1) !!} / 5--}}
    {{--({{ $recette->userSumRating }} votes)--}}
    {{--</div>--}}
    {{--<div>By {{ $recette->user->name }}</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endforeach--}}
@endsection