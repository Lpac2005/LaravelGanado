<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    bovinos: Array,
});

const form = useForm({
    bovino_id: '',
    tipo: '',
    fecha: new Date().toISOString().slice(0, 10),
    detalle: '',
});

const submit = () => {
    form.post(route('eventos.store'));
};
</script>

<template>
    <Head title="Registrar Evento" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nuevo Evento</h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Contenedor Estilo Reporte de Incidencia/Evento -->
                <div class="bg-white dark:bg-gray-800 border-2 border-gray-400 dark:border-gray-600 shadow-[6px_6px_0px_rgba(0,0,0,0.1)] relative mt-8">
                    
                    <div class="absolute -top-5 left-0 right-0 flex justify-center">
                         <div class="bg-purple-700 dark:bg-purple-600 text-white font-bold uppercase text-sm tracking-widest py-1 px-8 rounded-full border-2 border-white dark:border-gray-800 shadow-md">
                            Reporte de Evento
                        </div>
                    </div>

                    <div class="p-8 pt-10">
                        <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            
                            <!-- Sección Contexto -->
                            <div class="md:col-span-2 border-b-2 border-dashed border-gray-200 dark:border-gray-700 pb-4 mb-2">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">1. Contexto del Evento</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Bovino -->
                                    <div class="md:col-span-2">
                                        <InputLabel for="bovino_id" value="Bovino Involucrado" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <select
                                            id="bovino_id"
                                            v-model="form.bovino_id"
                                            class="mt-1 block w-full !rounded-none !border-2 !border-gray-300 focus:!border-purple-500 !shadow-none bg-white font-bold text-lg"
                                            required
                                        >
                                            <option value="" disabled>Seleccione un bovino...</option>
                                            <option v-for="bovino in bovinos" :key="bovino.id" :value="bovino.id">
                                                {{ bovino.arete }} {{ bovino.nombre ? '- ' + bovino.nombre : '' }}
                                            </option>
                                        </select>
                                        <InputError class="mt-2" :message="form.errors.bovino_id" />
                                    </div>

                                    <!-- Tipo de Evento -->
                                    <div>
                                        <InputLabel for="tipo" value="Clasificación del Evento" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <select
                                            id="tipo"
                                            v-model="form.tipo"
                                            class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-purple-500 !shadow-none font-medium"
                                            required
                                        >
                                            <option value="" disabled>Seleccione...</option>
                                            <option value="Parto">Parto</option>
                                            <option value="Celo">Celo</option>
                                            <option value="Servicio">Servicio (Monta/Inseminación)</option>
                                            <option value="Destete">Destete</option>
                                            <option value="Muerte">Muerte</option>
                                            <option value="Venta">Venta</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                        <InputError class="mt-2" :message="form.errors.tipo" />
                                    </div>

                                    <!-- Fecha -->
                                    <div>
                                        <InputLabel for="fecha" value="Fecha del Suceso" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="fecha"
                                            type="date"
                                            class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-purple-500 !shadow-none font-mono"
                                            v-model="form.fecha"
                                            required
                                        />
                                        <InputError class="mt-2" :message="form.errors.fecha" />
                                    </div>
                                </div>
                            </div>

                            <!-- Sección Detalles -->
                            <div class="md:col-span-2">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">2. Descripción Detallada</h3>
                                <InputLabel for="detalle" value="Detalles / Observaciones" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                <textarea
                                    id="detalle"
                                    v-model="form.detalle"
                                    class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-purple-500 !shadow-none bg-white font-medium italic text-gray-700"
                                    rows="4"
                                    placeholder="Describa el evento, condiciones, resultados, etc..."
                                ></textarea>
                                <InputError class="mt-2" :message="form.errors.detalle" />
                            </div>

                            <div class="flex items-center justify-end mt-8 pt-6 border-t-2 border-gray-100 dark:border-gray-700 md:col-span-2">
                                <Link :href="route('eventos.index')" class="text-gray-500 hover:text-gray-700 underline text-sm mr-4 uppercase tracking-wider font-bold">
                                    Cancelar
                                </Link>
                                <PrimaryButton class="!rounded-none !bg-purple-600 hover:!bg-purple-800 !px-8 !py-3 !text-sm !tracking-widest border-2 border-purple-800 shadow-[4px_4px_0px_rgba(0,0,0,0.2)] active:translate-y-0.5 active:shadow-none transition-all" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Registrar Evento
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
