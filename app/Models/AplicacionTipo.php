<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AplicacionTipo extends Model
{
    use HasFactory;

    protected $table = 'aplicacion_tipo';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $fillable = ['aplicacion', 'sincronizado', 'created_at', 'updated_at', 'deleted_at'];
}
