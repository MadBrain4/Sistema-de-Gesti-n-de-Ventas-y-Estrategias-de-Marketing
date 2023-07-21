<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiEstrategia extends Model
{
    use HasFactory;

    protected $table = 'kpi_estrategia';

    protected $fillable = ['id', 'id_kpi', 'id_estrategia'];
}
