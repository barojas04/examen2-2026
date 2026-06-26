<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model {
    protected $table = 'categorias';
    protected $primaryKey = 'idCategoria';
    public $incrementing = false; // Llave primaria explícita no autoincremental
    protected $fillable = ['idCategoria', 'nombre'];

    // Relación: Una Categoría tiene muchos Materiales
    public function materiales(): HasMany {
        return $this->hasMany(Material::class, 'idCategoria', 'idCategoria');
    }
}