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
class Crudi extends Model
{
    public function crude()
    {
        return $this->belongsTo('App\Models\Crude');
    }

    public function archivos()
    {
        return $this->hasMany('App\Models\Archivo');
    }
    
    
}
