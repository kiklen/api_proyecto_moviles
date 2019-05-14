<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $table= 'evaluacion';

    protected $fillable= [
        'calificacion',
        'fecha',
        'id_profesor'
    ];
}
