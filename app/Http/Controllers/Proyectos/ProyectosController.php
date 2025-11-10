<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProyectosController extends Controller
{
    /**
     * Muestra la lista de proyectos simulados.
     */
    public function index()
    {
        $proyectos = session()->get('proyectos', []);
        $ultimosProyectos = array_slice($proyectos, -10);

        return Inertia::render('Proyectos/Index', [
            'proyectos' => $ultimosProyectos,
        ]);
    }

    /**
     * Muestra el formulario de simulación.
     */
    public function simulacion()
    {
        return Inertia::render('Proyectos/Simulacion');
    }

    /**
     * Procesa los datos del formulario y calcula la simulación.
     */
    public function calcularSimulacion(Request $request)
    {
        $data = $request->validate([
            'avance' => 'required|numeric|min:0|max:100',
            'calidad' => 'required|numeric|min:0|max:100',
            'asistencia_equipo' => 'required|numeric|min:0|max:100',
            'hitos' => 'required|array|min:1',
            'hitos.*' => 'numeric|min:0|max:100',
            'etapas' => 'required|array|min:4|max:4',
            'etapas.*' => 'numeric|min:0|max:100',
            'entrega_final' => 'required|numeric|min:0|max:100',
            'revision_cliente' => 'required|numeric|min:0|max:100',
        ]);

        $proyecto = [
            'avance' => $data['avance'],
            'calidad' => $data['calidad'],
            'asistencia_equipo' => $data['asistencia_equipo'],
            'hitos' => $data['hitos'],
            'etapas' => $data['etapas'],
            'entrega_final' => $data['entrega_final'],
            'revision_cliente' => $data['revision_cliente'],
        ];

        // Ponderaciones personalizables
        $pesos = [
            'avance' => 10,
            'calidad' => 20,
            'asistencia_equipo' => 10,
            'hitos' => 20,
            'etapas' => 20,
            'entrega_final' => 10,
            'revision_cliente' => 10,
        ];

        $sum_ponderada = 0;
        $sum_pesos = 0;

        foreach ($proyecto as $modulo => $valor) {
            $promedio = is_array($valor) ? array_sum($valor)/count($valor) : $valor;
            $sum_ponderada += $promedio * $pesos[$modulo];
            $sum_pesos += $pesos[$modulo];
        }

        $score_final = round($sum_ponderada / $sum_pesos, 2);

        // Guardamos simulaciones en sesión
        $proyectos = session()->get('proyectos', []);
        $proyectos[] = array_merge($proyecto, ['score_final' => $score_final]);
        session()->put('proyectos', $proyectos);

        return Inertia::render('Proyectos/Simulacion', [
            'resultado' => ['score_final' => $score_final],
        ]);
    }
}
