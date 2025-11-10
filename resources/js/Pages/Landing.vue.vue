<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Bienvenida" /> 

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Página de Bienvenida</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-2xl font-bold mb-4">¡Hola, {{ $page.props.auth.user.name }}!</h3>
                        <p>Has iniciado sesión exitosamente. Esta es tu nueva página de bienvenida.</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>