<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KPI extends Model
{
    use HasFactory;

    protected $table = 'kpi';
    protected $fillable = ['id', 'kpi', 'cantidad', 'resultado', 'created_at', 'updated_at', 'deleted_at'];
}
