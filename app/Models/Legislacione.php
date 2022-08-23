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
class Legislacione extends Model
{
    
    public function archivolegislaciones()
    {
        return $this->hasMany('App\Models\Archivolegislacione');
    }
}
