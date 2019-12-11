<?php

namespace App\Http\Controllers;

use App\medicina;
use Illuminate\Http\Request;

class MedicinaController extends Controller
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
        $medicinas = medicina::all();

        return view('medicinas/index',['medicinas'=>$medicinas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medicinas/create');
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
            'name' => 'required|max:255',
            'composition' => 'required|max:255',
            'presentation' => 'required|max:255',
            'vademecum' => 'required|max:255',
        ]);

        $medicina = new medicina($request->all());
        $medicina->save();

        // return redirect('especialidades');

        flash('Medicina creada correctamente');

        return redirect()->route('medicinas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\medicina  $medicina
     * @return \Illuminate\Http\Response
     */
    public function show(medicina $medicina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\medicina  $medicina
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medicina = medicina::find($id);

        return view('medicinas/edit',['medicina'=> $medicina]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\medicina  $medicina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'composition' => 'required|max:255',
            'presentation' => 'required|max:255',
            'vademecum' => 'required|max:255'
        ]);

        $medicina = medicina::find($id);
        $medicina->fill($request->all());

        $medicina->save();

        flash('Medicina modificada correctamente');

        return redirect()->route('medicinas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\medicina  $medicina
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicina = medicina::find($id);
        $medicina->delete();
        flash('Medicina borrada correctamente');

        return redirect()->route('medicinas.index');
    }
}
