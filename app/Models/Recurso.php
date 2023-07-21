<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    use HasFactory;

    protected $table = 'recursos';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = ['recurso', 'tipo_recurso', 'created_at', 'updated_at', 'deleted_at'];
}
