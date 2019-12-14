@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Historial de Citas</div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'citas.index', 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}


                        <br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Fecha</th>
                                <th>Hora fin</th>
                                <th>Lugar</th>
                                <th>Medico</th>
                                <th>Paciente</th>

                            </tr>

                            @foreach ($citas as $cita)


                                <tr>
                                    <td>{{ (new DateTime($cita->fecha_hora))->format('d-m-Y H:i:s') }}</td>
                                    <td>{{ (new Datetime($cita->fecha_hora))->add (new DateInterval('PT15M'))->format ('d-m-Y H:i:s') }}</td>
                                    <td>{{ $cita->localizacion }}</td>
                                    <td>{{ $cita->medico->full_name }}</td>
                                    <td>{{ $cita->paciente->full_name}}</td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection