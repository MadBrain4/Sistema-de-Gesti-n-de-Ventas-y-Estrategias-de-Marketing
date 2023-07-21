<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $fillable = ['producto', 'created_at', 'updated_at', 'deleted_at'];

    public function categoria(){
        return $this->hasMany(Categoria::class, 'id_producto', 'id');
    }
}
