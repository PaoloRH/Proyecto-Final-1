@extends('layouts.app')

@section('title', 'Simulación de Proyectos')

@section('content')

<div class="bg-white p-6 rounded-lg shadow-lg max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-center text-indigo-600">Simulación de Proyectos</h2>

    <!-- Formulario de simulación -->
    <form action="{{ route('proyectos.simulacion.calcular') }}" method="POST">
        @csrf

        <!-- Participación -->
        <div class="mb-4">
            <label for="avance" class="block text-sm font-semibold text-gray-800">Avance (%)</label>
            <input type="number" name="avance" id="avance" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800" required step="0.01" min="0" max="100" value="{{ old('avance') }}">
        </div>

        <!-- Calidad -->
        <div class="mb-4">
            <label for="calidad" class="block text-sm font-semibold text-gray-800">Calidad (%)</label>
            <input type="number" name="calidad" id="calidad" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800" required step="0.01" min="0" max="100" value="{{ old('calidad') }}">
        </div>

        <!-- Asistencia de equipo -->
        <div class="mb-4">
            <label for="asistencia_equipo" class="block text-sm font-semibold text-gray-800">Asistencia del Equipo (%)</label>
            <input type="number" name="asistencia_equipo" id="asistencia_equipo" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800" required step="0.01" min="0" max="100" value="{{ old('asistencia_equipo') }}">
        </div>

        <!-- Hitos -->
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-800 mb-2">Hitos (1-4)</label>
            <div class="grid grid-cols-2 gap-4">
                @for($i=1; $i<=4; $i++)
                <input type="number" name="hito_{{ $i }}" placeholder="Hito {{ $i }} (%)" class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800" required step="0.01" min="0" max="100" value="{{ old('hito_'.$i) }}">
                @endfor
            </div>
        </div>

        <!-- Etapas -->
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-800 mb-2">Etapas (1-4)</label>
            <div class="grid grid-cols-2 gap-4">
                @for($i=1; $i<=4; $i++)
                <input type="number" name="etapa_{{ $i }}" placeholder="Etapa {{ $i }} (%)" class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800" required step="0.01" min="0" max="100" value="{{ old('etapa_'.$i) }}">
                @endfor
            </div>
        </div>

        <!-- Entrega final -->
        <div class="mb-4">
            <label for="entrega_final" class="block text-sm font-semibold text-gray-800">Entrega Final (%)</label>
            <input type="number" name="entrega_final" id="entrega_final" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800" required step="0.01" min="0" max="100" value="{{ old('entrega_final') }}">
        </div>

        <!-- Revisión del cliente -->
        <div class="mb-4">
            <label for="revision_cliente" class="block text-sm font-semibold text-gray-800">Revisión Cliente (%)</label>
            <input type="number" name="revision_cliente" id="revision_cliente" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800" required step="0.01" min="0" max="100" value="{{ old('revision_cliente') }}">
        </div>

        <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            Calcular
        </button>
    </form>

    <!-- Resultado -->
    @isset($final)
        <div class="mt-6 text-center">
            <h3 class="text-xl font-semibold text-indigo-600">Score Final: {{ $final }} / 100</h3>
            <h3 class="text-lg font-semibold {{ $estado == 'APROBADO ✅' ? 'text-green-600' : 'text-red-600' }}">Estado: {{ $estado }}</h3>
        </div>
    @endisset
</div>

@endsection
