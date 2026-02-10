<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    stats: Object,
});
</script>

<template>
    <Head title="Menú Principal" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Menú Principal</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Tarjetas de Estadísticas -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Bovinos -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">Total Bovinos</div>
                        <div class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ stats.bovinos }}</div>
                        <div class="mt-4">
                            <Link :href="route('bovinos.index')" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Ver Ganado &rarr;</Link>
                        </div>
                    </div>

                    <!-- Pesajes -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">Registros de Peso</div>
                        <div class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ stats.pesajes }}</div>
                        <div class="mt-4">
                            <Link :href="route('pesajes.index')" class="text-green-600 hover:text-green-800 text-sm font-medium">Ver Pesajes &rarr;</Link>
                        </div>
                    </div>

                    <!-- Sanidad -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-red-500">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">Registros Sanitarios</div>
                        <div class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ stats.sanidad }}</div>
                        <div class="mt-4">
                            <Link :href="route('sanidads.index')" class="text-red-600 hover:text-red-800 text-sm font-medium">Ver Sanidad &rarr;</Link>
                        </div>
                    </div>

                    <!-- Eventos -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-purple-500">
                        <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider">Eventos Registrados</div>
                        <div class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ stats.eventos }}</div>
                        <div class="mt-4">
                            <Link :href="route('eventos.index')" class="text-purple-600 hover:text-purple-800 text-sm font-medium">Ver Calendario &rarr;</Link>
                        </div>
                    </div>
                </div>

                <!-- Accesos Directos Rápidos -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Acciones Rápidas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <Link :href="route('bovinos.create')" class="bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold py-3 px-4 rounded border border-blue-200 text-center transition">
                                + Registrar Nuevo Bovino
                            </Link>
                            <Link :href="route('pesajes.create')" class="bg-green-50 hover:bg-green-100 text-green-700 font-semibold py-3 px-4 rounded border border-green-200 text-center transition">
                                + Nuevo Pesaje
                            </Link>
                            <Link :href="route('sanidads.create')" class="bg-red-50 hover:bg-red-100 text-red-700 font-semibold py-3 px-4 rounded border border-red-200 text-center transition">
                                + Registro Sanitario
                            </Link>
                            <Link :href="route('eventos.create')" class="bg-purple-50 hover:bg-purple-100 text-purple-700 font-semibold py-3 px-4 rounded border border-purple-200 text-center transition">
                                + Nuevo Evento
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
