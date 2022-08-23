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
class Archivo extends Model
{
    public function crudi()
    {
        return $this->belongsTo('App\Models\Crudi');
    }
    
    
}
