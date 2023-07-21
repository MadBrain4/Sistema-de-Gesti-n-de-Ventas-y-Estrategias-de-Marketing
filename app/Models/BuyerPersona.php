<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerPersona extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['tipo', 'descripcion', 'created_at', 'updated_at', 'deleted_at'];
    protected $table = 'buyer_persona';
}
