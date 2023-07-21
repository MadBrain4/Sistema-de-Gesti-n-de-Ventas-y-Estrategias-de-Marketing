<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    use HasFactory;

    protected $table = 'objetivos';

    protected $fillable = ['id', 'objetivos', 'created_at', 'updated_at', 'deleted_at'];
}
