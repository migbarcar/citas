<?php

namespace App\Http\Controllers;

use App\Cita;
use App\Enfermedad;
use App\Especialidad;
use App\Medico;
use Illuminate\Http\Request;
use App\Paciente;
use phpDocumentor\Reflection\Types\Integer;

class PacienteController extends Controller
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
        //

        $pacientes = Paciente::all()->sortBy('surname');
        $especialidades = Especialidad::all()->pluck('name','id');

        return view('pacientes/index', ['pacientes' => $pacientes, 'especialidades'=>$especialidades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $enfermedades = Enfermedad::all()->pluck('name', 'id');

        return view('pacientes/create', ['enfermedades' => $enfermedades]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'nuhsa' => 'required|nuhsa|max:255',
            'enfermedad_id' => 'required|exists:enfermedads,id'
        ]);

        //TODO: crear validación propia para nuhsa
        $paciente = new Paciente($request->all());
        $paciente->save();

        // return redirect('especialidades');

        flash('Paciente creado correctamente');

        return redirect()->route('pacientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // TODO: Mostrar las citas de un paciente
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente = Paciente::find($id);

        $enfermedades = Enfermedad::all()->pluck('name', 'id');

        return view('pacientes/edit', ['paciente' => $paciente, 'enfermedades' => $enfermedades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'nuhsa' => 'required|nuhsa|max:255',
            'enfermedad_id' => 'required|exists:enfermedads,id',
        ]);

        $paciente = Paciente::find($id);
        $paciente->fill($request->all());

        $paciente->save();

        flash('Paciente modificado correctamente');

        return redirect()->route('pacientes.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {
        $paciente = Paciente::find($id);
        $paciente->delete();
        flash('Paciente borrado correctamente');

        return redirect()->route('pacientes.index');
    }

        public function pacientes_especialidad(Request $request){
        $especialidad_id = $request->especialidad_id;
        $enfermedad = Enfermedad::where('especialidad_id','=', $especialidad_id)->value('id');
        $pacientes = Paciente::where('enfermedad_id','=', $enfermedad)->select('name','surname','nuhsa','enfermedad_id')->get();


        return view('pacientes/pacientes_especialidad',['pacientes'=>$pacientes]);

    }

}
