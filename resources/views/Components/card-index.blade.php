@props(['Title','Value','Time','Type'])

<div class="col-sm-6 mx-auto pt-4 px-5 pb-2">
    <div class="card text-center">
        <div class="card-header">
            {{$Title}} 
            <div id="badge_type_{{$type}}">
                @if ($Value >= 100)
                    <span class='badge rounded-pill bg-danger'>Peligro</span>
                @elseif ($Value >= 80)
                    <span class='badge rounded-pill bg-warning'>Advertencia</span>
                @else
                    <span class='badge rounded-pill bg-success'>Estable</span>
                @endif
            </div>
        </div>
        <div class="card-body">
            <p class="card-text display-6" id="value_type_{{$type}}">{{$Value}}</p>
            <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-recipient="{{$Title}}" data-type="{{$Type}}">Ver Historial</a>
        </div>
        <div class="card-footer text-muted" id="time_type_{{$type}}">
            Ultima Actualizacion: {{$Time}}
        </div>
    </div>
</div>