<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    protected $fillable = [
        'nombre_proyecto',
        'cliente_id',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'presupuesto',
        'avance',
        'calidad',
        'asistencia_equipo',
        'hito_1',
        'hito_2',
        'hito_3',
        'hito_4',
        'etapa_1',
        'etapa_2',
        'etapa_3',
        'etapa_4',
        'entrega_final',
        'revision_cliente',
        'score_final'
    ];

    // Relación con Cliente
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    // ❌ CORRECCIÓN: Ya NO existe el método 'tareas()'
}

