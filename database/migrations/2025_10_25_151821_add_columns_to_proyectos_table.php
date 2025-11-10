<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->decimal('avance', 5, 2)->nullable();
            $table->decimal('calidad', 5, 2)->nullable();
            $table->decimal('asistencia_equipo', 5, 2)->nullable();
            $table->decimal('hito_1', 5, 2)->nullable();
            $table->decimal('hito_2', 5, 2)->nullable();
            $table->decimal('hito_3', 5, 2)->nullable();
            $table->decimal('hito_4', 5, 2)->nullable();
            $table->decimal('etapa_1', 5, 2)->nullable();
            $table->decimal('etapa_2', 5, 2)->nullable();
            $table->decimal('etapa_3', 5, 2)->nullable();
            $table->decimal('etapa_4', 5, 2)->nullable();
            $table->decimal('entrega_final', 5, 2)->nullable();
            $table->decimal('revision_cliente', 5, 2)->nullable();
            $table->decimal('score_final', 5, 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropColumn([
                'avance', 'calidad', 'asistencia_equipo',
                'hito_1', 'hito_2', 'hito_3', 'hito_4',
                'etapa_1', 'etapa_2', 'etapa_3', 'etapa_4',
                'entrega_final', 'revision_cliente', 'score_final'
            ]);
        });
    }
};

