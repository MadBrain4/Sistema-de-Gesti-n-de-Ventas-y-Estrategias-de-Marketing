<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaseEstrategia extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $fillable = ['fase', 'fecha_inicio', 'fecha_final', 'num_fase', 'id_estrategia', 'created_at', 'updated_at', 'deleted_at'];

    protected $table = 'fase_estrategia';
}
