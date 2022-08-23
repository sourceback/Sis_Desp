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
class Gasto extends Model
{
    
    public function crudis()
    {
        return $this->hasMany('App\Models\Crudi');
    }
}
