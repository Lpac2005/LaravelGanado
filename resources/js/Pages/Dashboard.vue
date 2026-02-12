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
                
                <!-- Panel de Control Principal -->
                <div class="mb-10">
                    <h3 class="text-xs font-bold text-gray-500 uppercase mb-4 tracking-widest px-1">Resumen General del Hato</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <!-- Bovinos -->
                        <div class="bg-white dark:bg-gray-800 border-2 border-gray-800 dark:border-gray-500 shadow-[4px_4px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_rgba(255,255,255,0.2)] p-4 relative group hover:-translate-y-1 transition-transform">
                            <div class="absolute top-0 right-0 bg-blue-600 text-white text-[10px] uppercase font-bold px-2 py-0.5">Inventario</div>
                            <div class="text-gray-500 dark:text-gray-400 text-xs font-mono uppercase mt-2">Total Bovinos</div>
                            <div class="mt-2 text-4xl font-black text-gray-900 dark:text-white">{{ stats.bovinos }}</div>
                            <div class="mt-4 border-t-2 border-dashed border-gray-300 pt-2">
                                <Link :href="route('bovinos.index')" class="text-blue-700 dark:text-blue-400 hover:underline text-xs font-bold uppercase tracking-wide flex items-center">
                                    Ver Expedientes <span class="ml-1 text-lg leading-none">&raquo;</span>
                                </Link>
                            </div>
                        </div>

                        <!-- Pesajes -->
                        <div class="bg-white dark:bg-gray-800 border-2 border-gray-800 dark:border-gray-500 shadow-[4px_4px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_rgba(255,255,255,0.2)] p-4 relative group hover:-translate-y-1 transition-transform">
                            <div class="absolute top-0 right-0 bg-emerald-600 text-white text-[10px] uppercase font-bold px-2 py-0.5">Control</div>
                            <div class="text-gray-500 dark:text-gray-400 text-xs font-mono uppercase mt-2">Registros Peso</div>
                            <div class="mt-2 text-4xl font-black text-gray-900 dark:text-white">{{ stats.pesajes }}</div>
                            <div class="mt-4 border-t-2 border-dashed border-gray-300 pt-2">
                                <Link :href="route('pesajes.index')" class="text-emerald-700 dark:text-emerald-400 hover:underline text-xs font-bold uppercase tracking-wide flex items-center">
                                    Ver Historial <span class="ml-1 text-lg leading-none">&raquo;</span>
                                </Link>
                            </div>
                        </div>

                        <!-- Sanidad -->
                        <div class="bg-white dark:bg-gray-800 border-2 border-gray-800 dark:border-gray-500 shadow-[4px_4px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_rgba(255,255,255,0.2)] p-4 relative group hover:-translate-y-1 transition-transform">
                            <div class="absolute top-0 right-0 bg-red-600 text-white text-[10px] uppercase font-bold px-2 py-0.5">Sanidad</div>
                            <div class="text-gray-500 dark:text-gray-400 text-xs font-mono uppercase mt-2">Tratamientos</div>
                            <div class="mt-2 text-4xl font-black text-gray-900 dark:text-white">{{ stats.sanidad }}</div>
                            <div class="mt-4 border-t-2 border-dashed border-gray-300 pt-2">
                                <Link :href="route('sanidads.index')" class="text-red-700 dark:text-red-400 hover:underline text-xs font-bold uppercase tracking-wide flex items-center">
                                    Ver Cartillas <span class="ml-1 text-lg leading-none">&raquo;</span>
                                </Link>
                            </div>
                        </div>

                        <!-- Eventos -->
                        <div class="bg-white dark:bg-gray-800 border-2 border-gray-800 dark:border-gray-500 shadow-[4px_4px_0px_rgba(0,0,0,1)] dark:shadow-[4px_4px_0px_rgba(255,255,255,0.2)] p-4 relative group hover:-translate-y-1 transition-transform">
                            <div class="absolute top-0 right-0 bg-purple-600 text-white text-[10px] uppercase font-bold px-2 py-0.5">Agenda</div>
                            <div class="text-gray-500 dark:text-gray-400 text-xs font-mono uppercase mt-2">Eventos</div>
                            <div class="mt-2 text-4xl font-black text-gray-900 dark:text-white">{{ stats.eventos }}</div>
                            <div class="mt-4 border-t-2 border-dashed border-gray-300 pt-2">
                                <Link :href="route('eventos.index')" class="text-purple-700 dark:text-purple-400 hover:underline text-xs font-bold uppercase tracking-wide flex items-center">
                                    Ver Calendario <span class="ml-1 text-lg leading-none">&raquo;</span>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Accesos Directos - Estilo Botonera -->
                <div class="bg-gray-50 dark:bg-gray-800 border-2 border-gray-300 dark:border-gray-600 p-6">
                    <h3 class="text-sm font-bold text-gray-700 dark:text-gray-300 uppercase tracking-widest mb-6 border-b-2 border-gray-200 pb-2">Acciones Rápidas</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <Link :href="route('bovinos.create')" class="flex items-center justify-center py-4 px-4 bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-500 hover:border-blue-500 hover:text-blue-600 dark:hover:text-blue-400 shadow-sm hover:shadow-md transition text-sm font-bold uppercase text-gray-600 dark:text-gray-200">
                            + Registrar Bovino
                        </Link>
                        <Link :href="route('pesajes.create')" class="flex items-center justify-center py-4 px-4 bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-500 hover:border-emerald-500 hover:text-emerald-600 dark:hover:text-emerald-400 shadow-sm hover:shadow-md transition text-sm font-bold uppercase text-gray-600 dark:text-gray-200">
                            + Nuevo Pesaje
                        </Link>
                        <Link :href="route('sanidads.create')" class="flex items-center justify-center py-4 px-4 bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-500 hover:border-red-500 hover:text-red-600 dark:hover:text-red-400 shadow-sm hover:shadow-md transition text-sm font-bold uppercase text-gray-600 dark:text-gray-200">
                            + Registro Sanitario
                        </Link>
                        <Link :href="route('eventos.create')" class="flex items-center justify-center py-4 px-4 bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-500 hover:border-purple-500 hover:text-purple-600 dark:hover:text-purple-400 shadow-sm hover:shadow-md transition text-sm font-bold uppercase text-gray-600 dark:text-gray-200">
                            + Nuevo Evento
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
