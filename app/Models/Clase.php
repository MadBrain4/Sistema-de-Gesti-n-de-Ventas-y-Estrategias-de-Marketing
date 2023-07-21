<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;

    protected $fillable = ['clase', 'created_at', 'updated_at', 'deleted_at'];

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $table = 'clases';

    public function categoria(){
        return $this->hasMany(Categoria::class, 'id_clase', 'id');
    }

    public function filtro(){
        return $this->hasMany(FiltroCodificacion::class, 'id_clase', 'id');
    }
}
