<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Presupuesto extends Model {
    protected $table = 'presupuestos';
    protected $primaryKey = 'codigoPresupuesto';
    public $incrementing = false;
    protected $fillable = ['codigoPresupuesto', 'nombrePresupuesto', 'idUnidad'];

    public function unidad(): BelongsTo {
        return $this->belongsTo(Unidad::class, 'idUnidad', 'idUnidad');
    }

    public function materialUnidades(): HasMany {
        return $this->hasMany(MaterialUnidad::class, 'codigoPresupuesto', 'codigoPresupuesto');
    }
}