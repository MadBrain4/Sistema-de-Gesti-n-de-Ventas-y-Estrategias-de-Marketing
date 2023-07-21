<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TareaPresupuesto extends Model
{
    use HasFactory;

    protected $table = 'tarea_presupuesto';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['tarea', 'valor', 'id_padre', 'created_at', 'updated_at', 'deleted_at', 'id_estrategia'];

   public function parent()
   {
      return $this->belongsTo(self::class, 'id_padre');
   }

   public function children()
   {
      return $this->hasMany(self::class, 'id_padre')->with('children');
   }

   public function children_sin_children()
   {
      return $this->hasMany(self::class, 'id_padre');
   }
}
