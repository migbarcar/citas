<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $fillable = ['fecha_inicio', 'fecha_fin', 'descripcion','medico_id', 'paciente_id'];

    public function medico()
    {
        return $this->belongsTo('App\Medico');
    }

    public function paciente()
    {
        return $this->belongsTo('App\Paciente');
    }

    public function getFullNameAttribute()
    {
        return $this->paciente()->name.' '.$this->paciente()->surname;
    }

}