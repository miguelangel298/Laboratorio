<?php

namespace Laboratorio;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = "sucursales";

    public $timestamps = false;
	  protected $primaryKey = 'IdSucursal';
    protected $fillable = ['Codigo','Nombre','Telefono','Direccion','IdMunicipio','AnoApertura','Estado'];
}
