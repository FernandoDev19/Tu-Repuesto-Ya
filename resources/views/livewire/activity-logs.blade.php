<div>
    @if($activities)
        @foreach ($activities as $activity)
            <div class="activity-logs-container">
                <div class="item">
                    El usuario <strong>{{$activity->usuario}}</strong> {{$activity->actividad}} <br> @if($activity->descripcion)<strong>Descripción: </strong>{{$activity->descripcion}}.@endif <br> <strong>Fecha: </strong>({{$activity->fecha}}) <br> @if($activity->direccion_ip) <strong>direccion IP: </strong>{{$activity->direccion_ip}}@endif <br> @if($activity->navegador) <strong>Navegador: </strong>{{$activity->navegador}}@endif
                </div>
                <div class="created_at">
                    <strong>{{$activity->created_at->diffForHumans()}}</strong>
                </div>
            </div>
        @endforeach
    @endif
</div>
