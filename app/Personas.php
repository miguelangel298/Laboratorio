<?php

namespace Laboratorio;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    protected $primaryKey = 'Idpersona';
    
    protected $fillable = [
        'Cedula', 'Nombres', 'Apellido1' , 'Apellido2','FechaNacimineto', 'IdNacionalidad', 'IdSexo', 'Telefono', 'Celular', 'Correo', 'IdUser'
    ];
}
