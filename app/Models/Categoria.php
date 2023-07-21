<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tipo;


class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'id_producto', 'id_clase', 'created_at', 'updated_at', 'deleted_at'];

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $table = 'categorias';

    public function tipo(){
        return $this->hasMany(Tipo::class, 'id_categoria', 'id');
    }

    public function producto(){
        return $this->belongsTo(Producto::class, 'id_producto', 'id');
    }

    public function clase(){
        return $this->belongsTo(Clase::class, 'id_clase', 'id');
    }
}
