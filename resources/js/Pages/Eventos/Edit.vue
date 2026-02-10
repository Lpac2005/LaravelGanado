<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    evento: Object,
    bovinos: Array,
});

const form = useForm({
    bovino_id: props.evento.bovino_id,
    tipo: props.evento.tipo,
    fecha: props.evento.fecha,
    detalle: props.evento.detalle,
});

const submit = () => {
    form.put(route('eventos.update', props.evento.id));
};
</script>

<template>
    <Head title="Editar Evento" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Evento</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Bovino (No editable para simplificar) -->
                            <div class="md:col-span-2">
                                <InputLabel for="bovino_id" value="Bovino" />
                                <div class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3 text-gray-500">
                                    {{ bovinos.find(b => b.id == form.bovino_id)?.arete || 'Bovino' }} 
                                    {{ bovinos.find(b => b.id == form.bovino_id)?.nombre ? '- ' + bovinos.find(b => b.id == form.bovino_id).nombre : '' }}
                                </div>
                                <input type="hidden" v-model="form.bovino_id" />
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
                                ></textarea>
                                <InputError class="mt-2" :message="form.errors.detalle" />
                            </div>

                            <div class="flex items-center justify-end mt-4 md:col-span-2">
                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Actualizar Evento
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
