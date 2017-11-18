<?php

namespace Laboratorio;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = "pacientes";

    public $timestamps = false;
	protected $primaryKey = 'IdPaciente';
    protected $fillable = ['IdPersona','SeguroMedico'];
}
