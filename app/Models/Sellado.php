<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FiltroCodificacion;

class Sellado extends Model
{
    protected $fillable = ['id_filtro', 'codigo', 'codigo_buscar', 'tipo', 'diametroext', 'diametroint', 'altura', 'diametroempext', 'diametroempint', 'espesoremp', 'detalle1', 'valvulaal', 'valvulaad', 'detalle2', 'sincronizado', 'imagen', 'imagen1', 'imagen2', 'imagen3', 'deleted_at', 'updated_at'];

    protected $table = 'espec_sellado';

    use HasFactory;

    public function filtro(){
        return $this->belongsTo(FiltroCodificacion::class, 'id_filtro', 'id');
    }
}
