<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AplicacionVehiculo extends Model
{
    use HasFactory;

    protected $table = 'aplicacion_vehiculo';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['modelo', 'motor', 'cilindrada', 'ano', 'sincronizado', 'created_at', 'deleted_at', 'updated_at'];
}
