<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equivalencia extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['id_filtro', 'codigo', 'codigo_buscar', 'marca', 'codigo_marca', 'codigo_marca_buscar', 'id_marca', 'sincronizado', 'created_at', 'updated_at', 'deleted_at'];

    protected $table = "filtro_equivalencia";

    public function filtro(){
        return $this->belongsTo(FiltroCodificacion::class, 'id_filtro', 'id');
    }
}


