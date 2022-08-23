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
class Cuenta extends Model
{
    public function expediente()
    {
        return $this->belongsTo('App\Models\Expediente');
    }
    
    
}
