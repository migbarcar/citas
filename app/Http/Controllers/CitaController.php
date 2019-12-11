<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enfermedad;
use App\Cita;
use App\Medico;
use App\Paciente;



class CitaController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $hoy= date('Y-m-d H:i:s');
        $citas= Cita::where('fecha_hora','>', $hoy)->orderBy('fecha_hora','asc')->get();

        return view('citas/index',['citas'=>$citas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medicos = Medico::all()->pluck('full_name','id');

        $pacientes = Paciente::all()->pluck('full_name','id');


        return view('citas/create',['medicos'=>$medicos, 'pacientes'=>$pacientes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'medico_id' => 'required|exists:medicos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha_hora' => 'required|date|after:now',
            'localizacion' => 'required|max:255',

        ]);

        $cita = new Cita($request->all());

        $id_de_la_especialidad_del_medico=$cita->medico->especialidad_id;
        $id_de_la_enfermedad = $cita->paciente->enfermedad_id;
        $id_de_la_especialidad_enfermedad=Enfermedad::where('id','=',$id_de_la_enfermedad)->value('especialidad_id');

        if($id_de_la_especialidad_del_medico == $id_de_la_especialidad_enfermedad){
            $cita->save();
            flash('Cita creada correctamente');
        }else{
            flash('La cita no se puede celebrar. Intente con otro medico.');
        }

        return redirect()->route('citas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $cita = Cita::find($id);


        $medicos = Medico::all()->pluck('full_name','id');

        $pacientes = Paciente::all()->pluck('full_name','id');

        return view('citas/edit',['cita'=> $cita, 'medicos'=>$medicos, 'pacientes'=>$pacientes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'medico_id' => 'required|exists:medicos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha_hora' => 'required|date|after:now',
            'localizacion' => 'required|max:255',

        ]);
        $cita = Cita::find($id);
        $cita->fill($request->all());

        $id_de_la_especialidad_del_medico=$cita->medico->especialidad_id;
        $id_de_la_enfermedad = $cita->paciente->enfermedad_id;
        $id_de_la_especialidad_enfermedad=Enfermedad::where('id','=',$id_de_la_enfermedad)->value('especialidad_id');

        if($id_de_la_especialidad_del_medico == $id_de_la_especialidad_enfermedad){
            $cita->save();
            flash('Cita modificada correctamente');
        }else{
            flash('La cita no se puede celebrar. Intente con otro medico.');

        }

        return redirect()->route('citas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cita = Cita::find($id);
        $cita->delete();
        flash('Cita borrada correctamente');

        return redirect()->route('citas.index');
    }

    public function muestra_historial_citas()
    {

        $hoy= date('Y-m-d H:i:s');
        $citas= Cita::where('fecha_hora','<', $hoy)->orderBy('fecha_hora','asc')->get();

        return view('citas/muestra_historial_citas',['citas'=>$citas]);
    }

}
