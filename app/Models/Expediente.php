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
class Expediente extends Model
{
    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }

    public function materia()
    {
        return $this->belongsTo('App\Models\Materia');
    }

    public function instancia()
    {
        return $this->belongsTo('App\Models\Instancia');
    }

    public function tipoexpediente()
    {
        return $this->belongsTo('App\Models\Tipoexpediente');
    }

    public function abogado()
    {
        return $this->belongsTo('App\Models\Abogado');
    }

    public function etapa()
    {
        return $this->belongsTo('App\Models\Etapa');
    }    

    public function archivoexpedientes()
    {
        return $this->hasMany('App\Models\Archivoexpediente');
    }

    public function exhortos()
    {
        return $this->hasMany('App\Models\Exhorto');
    }

    public function cuentas()
    {
        return $this->hasMany('App\Models\Cuenta');
    }
    
    
}
