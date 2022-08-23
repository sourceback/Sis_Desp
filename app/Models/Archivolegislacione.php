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
class Archivolegislacione extends Model
{
    public function legislacione()
    {
        return $this->belongsTo('App\Models\Legislacione');
    }

    public function crude()
    {
        return $this->hasMany('App\Models\Crude');
    }
    
    
}
