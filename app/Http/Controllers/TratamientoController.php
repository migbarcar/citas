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

        $tratamientos = Tratamiento::all();

        return view('tratamientos/index',['tratamientos'=>$tratamientos]);
    }


    public function create()
    {
        $medicos = Medico::all()->sortBy('surname')->pluck('full_name','id');
        $pacientes = Paciente::all()->sortBy('surname')->pluck('full_name','id');


        return view('tratamientos/create',['medicos'=>$medicos, 'pacientes'=>$pacientes]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
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

        $medicos = Medico::all()->sortBy('surname')->pluck('full_name','id');

        $pacientes = Paciente::all()->sortBy('surname')->pluck('full_name','id');

        return view('tratamientos/edit',['tratamiento'=> $tratamiento, 'medicos'=>$medicos, 'pacientes'=>$pacientes]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
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

    public function tratamiento_paciente(Request $request){
        $paciente_id = $request->paciente_id;

        $tratamientos=Tratamiento::join('pacientes', 'tratamientos.paciente_id','=','pacientes.id')
                           -> where ('tratamientos.paciente_id','=',$paciente_id)
                           ->select('tratamientos.fecha_inicio','tratamientos.fecha_fin','tratamientos.descripcion','tratamientos.medico_id')->get();


        return view('tratamientos/tratamiento_paciente',['tratamientos'=>$tratamientos]);
    }

}