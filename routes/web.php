<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Poner las acciones definidas por el programador antes del CRUD por defecto que monta Laravel
Route::post('tratamientos/tratamiento_paciente','TratamientoController@tratamiento_paciente')->name('tratamientos.tratamiento_paciente');
Route::post('pacientes/pacientes_especialidad','PacienteController@pacientes_especialidad')->name('pacientes.pacientes_especialidad');
Route::get('citas/muestra_historial_citas','CitaController@muestra_historial_citas')->name('citas.muestra_historial_citas');
Route::delete('especialidades/destroyAll', 'EspecialidadController@destroyAll')->name('especialidades.destroyAll');
Route::resource('especialidades', 'EspecialidadController');

Route::resource('medicos', 'MedicoController');
Route::resource('pacientes', 'PacienteController');

Route::resource('prescripciones', 'PrescripcionController');

Route::resource('citas', 'CitaController');

Route::resource('enfermedades', 'EnfermedadController');

Route::resource('tratamientos', 'TratamientoController');

Route::resource('medicinas', 'MedicinaController');


Auth::routes();

Route::get('/home', 'HomeController@index');