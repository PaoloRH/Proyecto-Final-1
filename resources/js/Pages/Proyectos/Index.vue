<template>
  <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <!-- Botón Volver -->
    <div class="mb-4">
      <Link
        :href="route('clientes.index')"
        class="bg-gray-300 text-gray-800 py-2 px-4 rounded-lg shadow hover:bg-gray-400 transition"
      >
        ← Volver
      </Link>
    </div>

    <h1 class="text-2xl font-bold mb-6 text-indigo-600 text-center">
      Listado de Proyectos
    </h1>

    <!-- Tabla de proyectos -->
    <div v-if="proyectos.length > 0" class="overflow-x-auto">
      <table class="min-w-full border border-gray-200 rounded-lg">
        <thead class="bg-indigo-600 text-white">
          <tr>
            <th class="py-3 px-4 text-left">#</th>
            <th class="py-3 px-4 text-left">Cliente</th>
            <th class="py-3 px-4 text-left">Proyecto</th>
            <th class="py-3 px-4 text-center">Avance (%)</th>
            <th class="py-3 px-4 text-center">Calidad (%)</th>
            <th class="py-3 px-4 text-center">Asistencia (%)</th>
            <th class="py-3 px-4 text-center">Hito 1</th>
            <th class="py-3 px-4 text-center">Hito 2</th>
            <th class="py-3 px-4 text-center">Hito 3</th>
            <th class="py-3 px-4 text-center">Hito 4</th>
            <th class="py-3 px-4 text-center">Score Final</th>
            <th class="py-3 px-4 text-center">Estado</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(proyecto, index) in proyectos"
            :key="proyecto.id"
            class="border-b hover:bg-gray-50 transition"
          >
            <td class="py-2 px-4">{{ index + 1 }}</td>
            <td class="py-2 px-4">{{ proyecto.cliente?.nombre ?? '—' }}</td>
            <td class="py-2 px-4">{{ proyecto.nombre_proyecto }}</td>
            <td class="py-2 px-4 text-center">{{ proyecto.avance ?? '—' }}</td>
            <td class="py-2 px-4 text-center">{{ proyecto.calidad ?? '—' }}</td>
            <td class="py-2 px-4 text-center">{{ proyecto.asistencia_equipo ?? '—' }}</td>
            <td class="py-2 px-4 text-center">{{ proyecto.hito_1 ?? '—' }}</td>
            <td class="py-2 px-4 text-center">{{ proyecto.hito_2 ?? '—' }}</td>
            <td class="py-2 px-4 text-center">{{ proyecto.hito_3 ?? '—' }}</td>
            <td class="py-2 px-4 text-center">{{ proyecto.hito_4 ?? '—' }}</td>
            <td class="py-2 px-4 text-center font-semibold text-indigo-600">
              {{ proyecto.score_final ?? '—' }}
            </td>
            <td
              class="py-2 px-4 text-center font-semibold"
              :class="proyecto.estado === 'finalizado' ? 'text-green-600' : 'text-yellow-600'"
            >
              {{ proyecto.estado }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-else class="text-center py-6 text-gray-500">
      No se encontraron proyectos.
    </div>

    <div class="mt-6 text-center">
      <Link
        href="/proyectos/create"
        class="bg-indigo-600 text-white py-2 px-4 rounded-lg shadow hover:bg-indigo-700 transition"
      >
        Crear Proyecto
      </Link>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  proyectos: {
    type: Array,
    default: () => [],
  },
});
</script>

<style scoped>
table {
  border-collapse: collapse;
  width: 100%;
}
</style>
