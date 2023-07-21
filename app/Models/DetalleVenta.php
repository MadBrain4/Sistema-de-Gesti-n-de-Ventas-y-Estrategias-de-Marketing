<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalle_venta';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['id_Venta', 'id_filtro', 'codigo', 'cantidad', 'precio_total'];
}
