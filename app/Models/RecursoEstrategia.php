<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecursoEstrategia extends Model
{
    use HasFactory;

    protected $table = "recurso_estrategia";
    protected $primaryKey = 'id';
    public $interesting = true;

    protected $fillable = ['id_recurso', 'id_estrategia'];
}
