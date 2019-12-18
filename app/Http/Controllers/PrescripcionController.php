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

        $prescripciones= Prescripcion::all();


        return view('prescripciones/index',['prescripciones'=>$prescripciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        $tratamientos=Tratamiento::all()->sortBy('paciente_id')->pluck('paciente_id','id');
        $medicinas = Medicina::all()->sortBy('name')->pluck('name','id');


        return view('prescripciones/create',['medicinas'=>$medicinas,'tratamientos'=>$tratamientos]);
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
            'fecha_inicio' => 'required|date|after:now',
            'fecha_fin' => 'required|date|after:now',
            'medicina_id' => 'required|exists:medicinas,id',
            'dosis' => 'required|max:255',
            'frecuencia' => 'required|max:255',
            'instrucciones' => 'required|max:255',

        ]);

        $prescripcion = new Prescripcion($request->all());
        $prescripcion->save();
        flash('Prescripcion creada correctamente');

        return redirect()->route('tratamientos.index');
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
        $tratamientos=Tratamiento::all()->sortBy('paciente_id')->pluck('paciente_id','id');

        $medicinas = Medicina::all()->sortBy('name')->pluck('name','id');

        return view('prescripciones/edit',['prescripcion'=> $prescripcion, 'medicinas'=>$medicinas, 'tratamientos'=>$tratamientos]);
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
            'fecha_inicio' => 'required|date|after:now',
            'fecha_fin' => 'required|date|after:now',
            'medicina_id' => 'required|exists:medicinas,id',

            'dosis' => 'required|max:255',
            'frecuencia' => 'required|max:255',
            'instrucciones' => 'required|max:255',

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