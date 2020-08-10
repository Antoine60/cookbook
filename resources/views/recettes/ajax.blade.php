<div class="row">
    @foreach($recettes as $recette)
        <div class="col-xs-4 card-container parent">
            <div class="card  border-cookbook rounded">
                <div class="child card-image"
                     style="background-image: url({{ $recette->image }}); max-width: 22rem;"></div>
                <div class="div-background-black"></div>
                <div class="card-header bg-transparent">
                    {{$recette->name}}
                </div>
                <div class="card-body">
                    {{--<img src="{{$recette->image}}"/>--}}
                </div>
                <div class="card-footer bg-transparent">
                    <p class="mb-0">
                        <a class="a-details text-uppercase" href="recettes/{{$recette->id}}">
                            Détail
                        </a>

                        <span class="rate">{!! number_format($recette->averageRating, 1) !!}
                            / 5
                        ({{ $recette->userSumRating }} votes)</span>
                        <br>
                        <span>
                            @if ($recette->keyswords != "")
                                @foreach(explode(',', $recette->keyswords) as $keyword)
                                    <span class="badge badge-info">{{ $keyword }}</span>
                                @endforeach
                            @endif
                        </span>
                        <span class="type_repas">
                        <i class="fa fa-cutlery"></i> {{ $recette->type_repas }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    @endforeach

</div>
