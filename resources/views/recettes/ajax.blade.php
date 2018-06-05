<div class="row">
    @foreach($recettes as $recette)
        <div class="col-xs-4 card-container">
            <div class="card card-image border-cookbook rounded"
                 style="background-image: url({{ $recette->image }}); max-width: 22rem;">
                <div class="card-header bg-transparent">
                    {{$recette->name}}
                </div>
                <div class="card-body">
                    {{--<img src="{{$recette->image}}"/>--}}
                </div>
                <div class="card-footer bg-transparent">
                    <p class="mb-0">
                        <a href="recettes/{{$recette->id}}">Détail</a>

                        <span class="rate">{!! number_format($recette->averageRating, 1) !!}
                            / 5
                        ({{ $recette->userSumRating }} votes)</span>
                        <br>
                        <span class="type_repas">
                        <i class="fa fa-cutlery"></i> {{ $recette->type_repas }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    @endforeach

</div>
