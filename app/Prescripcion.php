<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Prescripcion extends Model
{
    protected $fillable = ['dosis', 'frecuencia', 'instrucciones','tratamiento_id','medicina_id'];

    public function tratamiento()
    {
        return $this->belongsTo('App\Tratamiento');
    }

    public function medicina()
    {
        return $this->belongsTo('App\Medicina');
    }

}