<?php


namespace App\Http\Controllers;


use App\Cita;
use App\Enfermedad;
use App\Medico;
use App\Paciente;
use App\Prescripcion;
use App\Tratamiento;
use App\Medicina;
use Illuminate\Http\Request;

class PrescripcionController extends Controller
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


        $prescripciones=Prescripcion::all()->sortBy('tratamiento_id');;

        return view('prescripciones/index',['prescripciones'=>$prescripciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tratamientos = Tratamiento::all()->pluck('paciente_id','id');
        $pacientes = Paciente::all()->sortBy('surname')->pluck('surname','id');
        $medicinas = Medicina::all()->sortBy('name')->pluck('name','id');


        return view('prescripciones/create',['tratamientos'=>$tratamientos, 'medicinas'=>$medicinas,'pacientes'=>$pacientes]);
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
            'dosis' => 'required|max:255',
            'frecuencia' => 'required|max:255',
            'instrucciones' => 'required|max:255',
            'tratamiento_id' => 'required|exists:tratamientos,id',
            'medicina_id' => 'required|exists:medicinas,id',

        ]);

        $prescripcion = new Prescripcion($request->all());
        $prescripcion->save();
        flash('Prescripcion creada correctamente');

        return redirect()->route('prescripciones.index');
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

        $prescripcion = Prescripcion::find($id);

        $tratamientos = Tratamiento::all()->pluck('paciente_id','id');

        $medicinas = Medicina::all()->sortBy('name')->pluck('name','id');

        return view('prescripciones/edit',['prescripcion'=> $prescripcion, 'tratamientos'=>$tratamientos, 'medicinas'=>$medicinas]);
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
            'dosis' => 'required|max:255',
            'frecuencia' => 'required|max:255',
            'instrucciones' => 'required|max:255',
            'tratamiento_id' => 'required|exists:tratamientos,id',
            'medicina_id' => 'required|exists:medicinas,id',

        ]);
        $prescripcion = Prescripcion::find($id);
        $prescripcion->fill($request->all());

        $prescripcion->save();
        flash('Prescripcion modificada correctamente');


        return redirect()->route('prescripciones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prescripcion = Prescripcion::find($id);
        $prescripcion->delete();
        flash('Prescripcion borrada correctamente');

        return redirect()->route('prescripciones.index');
    }


}