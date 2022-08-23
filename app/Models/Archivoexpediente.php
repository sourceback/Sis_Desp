<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
    /**
     * Anotar los controladores y metodos que los usan ademas de los predeterminados
     *
     * Seguro
     * Expedientes
     * 
     */
class Archivoexpediente extends Model
{
    public function archivoexpediente()
    {
        return $this->belongsTo('App\Models\Archivoexpediente');
    }

    public function crude()
    {
        return $this->hasMany('App\Models\Crude');
    }
    
    
}
