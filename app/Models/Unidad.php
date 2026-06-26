<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model {
    protected $table = 'unidades';
    protected $primaryKey = 'idUnidad';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['idUnidad', 'nombre'];

    public function materialUnidades(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(MaterialUnidad::class, 'idUnidad', 'idUnidad');
    }
}
