<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $table = "presupuesto";

    protected $fillable = ['id_estrategia', 'presupuesto', 'created_at', 'updated_at', 'deleted_at'];

    public function parent()
       {
          return $this->belongsTo(self::class, 'procedencia');
       }

       public function children()
       {
          return $this->hasMany(self::class, 'procedencia')->with('children');
       }
}
