@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Prescripcion</div>

                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::model($prescripcion, [ 'route' => ['prescripciones.update',$prescripcion->id], 'method'=>'PUT']) !!}



                        <div class="form-group">
                            {!! Form::label('dosis', 'Dosis') !!}
                            {!! Form::text('dosis',$prescripcion->dosis,['class'=>'form-control', 'required', 'autofocus']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('frecuencia', 'Frecuencia') !!}
                            {!! Form::text('frecuencia',$prescripcion->frecuencia,['class'=>'form-control', 'required', 'autofocus']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('instrucciones', 'Instrucciones') !!}
                            {!! Form::text('instrucciones',$prescripcion->instrucciones,['class'=>'form-control', 'required', 'autofocus']) !!}
                        </div>

                        <div class="form-group">
                            {!!Form::label('tratamiento_id', 'Tratamiento') !!}
                            <br>
                            {!! Form::select('tratamiento_id', $tratamientos, $prescripcion->tratamiento_id, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!!Form::label('medicina_id', 'Medicinas') !!}
                            <br>
                            {!! Form::select('medicina_id', $medicinas, $prescripcion->medicina_id, ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection