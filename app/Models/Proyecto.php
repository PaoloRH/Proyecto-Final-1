<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyecto extends Model
{
    use SoftDeletes;

    // Permitir asignación masiva en todos los campos
    protected $guarded = [];

    /**
     * Relación: una nota pertenece a un estudiante
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}