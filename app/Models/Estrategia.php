<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estrategia extends Model
{
    use HasFactory;

    protected $table = 'Estrategias';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = ['id', 'titulo', 'descripcion', 'fecha_inicio', 'fecha_final', 'buyer_persona', 'presupuesto', 'objetivo', 'kpi', 'valor_referencial', 'tipo_valor_referencial', 'resultado', 'analisis', 'created_at', 'updated_at', 'deleted_at'];
}
