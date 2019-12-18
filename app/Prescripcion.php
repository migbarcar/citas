<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Prescripcion extends Model
{
    protected $fillable = ['fecha_inicio','fecha_fin','medicina_id','dosis', 'frecuencia', 'instrucciones'];


    public function medicina()
    {
        return $this->belongsTo('App\Medicina');
    }

}