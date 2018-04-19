@extends('layouts.app')
@section('content')
    <h1>Les meilleurs utilisateurs</h1>

    <table class="table table-condensed">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Note Moyenne</th>
            <th>Meilleure recette</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ number_format($user->avgRating,1) }} (sur {{$user->totalSumRating}} votes)</td>
                <td><a href="recettes/{{$user->topRecette->id}}">{{$user->topRecette->name}}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection