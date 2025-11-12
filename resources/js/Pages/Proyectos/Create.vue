<script setup>
import { Link, useForm } from "@inertiajs/vue3";

defineProps({
  clientes: Array,
});

const form = useForm({
  nombre_proyecto: "",
  cliente_id: "",
  descripcion: "",
  fecha_inicio: "",
  fecha_fin: "",
  presupuesto: "",
});

const submit = () => {
  form.post(route("proyectos.store"));
};
</script>

<template>
  <div class="container-bg w-full min-h-screen p-8 flex justify-center items-center">
    <div class="max-w-3xl w-full bg-white/10 backdrop-blur-md p-8 rounded-lg shadow-2xl animate-fadeIn border border-white/20">
      
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-white">Crear Nuevo Proyecto</h1>
        
        <Link
          :href="route('proyectos.index')"
          class="bg-gradient-to-r from-green-600 to-emerald-500 text-white py-2 px-4 rounded-lg shadow-md hover:shadow-green-400/40 transition-all"
        >
          ⬅ Volver
        </Link>
      </div>

      <form @submit.prevent="submit">
        <!-- Nombre del proyecto -->
        <div class="mb-4">
          <label class="block text-white mb-2 font-semibold">Nombre del Proyecto</label>
          <input
            v-model="form.nombre_proyecto"
            type="text"
            class="w-full border-white/30 bg-white/5 text-white rounded-md placeholder-gray-400 focus:border-indigo-400 focus:ring focus:ring-indigo-200/50 transition"
            required
          />
        </div>

        <!-- Cliente -->
        <div class="mb-4">
          <label class="block text-white mb-2 font-semibold">Cliente</label>
          <select
            v-model="form.cliente_id"
            class="w-full border-white/30 bg-white/5 text-white rounded-md focus:border-indigo-400 focus:ring focus:ring-indigo-200/50 transition"
            required
          >
            <option disabled value="" class="bg-gray-800 text-white">Seleccione un cliente</option>
            <option
              v-for="cliente in clientes"
              :key="cliente.id"
              :value="cliente.id"
              class="bg-gray-800 text-white"
            >
              {{ cliente.nombre }}
            </option>
          </select>
        </div>

        <!-- Fecha de inicio -->
        <div class="mb-4">
          <label class="block text-white mb-2 font-semibold">Fecha de Inicio</label>
          <input
            v-model="form.fecha_inicio"
            type="date"
            class="w-full border-white/30 bg-white/5 text-white rounded-md focus:border-indigo-400 focus:ring focus:ring-indigo-200/50 transition"
          />
        </div>

        <!-- Fecha de fin -->
        <div class="mb-4">
          <label class="block text-white mb-2 font-semibold">Fecha de Fin</label>
          <input
            v-model="form.fecha_fin"
            type="date"
            class="w-full border-white/30 bg-white/5 text-white rounded-md focus:border-indigo-400 focus:ring focus:ring-indigo-200/50 transition"
          />
        </div>

        <!-- Presupuesto -->
        <div class="mb-6">
          <label class="block text-white mb-2 font-semibold">Presupuesto (S/)</label>
          <input
            v-model="form.presupuesto"
            type="number"
            step="0.01"
            min="0"
            placeholder="Ejemplo: 15000.00"
            class="w-full border-white/30 bg-white/5 text-white rounded-md placeholder-gray-400 focus:border-indigo-400 focus:ring focus:ring-indigo-200/50 transition"
          />
        </div>

        <!-- Descripción -->
        <div class="mb-6">
          <label class="block text-white mb-2 font-semibold">Descripción</label>
          <textarea
            v-model="form.descripcion"
            class="w-full border-white/30 bg-white/5 text-white rounded-md placeholder-gray-400 focus:border-indigo-400 focus:ring focus:ring-indigo-200/50 transition"
            rows="4"
          ></textarea>
        </div>

        <!-- Botón de guardar -->
        <div class="flex justify-end">
          <button
            type="submit"
            :disabled="form.processing"
            class="bg-gradient-to-r from-violet-600 to-indigo-500 hover:from-indigo-500 hover:to-violet-600 text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:shadow-indigo-400/40 transition-all disabled:opacity-50"
          >
            Guardar Proyecto
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<style>
html, body {
  margin: 0;
  padding: 0;
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

.container-bg {
  background: linear-gradient(-78deg, #4c1b88, #4277BD, #298f79, #105293);
  background-size: 400% 400%;
  animation: gradientShift 12s ease infinite;
}

.animate-fadeIn {
  animation: fadeIn 0.8s ease-out;
}
</style>
