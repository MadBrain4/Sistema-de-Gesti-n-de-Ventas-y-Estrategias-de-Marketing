<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaAplicacion extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'marca', 'sincronizado', 'created_at', 'updated_at', 'deleted_at'];

    protected $table = 'aplicacion_marca';
}
