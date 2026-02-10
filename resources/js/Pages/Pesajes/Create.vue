<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    bovinos: Array,
});

const form = useForm({
    bovino_id: '',
    fecha: new Date().toISOString().slice(0, 10), // Fecha actual por defecto
    peso: '',
    notas: '',
});

const submit = () => {
    form.post(route('pesajes.store'));
};
</script>

<template>
    <Head title="Registrar Pesaje" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nuevo Registro de Peso</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Selección de Bovino -->
                            <div class="md:col-span-2">
                                <InputLabel for="bovino_id" value="Seleccionar Bovino (Arete - Nombre)" />
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
                                <p v-if="bovinos.length === 0" class="text-sm text-red-500 mt-1">
                                    No hay bovinos registrados. <Link :href="route('bovinos.create')" class="underline">Crear uno primero.</Link>
                                </p>
                            </div>

                            <!-- Fecha -->
                            <div>
                                <InputLabel for="fecha" value="Fecha del Pesaje" />
                                <TextInput
                                    id="fecha"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.fecha"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.fecha" />
                            </div>

                            <!-- Peso -->
                            <div>
                                <InputLabel for="peso" value="Peso (kg)" />
                                <TextInput
                                    id="peso"
                                    type="number"
                                    step="0.01"
                                    class="mt-1 block w-full"
                                    v-model="form.peso"
                                    required
                                    min="0"
                                    placeholder="Ej. 350.5"
                                />
                                <InputError class="mt-2" :message="form.errors.peso" />
                            </div>

                            <!-- Notas -->
                            <div class="md:col-span-2">
                                <InputLabel for="notas" value="Notas / Observaciones (Opcional)" />
                                <textarea
                                    id="notas"
                                    v-model="form.notas"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    rows="3"
                                ></textarea>
                                <InputError class="mt-2" :message="form.errors.notas" />
                            </div>

                            <div class="flex items-center justify-end mt-4 md:col-span-2">
                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Guardar Pesaje
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
