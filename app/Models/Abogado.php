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
class Abogado extends Model
{
    public function expedientes()
    {
        return $this->hasMany('App\Models\Expediente');
    }
    
}
