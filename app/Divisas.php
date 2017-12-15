<?php

namespace Laboratorio;

use Illuminate\Database\Eloquent\Model;

class Divisas extends Model
{
  protected $table = "divisas";

  public $timestamps = false;
  protected $primaryKey = 'IdDivisa';
  protected $fillable = ['IdMoneda','Valor'];
}
