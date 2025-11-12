<script setup>
import { Link, useForm } from '@inertiajs/vue3'

const props = defineProps({
  cliente: Object
})

const form = useForm({
  nombre: props.cliente.nombre,
  correo: props.cliente.correo,
  telefono: props.cliente.telefono,
  direccion: props.cliente.direccion
})

const submit = () => {
  form.put(`/clientes/${props.cliente.id}`)
}
</script>

<template>
  <div class="container min-h-screen flex flex-col items-center justify-center px-4 py-10 text-white">
    <!-- Encabezado -->
    <header
      class="flex items-center justify-between w-full max-w-4xl px-6 py-4 bg-white/10 backdrop-blur-lg border-b border-white/20 shadow-md rounded-t-2xl"
    >
      <h1 class="text-2xl font-extrabold tracking-wide text-yellow-300 drop-shadow-lg">
        ✏️ Editar Cliente
      </h1>

      <Link
        href="/clientes"
        class="bg-gradient-to-r from-violet-600 to-indigo-500 hover:from-indigo-500 hover:to-violet-600 text-white font-semibold px-5 py-2 rounded-xl shadow-md hover:shadow-violet-400/40 transition-all duration-200 flex items-center gap-2"
      >
        ⬅ Volver
      </Link>
    </header>

    <!-- Formulario -->
    <main
      class="bg-white/10 backdrop-blur-xl p-10 rounded-3xl shadow-2xl border border-white/20 w-[90%] md:w-[500px] mt-10 animate-fadeIn"
    >
      <h2 class="text-3xl font-bold text-center mb-8 text-yellow-300 drop-shadow-md">
        🧾 Editar Información
      </h2>

      <form @submit.prevent="submit" class="space-y-6">
        <!-- Nombre -->
        <div>
          <label class="block text-white/90 text-sm font-semibold mb-2">Nombre</label>
          <input
            v-model="form.nombre"
            type="text"
            autocomplete="off"
            class="w-full px-3 py-2 rounded-lg bg-white/10 border border-white/30 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-violet-500"
          />
        </div>

        <!-- Correo -->
        <div>
          <label class="block text-white/90 text-sm font-semibold mb-2">Correo</label>
          <input
            v-model="form.correo"
            type="email"
            autocomplete="off"
            class="w-full px-3 py-2 rounded-lg bg-white/10 border border-white/30 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-violet-500"
          />
        </div>

        <!-- Teléfono -->
        <div>
          <label class="block text-white/90 text-sm font-semibold mb-2">Teléfono</label>
          <input
            v-model="form.telefono"
            type="text"
            autocomplete="off"
            class="w-full px-3 py-2 rounded-lg bg-white/10 border border-white/30 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-violet-500"
          />
        </div>

        <!-- Dirección -->
        <div>
          <label class="block text-white/90 text-sm font-semibold mb-2">Dirección</label>
          <input
            v-model="form.direccion"
            type="text"
            autocomplete="off"
            class="w-full px-3 py-2 rounded-lg bg-white/10 border border-white/30 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-violet-500"
          />
        </div>

        <!-- Botón -->
        <div class="flex justify-center mt-8">
          <button
            type="submit"
            class="bg-gradient-to-r from-yellow-500 to-orange-400 hover:from-orange-500 hover:to-yellow-500 text-white font-bold py-3 px-8 rounded-xl shadow-md hover:shadow-yellow-400/40 transition-all duration-200 transform hover:-translate-y-1"
          >
            💾 Actualizar
          </button>
        </div>
      </form>
    </main>
  </div>
</template>

<style scoped>
html,
body {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  overflow-x: hidden; /* 👈 evita espacio blanco lateral */
}

.container {
  min-width: 100vw;
  min-height: 100vh;
  background: linear-gradient(-78deg, #4c1b88, #4277BD, #3A9181, #105293);
  background-size: 400% 400%;
  animation: gradientShift 12s ease infinite;
  display: flex;
  flex-direction: column;
  align-items: center;
}

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