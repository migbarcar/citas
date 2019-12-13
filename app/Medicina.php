<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class medicina extends Model
{
    protected $fillable = ['name', 'composition', 'presentation', 'vademecum'];

    public function tratamientos()
    {
        return $this->hasMany('App\Tratamiento');
    }

    public function getFullNameAttribute()
    {
        return $this->name ;
    }

}
