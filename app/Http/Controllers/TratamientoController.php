<?php


namespace App\Http\Controllers;


use App\Medico;
use App\Paciente;
use App\Tratamiento;
use Illuminate\Http\Request;

class TratamientoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $hoy= date('Y-m-d H:i:s');
        $tratamientos= Tratamiento::where('fecha_fin','>', $hoy)->orderBy('fecha_fin','asc')->get();

        return view('tratamientos/index',['tratamientos'=>$tratamientos]);
    }

    public function create()
    {
        $medicos = Medico::all()->pluck('full_name','id');

        $pacientes = Paciente::all()->pluck('full_name','id');


        return view('tratamientos/create',['medicos'=>$medicos, 'pacientes'=>$pacientes]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'fecha_inicio' => 'required|date|after:now',
            'fecha_fin' => 'required|date|after:now',
            'medico_id' => 'required|exists:medicos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'descripcion' => 'required|max:255',

        ]);
        $tratamiento = new Tratamiento($request->all());
        $tratamiento->save();


        flash('Tratamiento creado correctamente');

        return redirect()->route('tratamientos.index');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {

        $tratamiento = Tratamiento::find($id);


        $medicos = Medico::all()->pluck('full_name','id');

        $pacientes = Paciente::all()->pluck('full_name','id');

        return view('tratamientos/edit',['tratamiento'=> $tratamiento, 'medicos'=>$medicos, 'pacientes'=>$pacientes]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fecha_inicio' => 'required|date|after:now',
            'fecha_fin' => 'required|date|after:now',
            'medico_id' => 'required|exists:medicos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'descripcion' => 'required|max:255',
        ]);

        $tratamiento = Tratamiento::find($id);
        $tratamiento->fill($request->all());

        $tratamiento->save();

        flash('Tratamiento modificado correctamente');

        return redirect()->route('tratamientos.index');
    }

    public function destroy($id)
    {
        $tratamiento = Tratamiento::find($id);
        $tratamiento->delete();
        flash('Tratamiento borrado correctamente');

        return redirect()->route('tratamientos.index');
    }
}