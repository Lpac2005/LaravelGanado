<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Perfil de Usuario" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Perfil de Usuario</h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Estilo de Ficha Técnica / Expediente -->
                <div class="bg-white dark:bg-gray-800 border-2 border-gray-400 dark:border-gray-600 shadow-[8px_8px_0px_rgba(0,0,0,0.1)] mb-10 overflow-hidden">
                    
                    <!-- Encabezado De Ficha -->
                    <div class="bg-gray-100 dark:bg-gray-700 border-b-2 border-gray-400 dark:border-gray-600 p-4 flex justify-between items-center select-none">
                        <div class="flex items-center space-x-3">
                            <div class="bg-gray-300 dark:bg-gray-600 w-12 h-12 flex items-center justify-center font-bold text-gray-600 dark:text-gray-400 border border-gray-400">
                                ID
                            </div>
                            <div>
                                <h3 class="text-xs font-bold text-gray-500 uppercase">Documento de Identidad</h3>
                                <p class="text-sm font-bold text-gray-800 dark:text-white">FOLIO: 00{{ $page.props.auth.user.id }} - SISTEMA GANADERO</p>
                            </div>
                        </div>
                        <div class="text-right hidden sm:block">
                            <p class="text-[10px] text-gray-400 uppercase leading-none">Creado el</p>
                            <p class="text-xs font-mono text-gray-600 dark:text-gray-300">{{ new Date($page.props.auth.user.created_at).toLocaleDateString() }}</p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-12 gap-0">
                        <!-- Lado izquierdo: Foto/Info sutil -->
                        <div class="md:col-span-4 bg-gray-50 dark:bg-gray-900/50 p-8 border-r-2 border-gray-200 dark:border-gray-700 flex flex-col items-center">
                            <div class="w-32 h-32 bg-gray-200 dark:bg-gray-800 border-2 border-dashed border-gray-400 flex items-center justify-center text-4xl mb-4 group hover:bg-emerald-50 transition cursor-default">
                                👨‍🌾
                            </div>
                            <div class="text-center">
                                <h4 class="font-bold text-lg text-gray-800 dark:text-white uppercase tracking-tight">{{ $page.props.auth.user.name }}</h4>
                                <p class="text-xs text-emerald-600 font-bold uppercase">{{ $page.props.auth.user.email }}</p>
                            </div>
                            
                            <div class="mt-8 pt-8 border-t border-gray-300 dark:border-gray-600 w-full text-xs text-gray-500 space-y-2">
                                <p><strong>ESTADO:</strong> ACTIVO</p>
                                <p><strong>CARGO:</strong> ADMINISTRADOR DE FINCA</p>
                                <p><strong>ACCESO:</strong> TOTAL AL SISTEMA</p>
                            </div>
                        </div>

                        <!-- Lado derecho: Formularios -->
                        <div class="md:col-span-8 p-8 space-y-12">
                            <div class="relative">
                                <span class="absolute -top-4 -left-2 bg-emerald-700 text-white text-[10px] px-2 py-0.5 font-bold uppercase italic">SECCIÓN A: DATOS</span>
                                <UpdateProfileInformationForm
                                    :must-verify-email="mustVerifyEmail"
                                    :status="status"
                                />
                            </div>

                            <div class="relative pt-6 border-t-2 border-gray-100 dark:border-gray-700">
                                <span class="absolute -top-4 -left-2 bg-blue-700 text-white text-[10px] px-2 py-0.5 font-bold uppercase italic">SECCIÓN B: SEGURIDAD</span>
                                <UpdatePasswordForm />
                            </div>

                            <div class="relative pt-6 border-t-2 border-gray-100 dark:border-gray-700">
                                <span class="absolute -top-4 -left-2 bg-red-700 text-white text-[10px] px-2 py-0.5 font-bold uppercase italic">SECCIÓN C: BAJA</span>
                                <DeleteUserForm />
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
