<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribuidora extends Model
{
    protected $table = "distribuidoras";

    protected $fillable = ['id', 'nombre', 'email', 'pais', 'direccion', 'estado', 'ciudad', 'telefono', 'telefono2', 'created_at', 'updated_at', 'deleted_at'];

    use HasFactory;
}
