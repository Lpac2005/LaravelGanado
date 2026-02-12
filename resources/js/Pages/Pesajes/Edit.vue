<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    pesaje: Object,
    bovinos: Array,
});

const form = useForm({
    bovino_id: props.pesaje.bovino_id,
    fecha: props.pesaje.fecha,
    peso: props.pesaje.peso,
    notas: props.pesaje.notas,
});

const submit = () => {
    form.put(route('pesajes.update', props.pesaje.id));
};
</script>

<template>
    <Head title="Editar Pesaje" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-black text-2xl text-gray-800 dark:text-white uppercase tracking-tighter italic">Editar Registro de Control de Peso</h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <!-- Contenedor Estilo Ficha de Control -->
                <div class="bg-white dark:bg-gray-800 border-2 border-gray-400 dark:border-gray-600 shadow-[6px_6px_0px_rgba(0,0,0,0.1)] relative mt-8">
                    <div class="absolute -top-5 left-0 right-0 flex justify-center">
                         <div class="bg-emerald-700 dark:bg-emerald-600 text-white font-bold uppercase text-sm tracking-widest py-1 px-8 rounded-full border-2 border-white dark:border-gray-800 shadow-md">
                            Control de Pesaje
                        </div>
                    </div>

                    <div class="p-8 pt-10">
                        <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Sección Datos Principales -->
                            <div class="md:col-span-2 border-b-2 border-dashed border-gray-200 dark:border-gray-700 pb-4 mb-2">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">1. Datos del Registro</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Selección de Bovino -->
                                    <div class="md:col-span-2">
                                        <InputLabel for="bovino_id" value="Identidad del Animal (Solo Lectura)" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <div class="mt-1 block w-full !rounded-none !border-2 !border-gray-200 bg-gray-50 py-3 px-4 font-black text-xl text-gray-600 italic">
                                            {{ bovinos.find(b => b.id == form.bovino_id)?.arete }} 
                                            {{ bovinos.find(b => b.id == form.bovino_id)?.nombre ? '- ' + bovinos.find(b => b.id == form.bovino_id).nombre : '' }}
                                        </div>
                                        <input type="hidden" v-model="form.bovino_id" />
                                    </div>

                                    <!-- Fecha -->
                                    <div>
                                        <InputLabel for="fecha" value="Fecha del Pesaje" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="fecha"
                                            type="date"
                                            class="mt-1 block w-full !rounded-none !border-2 !border-gray-300 focus:!border-emerald-500 !shadow-none font-bold"
                                            v-model="form.fecha"
                                            required
                                        />
                                        <InputError class="mt-2" :message="form.errors.fecha" />
                                    </div>

                                    <!-- Peso -->
                                    <div>
                                        <InputLabel for="peso" value="Peso Registrado (kg)" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="peso"
                                            type="number"
                                            step="0.01"
                                            class="mt-1 block w-full !rounded-none !border-2 !border-gray-300 focus:!border-emerald-500 !shadow-none font-mono text-2xl font-black text-emerald-700"
                                            v-model="form.peso"
                                            required
                                            min="0"
                                        />
                                        <InputError class="mt-2" :message="form.errors.peso" />
                                    </div>
                                </div>
                            </div>

                            <!-- Sección Notas -->
                            <div class="md:col-span-2">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">2. Observaciones Adicionales</h3>
                                <div class="bg-white border-2 border-gray-100 p-4">
                                    <InputLabel for="notas" value="Comentarios Técnicos" class="!text-[10px] !uppercase !tracking-widest !text-gray-400 mb-1" />
                                    <textarea
                                        id="notas"
                                        v-model="form.notas"
                                        class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-emerald-500 !shadow-none bg-white font-medium italic text-gray-700"
                                        rows="4"
                                        placeholder="Ingrese detalles técnicos sobre la condición corporal o el pesaje..."
                                    ></textarea>
                                    <InputError class="mt-2" :message="form.errors.notas" />
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-8 pt-6 border-t-2 border-gray-100 dark:border-gray-700 md:col-span-2">
                                <Link :href="route('pesajes.index')" class="text-gray-500 hover:text-gray-700 underline text-sm mr-4 uppercase tracking-wider font-bold">
                                    Cancelar
                                </Link>
                                <PrimaryButton class="!rounded-none !bg-emerald-600 hover:!bg-emerald-800 !px-8 !py-3 !text-sm !tracking-widest border-2 border-emerald-800 shadow-[4px_4px_0px_rgba(0,0,0,0.2)] active:translate-y-0.5 active:shadow-none transition-all" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Actualizar Registro
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
