@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear Tratamiento</div>

                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::open(['route' => 'tratamientos.store']) !!}

                        <div class="form-group">
                            {!! Form::label('descripcion', 'Descripcion del tratamiento') !!}
                            {!! Form::text('descripcion', null,['class'=> 'form-control', 'required', 'autofocus']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('fecha_inicio', 'Fecha Inicio') !!}
                            <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" class="form-control" value="{{Carbon\Carbon::now()->format('Y-m-d\Th:i')}}" />
                        </div>
                        <div class="form-group">
                            {!! Form::label('fecha_fin', 'Fecha Fin') !!}
                            <input type="datetime-local" id="fecha_fin" name="fecha_fin" class="form-control" value="{{Carbon\Carbon::now()->format('Y-m-d\Th:i')}}" />
                        </div>

                        <div class="form-group">
                            {!!Form::label('medico_id', 'Medico') !!}
                            <br>
                            {!! Form::select('medico_id', $medicos, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!!Form::label('paciente_id', 'Paciente') !!}
                            <br>
                            {!! Form::select('paciente_id', $pacientes, ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection