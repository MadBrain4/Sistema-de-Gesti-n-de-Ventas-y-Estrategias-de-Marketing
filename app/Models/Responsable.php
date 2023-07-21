<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    use HasFactory;

    protected $table = 'responsables';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['responsable', 'created_at', 'updated_at', 'deleted_at'];
}
