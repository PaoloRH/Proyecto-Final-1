<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProyectosController extends Controller
{
    /**
     * Mostrar todos los proyectos o los del cliente especificado.
     */
    public function index(Request $request)
    {
        $clienteId = $request->query('cliente_id');

        $proyectos = Proyecto::with('cliente')
            ->when($clienteId, function ($query) use ($clienteId) {
                $query->where('cliente_id', $clienteId);
            })
            ->orderBy('id', 'desc')
            ->get();

        return Inertia::render('Proyectos/Index', [
            'proyectos' => $proyectos,
            'cliente_id' => $clienteId,
        ]);
    }

    /**
     * Mostrar el formulario para crear un nuevo proyecto.
     */
    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();

        return Inertia::render('Proyectos/Create', [
            'clientes' => $clientes,
        ]);
    }

    /**
     * Guardar un nuevo proyecto en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_proyecto' => 'required|string|max:255',
            'cliente_id' => 'required|exists:clientes,id',
            'descripcion' => 'nullable|string',
            'estado' => 'nullable|string|max:50',
            'presupuesto' => 'nullable|numeric|min:0',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'avance' => 'nullable|integer|min:0|max:100',
        ]);

        Proyecto::create($validated);

        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado correctamente.');
    }

    /**
     * Mostrar un proyecto específico.
     */
    public function show(Proyecto $proyecto)
    {
        $proyecto->load('cliente');

        return Inertia::render('Proyectos/Show', [
            'proyecto' => $proyecto,
        ]);
    }

    /**
     * Mostrar el formulario para editar un proyecto.
     */
    public function edit(Proyecto $proyecto)
    {
        $clientes = Cliente::orderBy('nombre')->get();

        return Inertia::render('Proyectos/Edit', [
            'proyecto' => $proyecto,
            'clientes' => $clientes,
        ]);
    }

    /**
     * Actualizar un proyecto en la base de datos.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        $validated = $request->validate([
            'nombre_proyecto' => 'required|string|max:255',
            'cliente_id' => 'required|exists:clientes,id',
            'descripcion' => 'nullable|string',
            'estado' => 'nullable|string|max:50',
            'presupuesto' => 'nullable|numeric|min:0',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'avance' => 'nullable|integer|min:0|max:100',
        ]);

        $proyecto->update($validated);

        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado correctamente.');
    }

    /**
     * Eliminar un proyecto.
     */
    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();

        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado correctamente.');
    }
}
