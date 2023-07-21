<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $fillable = ['tipo', 'id_categoria', 'created_at', 'updated_at', 'deleted_at'];

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $table = 'tipos';

    public function filtro(){
        return $this->hasMany(FiltroCodificacion::class, 'id_tipo', 'id');
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id');
    }
}
