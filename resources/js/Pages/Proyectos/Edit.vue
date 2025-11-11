<script setup>
import { useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
  proyecto: Object,
  clientes: Array,
});

// Inicializa el formulario con todos los campos del modelo
const form = useForm({
  nombre_proyecto: props.proyecto.nombre_proyecto || "",
  descripcion: props.proyecto.descripcion || "",
  cliente_id: props.proyecto.cliente_id || "",
  avance: props.proyecto.avance || 0,
  estado: props.proyecto.estado || "pendiente",
  fecha_inicio: props.proyecto.fecha_inicio || "",
  fecha_fin: props.proyecto.fecha_fin || "",
  presupuesto: props.proyecto.presupuesto || "",
});

const submit = () => {
  form.put(route("proyectos.update", props.proyecto.id), {
    onSuccess: () => {
      window.location.href = route("proyectos.show", props.proyecto.id);
    },
    onError: (errors) => {
      console.log("Errores de validación:", errors);
    },
  });
};
</script>

<template>
  <div class="min-h-screen flex flex-col items-center justify-center px-4 py-10 background-animado">
    
    <div class="max-w-4xl w-full bg-white/10 backdrop-blur-md p-8 rounded-lg shadow-2xl animate-fadeIn border border-white/20">
      
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-white">Editar Proyecto</h1>
        <Link
          :href="route('proyectos.index')"
          class="bg-gradient-to-r from-green-600 to-emerald-500 text-white py-2 px-4 rounded-lg shadow-md hover:shadow-green-400/40 transition-all"
        >
          ← Volver
        </Link>
      </div>

      <form @submit.prevent="submit" class="space-y-6">
        
        <!-- Nombre -->
        <div>
          <label for="nombre_proyecto" class="block text-white font-semibold mb-1">Nombre del Proyecto</label>
          <input
            id="nombre_proyecto"
            v-model="form.nombre_proyecto"
            type="text"
            class="w-full border-white/30 bg-white/5 text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-400"
            required
          />
        </div>

        <!-- Cliente -->
        <div>
          <label for="cliente_id" class="block text-white font-semibold mb-1">Cliente</label>
          <select
            id="cliente_id"
            v-model="form.cliente_id"
            class="w-full border-white/30 bg-white/5 text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            required
          >
            <option value="" class="bg-gray-800 text-white">Seleccione un cliente</option>
            <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id" class="bg-gray-800 text-white">
              {{ cliente.nombre }}
            </option>
          </select>
        </div>

        <!-- Fechas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label for="fecha_inicio" class="block text-white font-semibold mb-1">Fecha de Inicio</label>
            <input
              id="fecha_inicio"
              v-model="form.fecha_inicio"
              type="date"
              class="w-full border-white/30 bg-white/5 text-white rounded-md focus:ring-indigo-500 focus:border-indigo-500"
            />
          </div>

          <div>
            <label for="fecha_fin" class="block text-white font-semibold mb-1">Fecha de Fin</label>
            <input
              id="fecha_fin"
              v-model="form.fecha_fin"
              type="date"
              class="w-full border-white/30 bg-white/5 text-white rounded-md focus:ring-indigo-500 focus:border-indigo-500"
            />
          </div>
        </div>

        <!-- Presupuesto -->
        <div>
          <label for="presupuesto" class="block text-white font-semibold mb-1">Presupuesto (S/)</label>
          <input
            id="presupuesto"
            v-model="form.presupuesto"
            type="number"
            step="0.01"
            min="0"
            class="w-full border-white/30 bg-white/5 text-white rounded-md focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-400"
            placeholder="Ejemplo: 15000.00"
          />
        </div>

        <!-- Descripción -->
        <div>
          <label for="descripcion" class="block text-white font-semibold mb-1">Descripción</label>
          <textarea
            id="descripcion"
            v-model="form.descripcion"
            rows="3"
            class="w-full border-white/30 bg-white/5 text-white rounded-md focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-400"
          ></textarea>
        </div>

        <!-- Avance -->
        <div>
          <label for="avance" class="block text-white font-semibold mb-1">Progreso (%)</label>
          <input
            id="avance"
            v-model.number="form.avance"
            type="number"
            min="0"
            max="100"
            class="w-full border-white/30 bg-white/5 text-white rounded-md focus:ring-indigo-500 focus:border-indigo-500"
          />
        </div>

        <!-- Estado -->
        <div>
          <label for="estado" class="block text-white font-semibold mb-1">Estado</label>
          <select
            id="estado"
            v-model="form.estado"
            class="w-full border-white/30 bg-white/5 text-white rounded-md focus:ring-indigo-500 focus:border-indigo-500"
          >
            <option value="pendiente" class="bg-gray-800 text-white">Pendiente</option>
            <option value="en_progreso" class="bg-gray-800 text-white">En progreso</option>
            <option value="finalizado" class="bg-gray-800 text-white">Finalizado</option>
          </select>
        </div>

        <!-- Botones -->
        <div class="flex justify-end gap-3 pt-4">
          <Link
            :href="route('proyectos.index')"
            class="bg-gray-300 text-gray-800 py-2 px-4 rounded-lg shadow hover:bg-gray-400 transition"
          >
            Cancelar
          </Link>

          <button
            type="submit"
            class="bg-gradient-to-r from-violet-600 to-indigo-500 text-white py-2 px-6 rounded-lg shadow-md hover:shadow-indigo-400/40 transition"
            :disabled="form.processing"
          >
            {{ form.processing ? 'Guardando...' : 'Guardar Cambios' }}
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

@keyframes gradientShift {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

.background-animado {
  background: linear-gradient(-78deg, #4c1b88, #4277BD, #36C9A9, #105293);
  background-size: 400% 400%;
  animation: gradientShift 12s ease infinite;
}
</style>

<style scoped>
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.animate-fadeIn {
  animation: fadeIn 0.8s ease-out;
}
</style>
