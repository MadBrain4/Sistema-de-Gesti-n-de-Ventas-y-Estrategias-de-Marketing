<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerPersonaEstrategia extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['id_estrategia', 'id_buyer_persona', 'created_at', 'updated_at', 'deleted_at'];
    protected $table = 'buyer_persona_estrategia';
}
