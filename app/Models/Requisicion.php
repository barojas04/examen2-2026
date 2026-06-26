<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Requisicion extends Model {
    protected $table = 'requisiciones';
    protected $primaryKey = 'idRequisicion';
    public $incrementing = false;
    protected $fillable = ['idRequisicion', 'fecha', 'estado', 'idUsuario'];

    // Una requisición es emitida por un usuario solicitante concreto
    public function usuario(): BelongsTo {
        return $this->belongsTo(Usuario::class, 'idUsuario', 'idUsuario');
    }
}