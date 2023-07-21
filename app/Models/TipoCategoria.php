<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCategoria extends Model
{
    use HasFactory;

    protected $fillable = ['id_tipo', 'id_categoria'];

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $table = 'tipo_categoria';
}
