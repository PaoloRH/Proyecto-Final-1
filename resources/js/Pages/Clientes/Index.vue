<script setup>
import { Link, router } from '@inertiajs/vue3'

// Recibimos la lista de clientes desde el backend
const props = defineProps({
  clientes: Array
})

// 🔒 Cerrar sesión
const logout = () => {
  router.post('/logout')
}
</script>

<template>
  <div class="container min-h-screen flex flex-col items-center px-6 py-10 text-white">
    <!-- Encabezado -->
    <header
      class="flex items-center justify-between w-full max-w-6xl px-6 py-4 bg-white/10 backdrop-blur-lg border-b border-white/20 shadow-md rounded-t-2xl"
    >
      <h1 class="text-3xl font-extrabold tracking-wide text-yellow-300 drop-shadow-lg">
        ⚙️ Listado de Clientes
      </h1>

      <div class="flex items-center gap-3">
        <!-- 📄 Exportar todos los clientes -->
        <a
          href="/pdf/clientes"
          target="_blank"
          class="bg-gradient-to-r from-green-600 to-emerald-500 hover:from-emerald-500 hover:to-green-600 text-white font-semibold px-5 py-2 rounded-xl shadow-md hover:shadow-green-400/40 transition-all duration-200 flex items-center gap-2"
        >
          🧾 Exportar PDF (Todos)
        </a>

        <!-- Enlace a Proyectos -->
        <Link
          :href="route('proyectos.index')"
          class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-blue-600 hover:to-sky-500 text-white font-semibold px-5 py-2 rounded-xl shadow-md hover:shadow-blue-400/40 transition-all duration-200 flex items-center gap-2"
        >
          🖥️ Ver Proyectos
        </Link>

        <!-- Nuevo Cliente -->
        <Link
          href="/clientes/create"
          class="bg-gradient-to-r from-violet-600 to-indigo-500 hover:from-indigo-500 hover:to-violet-600 text-white font-semibold px-5 py-2 rounded-xl shadow-md hover:shadow-violet-400/40 transition-all duration-200 flex items-center gap-2"
        >
          ➕ Nuevo Cliente
        </Link>

        <!-- 🔒 Cerrar sesión -->
        <form @submit.prevent="logout" class="inline">
          <button
            type="submit"
            class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold px-5 py-2 rounded-xl shadow-md hover:shadow-red-400/40 transition-all duration-200 flex items-center gap-2"
          >
            🚪 Cerrar sesión
          </button>
        </form>
      </div>
    </header>

    <!-- Tabla de clientes -->
    <main class="w-full max-w-6xl mt-8 bg-white/10 backdrop-blur-xl p-8 rounded-3xl shadow-2xl border border-white/20 animate-fadeIn">
      <table class="w-full text-sm text-left border-collapse">
        <thead class="text-yellow-300 uppercase border-b border-white/30 text-sm">
          <tr>
            <th class="px-4 py-3">#</th>
            <th class="px-4 py-3">Nombre</th>
            <th class="px-4 py-3">Correo</th>
            <th class="px-4 py-3">Teléfono</th>
            <th class="px-4 py-3">Dirección</th>
            <th class="px-4 py-3 text-center">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(cli, index) in props.clientes"
            :key="cli.id"
            class="border-b border-white/10 hover:bg-white/10 transition-colors"
          >
            <td class="px-4 py-3 text-gray-300">{{ index + 1 }}</td>
            <td class="px-4 py-3">{{ cli.nombre }}</td>
            <td class="px-4 py-3">{{ cli.correo || '–' }}</td>
            <td class="px-4 py-3">{{ cli.telefono || '–' }}</td>
            <td class="px-4 py-3">{{ cli.direccion || '–' }}</td>

            <td class="px-4 py-3 text-center flex justify-center flex-wrap gap-2">
              <!-- ✏️ Editar -->
              <Link
                :href="`/clientes/edit/${cli.id}`"
                class="bg-gradient-to-r from-yellow-500 to-orange-400 hover:from-orange-500 hover:to-yellow-500 text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:shadow-yellow-400/40 transition-all"
              >
                ✏️ Editar
              </Link>

              <!-- 🗑️ Eliminar -->
              <Link
                :href="`/clientes/delete/${cli.id}`"
                class="bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:shadow-red-400/40 transition-all"
              >
                🗑️ Eliminar
              </Link>

              <!-- 🖥️ Ver proyectos -->
              <Link
                :href="route('proyectos.index', { cliente_id: cli.id })"
                class="bg-gradient-to-r from-sky-600 to-cyan-500 hover:from-cyan-500 hover:to-sky-600 text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:shadow-cyan-400/40 transition-all"
              >
                🖥️ Ver Proyectos
              </Link>

              <!-- 🧾 Exportar PDF individual -->
              <a
                :href="`/pdf/clientes/${cli.id}`"
                target="_blank"
                class="bg-gradient-to-r from-green-600 to-lime-500 hover:from-lime-500 hover:to-green-600 text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:shadow-green-400/40 transition-all"
              >
                📑 PDF
              </a>
            </td>
          </tr>
        </tbody>
      </table>

      <div v-if="!props.clientes.length" class="text-center text-white/70 mt-6 text-lg">
        No hay clientes registrados aún 😔
      </div>
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

.container {
  background: linear-gradient( -78deg, #4c1b88, #4277BD, #3A9181, #105293);
  background-size: 400% 400%;
  animation: gradientShift 12s ease infinite;
}

.animate-fadeIn {
  animation: fadeIn 0.8s ease-out;
}
</style>
