<?php

namespace App\Http\Controllers\Clientes;

use App\Models\Cliente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class ClientesController extends Controller
{
    // 📄 Listar clientes
    public function index()
    {
        $clientes = Cliente::orderBy('id', 'DESC')->get();

        return Inertia::render('Clientes/Index', [
            'clientes' => $clientes
        ]);
    }

    // 🧾 Formulario de creación
    public function create()
    {
        return Inertia::render('Clientes/Create');
    }

    // 💾 Guardar nuevo cliente
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|string|max:100',
            'telefono' => 'required|string|max:50',
            'direccion' => 'nullable|string|max:50',
        ]);

        Cliente::create($validated);

        return Redirect::route('clientes.index')->with('success', 'Cliente creado correctamente');
    }

    // ✏️ Editar cliente
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);

        return Inertia::render('Clientes/Edit', [
            'cliente' => $cliente
        ]);
    }

    // 🔄 Actualizar cliente
    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|string|max:100',
            'telefono' => 'required|string|max:50',
            'direccion' => 'nullable|string|max:50',
        ]);

        $cliente->update($validated);

        return Redirect::route('clientes.index')->with('success', 'Cliente actualizado correctamente');
    }

    // 🗑️ Confirmación de eliminación
    public function delete($id)
    {
        $cliente = Cliente::findOrFail($id);

        return Inertia::render('Clientes/Delete', [
            'cliente' => $cliente
        ]);
    }

    // ❌ Eliminar cliente
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return Redirect::route('clientes.index')->with('success', 'Cliente eliminado correctamente');
    }
}
