<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
USE App\Models\FiltroCodificacion;

class Panel extends Model
{
    protected $fillable = ['id_filtro', 'codigo', 'codigo_buscar', 'tipo', 'largo', 'ancho', 'altura', 'detalle1', 'detalle2', 'sincronizado', 'imagen', 'imagen1', 'imagen2', 'imagen3', 'deleted_at', 'updated_at'];

    protected $table = 'espec_panel';

    use HasFactory;

    public function filtro(){
        return $this->belongsTo(FiltroCodificacion::class, 'id_filtro', 'id');
    }
}
