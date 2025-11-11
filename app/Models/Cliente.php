<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'correo', 'telefono', 'direccion'];

    // 🔹 Relación con proyectos
    public function proyectos()
    {
        return $this->hasMany(\App\Models\Proyecto::class, 'cliente_id');
    }
}
