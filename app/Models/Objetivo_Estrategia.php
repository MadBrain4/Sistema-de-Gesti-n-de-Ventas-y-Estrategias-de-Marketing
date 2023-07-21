<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objetivo_Estrategia extends Model
{
    use HasFactory;

    protected $table = 'objetivos_estrategia';
    protected $fillable = ['id_objetivo', 'id_estrategia'];
}
