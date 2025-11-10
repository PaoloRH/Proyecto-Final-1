<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Bienvenido" />

  <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-900">
    <h1 class="text-3xl font-bold dark:text-white mb-4">¡Bienvenido a Expo2!</h1>
    <p class="text-gray-700 dark:text-gray-200 mb-6">
      Has iniciado sesión exitosamente.
    </p>

    <Link
      :href="route('profile.edit')"
      class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
    >
      Editar Perfil
    </Link>
  </div>
</template>
