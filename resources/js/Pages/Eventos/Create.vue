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
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Bovino -->
                            <div class="md:col-span-2">
                                <InputLabel for="bovino_id" value="Bovino Involucrado" />
                                <select
                                    id="bovino_id"
                                    v-model="form.bovino_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
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
                                <InputLabel for="tipo" value="Tipo de Evento" />
                                <select
                                    id="tipo"
                                    v-model="form.tipo"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
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
                                <InputLabel for="fecha" value="Fecha del Evento" />
                                <TextInput
                                    id="fecha"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.fecha"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.fecha" />
                            </div>

                            <!-- Detalles -->
                            <div class="md:col-span-2">
                                <InputLabel for="detalle" value="Detalles / Observaciones" />
                                <textarea
                                    id="detalle"
                                    v-model="form.detalle"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    rows="3"
                                    placeholder="Ej. Parto difícil, Cría macho viva..."
                                ></textarea>
                                <InputError class="mt-2" :message="form.errors.detalle" />
                            </div>

                            <div class="flex items-center justify-end mt-4 md:col-span-2">
                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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
