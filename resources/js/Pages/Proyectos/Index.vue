<script setup>
import { Link, usePage } from "@inertiajs/vue3";

const props = defineProps({
  proyectos: {
    type: Array,
    default: () => [],
  },
  cliente_id: {
    type: [Number, String, null],
    default: null,
  },
});

const page = usePage();
</script>

<template>
  <div class="container w-full min-h-screen p-0 rounded-none shadow-none">
    
    <div class="p-8">
      
      <div class="flex justify-between items-center mb-6">
        <div class="flex items-center space-x-3">
          <Link
            :href="route('clientes.index')"
            class="bg-gradient-to-r from-green-600 to-emerald-500 text-white py-2 px-4 rounded-lg shadow-md hover:shadow-green-400/40 transition-all"
          >
            ⬅ Volver
          </Link>
          <h1 class="text-2xl font-bold text-yellow-300">Gestión de Proyectos</h1>
        </div>

        <Link
          :href="route('proyectos.create')"
          class="bg-gradient-to-r from-violet-600 to-indigo-500 hover:from-indigo-500 hover:to-violet-600 text-white py-2 px-4 rounded-lg shadow-md hover:shadow-indigo-400/40 transition-all"
        >
          ➕ Nuevo Proyecto
        </Link>
      </div>
      
      <div v-if="proyectos.length > 0" class="overflow-x-auto">
        <table class="min-w-full border border-white/20 rounded-lg">
          <thead class="bg-gradient-to-r from-violet-600 to-indigo-500 text-white">
            <tr>
              <th class="py-3 px-4 text-left">#</th>
              <th class="py-3 px-4 text-left">Proyecto</th>
              <th class="py-3 px-4 text-left">Cliente</th>
              <th class="py-3 px-4 text-center">Estado</th>
              <th class="py-3 px-4 text-center">Progreso</th>
              <th class="py-3 px-4 text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(proyecto, index) in proyectos"
              :key="proyecto.id"
              class="border-b border-white/10 hover:bg-white/10 transition-colors"
            >
              <td class="py-3 px-4 text-gray-300">{{ index + 1 }}</td>
              <td class="py-3 px-4 font-semibold text-white">
                {{ proyecto.nombre_proyecto }}
              </td>
              <td class="py-3 px-4 text-white">{{ proyecto.cliente?.nombre ?? "—" }}</td>
              <td
                class="py-3 px-4 text-center font-semibold"
                :class="{
                  'text-green-400': proyecto.estado === 'finalizado', /* Un verde más claro para el fondo oscuro */
                  'text-orange-400': proyecto.estado !== 'finalizado' /* Un naranja/amarillo más vibrante */
                }"
              >
                {{ proyecto.estado ?? "pendiente" }}
              </td>
              <td class="py-3 px-4 text-center">
                <div class="w-full bg-white/20 rounded-full h-3">
                  <div
                    class="bg-gradient-to-r from-sky-500 to-blue-600 h-3 rounded-full transition-all duration-500"
                    :style="{ width: proyecto.avance + '%' }"
                  ></div>
                </div>
                <span class="text-sm text-white">{{ proyecto.avance ?? 0 }}%</span>
              </td>
              <td class="py-3 px-4 text-center space-x-2">
                <Link
                  :href="route('proyectos.show', proyecto.id)"
                  class="bg-gradient-to-r from-yellow-500 to-orange-400 hover:from-orange-500 hover:to-yellow-500 text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:shadow-yellow-400/40 transition-all"
                >
                  Ver
                </Link>
                <Link
                  :href="route('proyectos.edit', proyecto.id)"
                  class="bg-gradient-to-r from-yellow-500 to-orange-400 hover:from-orange-500 hover:to-yellow-500 text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:shadow-yellow-400/40 transition-all"
                >
                  Editar
                </Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div v-else class="text-center py-10 text-white/70">
        <p>
          {{ cliente_id
            ? "No se encontraron proyectos para este cliente."
            : "No se encontraron proyectos registrados." }}
        </p>
        <Link
          :href="route('proyectos.create')"
          class="bg-gradient-to-r from-violet-600 to-indigo-500 text-white font-semibold hover:shadow-indigo-400/40 transition-all"
        >
          Crea tu primer proyecto → 
        </Link>
      </div>
    </div>
  </div>
</template>

<style>
/* Esto debe estar SIN el atributo 'scoped' para afectar a toda la página */
html, body {
    margin: 0;
    padding: 0;
    /* Opcional: para evitar scrollbar si no es necesario */
    overflow-x: hidden; 
}
</style>

<style scoped>
@keyframes gradientShift {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.container {
  /* Fondo con degradado animado */
  background: linear-gradient( -78deg, #4c1b88, #4277BD, #3A9181, #105293);
  background-size: 400% 400%;
  /* Corrección: Combinar animaciones con coma */
  animation: gradientShift 12s ease infinite, fadeIn 0.8s ease-out;
  
  /* Aseguramos que ocupe toda la pantalla (aunque min-h-screen de Tailwind ya lo hace) */
  min-height: 100vh;
  width: 100%;
}

table {
  border-collapse: collapse;
  width: 100%;
}
</style>