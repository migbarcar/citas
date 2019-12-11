@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear medicina</div>

                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::open(['route' => 'medicinas.store']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Nombre del medicamento') !!}
                            {!! Form::text('name',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('composition', 'Composición del medicamento') !!}
                            {!! Form::text('composition',null,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('presentation', 'Presentación del medicamento') !!}
                            {!! Form::text('presentation',null,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('vademecum', 'Enlace a Vademecum del medicamento') !!}
                            {!! Form::text('vademecum',null,['class'=>'form-control', 'required']) !!}
                        </div>
                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection