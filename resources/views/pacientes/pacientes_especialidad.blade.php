@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Pacientes por Especialidad</div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'pacientes.index', 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}

                        {!! Form::open(['route' => ['pacientes.pacientes_especialidad'],'method' => 'get']) !!}

                        <?php
                        use App\Especialidad;
                        $especialidades = Especialidad::all()->pluck('name','id');
                        ?>
                        <div class="form-group">
                            {!!Form::label('especialidad_id', 'Especialidad') !!}
                            <br>
                            {!! Form::select('especialidad_id',$especialidades, ['class' => 'form-control','required']) !!}
                        </div>
                        {!! Form::submit('Buscar',['class'=>'btn-primary btn']) !!}
                        {!! Form::close() !!}

                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Nuhsa</th>
                                <th>Enfermedad</th>

                            </tr>

                            @foreach ($pacientes as $paciente)


                                <tr>
                                    <td>{{ $paciente->name }}</td>
                                    <td>{{ $paciente->surname }}</td>
                                    <td>{{ $paciente->nuhsa }}</td>
                                    <td>{{ $paciente->enfermedad->name}}</td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
