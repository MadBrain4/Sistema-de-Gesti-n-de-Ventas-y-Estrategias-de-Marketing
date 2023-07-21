<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsableEstrategia extends Model
{
    use HasFactory;

    protected $table = 'responsable_estrategia';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = ['id_responsable', 'id_estrategia'];
}
