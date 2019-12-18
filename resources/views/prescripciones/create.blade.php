@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear prescripcion</div>

                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::open( [ 'route' => ['prescripciones.store']]) !!}



                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Paciente</th>
                                <th>Descripcion</th>

                            </tr>


                        </table>

                        <div class="form-group">
                            {!! Form::label('fecha_inicio', 'Fecha Inicio') !!}
                            <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" class="form-control" value="{{Carbon\Carbon::now()->format('Y-m-d\Th:i')}}" />
                        </div>
                        <div class="form-group">
                            {!! Form::label('fecha_fin', 'Fecha Fin') !!}
                            <input type="datetime-local" id="fecha_fin" name="fecha_fin" class="form-control" value="{{Carbon\Carbon::now()->format('Y-m-d\Th:i')}}" />
                        </div>
                        <div class="form-group">
                            {!!Form::label('medicina_id', 'Medicamento') !!}
                            <br>
                            {!! Form::select('medicina_id', $medicinas, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('dosis', 'Dosis') !!}
                            {!! Form::text('dosis', null,['class'=> 'form-control', 'required', 'autofocus']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('frecuencia', 'Frecuencia') !!}
                            {!! Form::text('frecuencia', null,['class'=> 'form-control', 'required', 'autofocus']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('instrucciones', 'Instrucciones') !!}
                            {!! Form::text('instrucciones', null,['class'=> 'form-control', 'required', 'autofocus']) !!}
                        </div>


                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection