<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculoAplicacion extends Model
{
    use HasFactory;

    protected $fillable = ['id_marca', 'modelo', 'motor', 'ano', 'cilindrada', 'ano', 'sincronizado', 'created_at', 'updated_at', 'deleted_at'];
    
    protected $table = "aplicacion_vehiculo";
}
