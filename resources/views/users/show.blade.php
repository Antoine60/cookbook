@extends('layouts.app')

@section('content')
    <h1>Les recettes d'{{ $user->name }} </h1>
    @foreach($user->recettes->sortByDesc('created_at') as $recette)
        <div class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">{{$recette->name}}</div>
                <div class="panel-body"><img src="{{$recette->image}}"/></div>
                <div class="panel-footer"><a href="recettes/{{$recette->id}}">Détail</a>
                    <div class="right">{!! number_format($recette->averageRating, 1) !!} / 5
                        ({{ $recette->userSumRating }} votes)
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection