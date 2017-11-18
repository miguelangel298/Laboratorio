<?php

namespace Laboratorio;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    protected $table = "detallefactura";

    public $timestamps = false;

	protected $primaryKey = 'IdDetalleFactura';
    protected $fillable = ['IdFactura','IdProcedimiento'];
}
