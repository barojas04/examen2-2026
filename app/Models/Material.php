<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model {
    protected $table = 'materiales';
    protected $primaryKey = 'codigo';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['codigo', 'unidadMedida', 'descripcion', 'ubicacion', 'idCategoria'];

    // Muchas materiales pertenecen a una categoría
    public function categoria(): BelongsTo {
        return $this->belongsTo(Categoria::class, 'idCategoria', 'idCategoria');
    }

    // Un material puede estar presente en muchas unidades físicas distribuidas
    public function materialUnidades(): HasMany {
        return $this->hasMany(MaterialUnidad::class, 'codigo', 'codigo');
    }
}