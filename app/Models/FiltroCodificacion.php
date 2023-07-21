<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AireAutomotriz;
use App\Models\AireIndustrial;
use App\Models\CombustibleLinea;
use App\Models\Elemento;
use App\Models\Panel;
use App\Models\Sellado;

class FiltroCodificacion extends Model
{
    protected $fillable = ['id', 'codigo', 'codigo_buscar', 'descripcion', 'precio', 'fecha_actualiza', 'sincronizado', 'id_clase', 'id_tipo', 'deleted_at', 'updated_at', 'created_at'];

    protected $table = 'filtro_codificacion';
    
    use HasFactory;

    public function AireAutomotriz(){
        return $this->hasMany(AireAutomotriz::class, 'id_filtro', 'id');
    }

    public function AireIndustrial(){
        return $this->hasMany(AireIndustrial::class, 'id_filtro', 'id');
    }

    public function CombustibleLinea(){
        return $this->hasMany(CombustibleLinea::class, 'id_filtro', 'id');
    }

    public function Elemento(){
        return $this->hasMany(Elemento::class, 'id_filtro', 'id');
    }

    public function Panel(){
        return $this->hasMany(Panel::class, 'id_filtro', 'id');
    }

    public function Sellado(){
        return $this->hasMany(Sellado::class, 'id_filtro', 'id');
    }

    public function Equivalencia(){
        return $this->hasMany(Equivalencia::class, 'id_filtro', 'id');
    }

    public function tipo(){
        return $this->belongsTo(Tipo::class, 'id_tipo', 'id');
    }

    public function clase(){
        return $this->belongsTo(Clase::class, 'id_clase', 'id');
    }

    public function aplicacion(){
        return $this->belongsTo(Aplicacion::class, 'id_filtro', 'id');
    }
}
