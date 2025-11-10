<script setup>
import { Link, useForm } from '@inertiajs/vue3'

const props = defineProps({
  cliente: Object
})

const form = useForm({})

const submit = () => {
  if (confirm(`⚠️ ¿Estás seguro de eliminar al cliente ${props.cliente.nombre}?`)) {
    form.delete(`/clientes/${props.cliente.id}`)
  }
}
</script>

<template>
  <div
    class="min-h-screen flex flex-col items-center justify-center px-4 py-10 text-white"
    style="background: linear-gradient(-45deg, #0f172a, #1e1b4b, #3b0764, #450a0a);
           background-size: 400% 400%;
           animation: gradientShift 12s ease infinite;"
  >
    <!-- Encabezado -->
    <header
      class="flex items-center justify-between w-full max-w-4xl px-6 py-4 bg-white/10 backdrop-blur-lg border-b border-white/20 shadow-md rounded-t-2xl"
    >
      <h1 class="text-2xl font-extrabold tracking-wide text-red-400 drop-shadow-lg">
        🗑️ Eliminar Cliente
      </h1>

      <Link
        href="/clientes"
        class="bg-gradient-to-r from-violet-600 to-indigo-500 hover:from-indigo-500 hover:to-violet-600 text-white font-semibold px-5 py-2 rounded-xl shadow-md hover:shadow-violet-400/40 transition-all duration-200 flex items-center gap-2"
      >
        ⬅ Volver
      </Link>
    </header>

    <!-- Contenido principal -->
    <main
      class="bg-white/10 backdrop-blur-xl p-10 rounded-3xl shadow-2xl border border-white/20 w-[90%] md:w-[500px] mt-10 animate-fadeIn"
    >
      <h2 class="text-3xl font-bold text-center mb-8 text-red-400 drop-shadow-md">
        ⚠️ Confirmar eliminación
      </h2>

      <form @submit.prevent="submit" class="space-y-6">
        <!-- Datos del cliente en solo lectura -->
        <div>
          <label class="block text-white/80 text-sm font-semibold mb-1">Nombre</label>
          <input
            type="text"
            :value="props.cliente.nombre"
            disabled
            class="w-full px-3 py-2 rounded-lg bg-white/5 border border-white/20 text-white/80 cursor-not-allowed"
          />
        </div>

        <div>
          <label class="block text-white/80 text-sm font-semibold mb-1">Correo</label>
          <input
            type="email"
            :value="props.cliente.correo"
            disabled
            class="w-full px-3 py-2 rounded-lg bg-white/5 border border-white/20 text-white/80 cursor-not-allowed"
          />
        </div>

        <div>
          <label class="block text-white/80 text-sm font-semibold mb-1">Teléfono</label>
          <input
            type="text"
            :value="props.cliente.telefono"
            disabled
            class="w-full px-3 py-2 rounded-lg bg-white/5 border border-white/20 text-white/80 cursor-not-allowed"
          />
        </div>

        <div>
          <label class="block text-white/80 text-sm font-semibold mb-1">Dirección</label>
          <input
            type="text"
            :value="props.cliente.direccion"
            disabled
            class="w-full px-3 py-2 rounded-lg bg-white/5 border border-white/20 text-white/80 cursor-not-allowed"
          />
        </div>

        <!-- Botón eliminar -->
        <div class="flex justify-center mt-8">
          <button
            type="submit"
            class="bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 text-white font-bold py-3 px-8 rounded-xl shadow-md hover:shadow-red-400/40 transition-all duration-200 transform hover:-translate-y-1"
          >
            🗑️ Eliminar definitivamente
          </button>
        </div>
      </form>
    </main>
  </div>
</template>

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

.animate-fadeIn {
  animation: fadeIn 0.8s ease-out;
}
</style>
