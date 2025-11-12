<script setup>
import { Link, usePage } from "@inertiajs/vue3";

const page = usePage();

defineProps({
  proyecto: Object,
});
</script>

<template>
  <div class="container w-full min-h-screen p-8 text-white">
    
    <!-- 🔹 Botón volver -->
    <div class="mb-6 flex items-center justify-between">
      <div class="flex items-center space-x-3">
        <Link
          :href="route('proyectos.index')"
          class="bg-gradient-to-r from-green-600 to-emerald-500 text-white py-2 px-4 rounded-lg shadow-md hover:shadow-green-400/40 transition-all"
        >
          ⬅ Volver
        </Link>
        <h1 class="text-2xl font-bold text-yellow-300">
          Detalles del Proyecto
        </h1>
      </div>
      <Link
        :href="route('proyectos.edit', proyecto.id)"
        class="bg-gradient-to-r from-yellow-500 to-orange-400 hover:from-orange-500 hover:to-yellow-500 text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:shadow-yellow-400/40 transition-all"
      >
        ✏️ Editar Proyecto
      </Link>
    </div>

    <!-- 🔹 Contenedor principal -->
    <div class="bg-white/10 backdrop-blur-md p-8 rounded-xl shadow-lg animate-fadeIn">

      <h2 class="text-3xl font-bold text-yellow-300 mb-4">{{ proyecto.nombre_proyecto }}</h2>

      <div class="grid grid-cols-2 gap-4 border-b border-white/20 pb-4 mb-6">
        <p><strong>Cliente:</strong> {{ proyecto.cliente?.nombre ?? "—" }}</p>
        <p>
          <strong>Estado:</strong>
          <span
            :class="{
              'text-green-400': proyecto.estado === 'finalizado',
              'text-orange-400': proyecto.estado !== 'finalizado'
            }"
            class="font-semibold"
          >
            {{ proyecto.estado ?? "pendiente" }}
          </span>
        </p>
        <p><strong>Fecha de Inicio:</strong> {{ proyecto.fecha_inicio ?? "No definida" }}</p>
        <p><strong>Fecha de Fin:</strong> {{ proyecto.fecha_fin ?? "No definida" }}</p>
        <p class="col-span-2"><strong>Presupuesto:</strong> {{ proyecto.presupuesto ?? "No definido" }}</p>
      </div>

      <!-- 🔹 Barra de avance -->
      <h3 class="text-xl font-semibold text-yellow-300 mb-3">Progreso General</h3>
      <div class="flex items-center gap-4 mb-6">
        <div class="w-full bg-white/20 rounded-full h-4">
          <div
            class="bg-gradient-to-r from-sky-500 to-blue-600 h-4 rounded-full transition-all duration-500"
            :style="{ width: (proyecto.avance ?? 0) + '%' }"
          ></div>
        </div>
        <span class="text-xl text-yellow-300 font-bold">{{ proyecto.avance ?? 0 }}%</span>
      </div>

      <!-- 🔹 Descripción -->
      <h3 class="text-xl font-semibold text-yellow-300 mb-3">Descripción</h3>
      <p class="border border-white/20 bg-white/10 rounded-lg p-4 text-white/90">
        {{ proyecto.descripcion ?? "Sin descripción." }}
      </p>
    </div>
  </div>
</template>

<style>
html,
body {
  margin: 0;
  padding: 0;
  overflow-x: hidden;
}

/* 🎨 Fondo animado compartido con Index.vue */
@keyframes gradientShift {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.container {
  background: linear-gradient(-78deg, #4c1b88, #4277bd, #298f79, #105293);
  background-size: 400% 400%;
  animation: gradientShift 12s ease infinite, fadeIn 0.8s ease-out;
  min-height: 100vh;
  width: 100%;
}
</style>
