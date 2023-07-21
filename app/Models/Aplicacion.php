<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplicacion extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['id_tipo', 'id_marca', 'id_vehiculo', 'aplicacion', 'id_filtro', 'codigo', 'detalle', 'sincronizado', 'deleted_at', 'updated_at'];

    protected $table = 'aplicacion';

    use HasFactory;

    public function filtro(){
        return $this->belongsTo(FiltroCodificacion::class, 'id_filtro', 'id');
    }
}
