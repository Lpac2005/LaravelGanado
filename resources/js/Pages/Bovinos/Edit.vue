<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
    bovino: Object,
});

const form = useForm({
    arete: props.bovino.arete,
    nombre: props.bovino.nombre,
    fecha_nacimiento: props.bovino.fecha_nacimiento,
    raza: props.bovino.raza,
    sexo: props.bovino.sexo,
    peso_nacimiento: props.bovino.peso_nacimiento,
});

const submit = () => {
    form.put(route('bovinos.update', props.bovino.id));
};
</script>

<template>
    <Head title="Editar Bovino" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Bovino: {{ bovino.arete }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Arete -->
                            <div>
                                <InputLabel for="arete" value="Arete (Identificador)" />
                                <TextInput
                                    id="arete"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.arete"
                                    required
                                    autofocus
                                    autocomplete="off"
                                />
                                <InputError class="mt-2" :message="form.errors.arete" />
                            </div>

                            <!-- Nombre -->
                            <div>
                                <InputLabel for="nombre" value="Nombre (Opcional)" />
                                <TextInput
                                    id="nombre"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.nombre"
                                    autocomplete="off"
                                />
                                <InputError class="mt-2" :message="form.errors.nombre" />
                            </div>

                            <!-- Raza -->
                            <div>
                                <InputLabel for="raza" value="Raza" />
                                <TextInput
                                    id="raza"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.raza"
                                    required
                                    autocomplete="off"
                                />
                                <InputError class="mt-2" :message="form.errors.raza" />
                            </div>

                            <!-- Sexo -->
                            <div>
                                <InputLabel for="sexo" value="Sexo" />
                                <select
                                    id="sexo"
                                    v-model="form.sexo"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="" disabled>Seleccione una opción</option>
                                    <option value="Macho">Macho</option>
                                    <option value="Hembra">Hembra</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.sexo" />
                            </div>

                            <!-- Fecha Nacimiento -->
                            <div>
                                <InputLabel for="fecha_nacimiento" value="Fecha de Nacimiento" />
                                <TextInput
                                    id="fecha_nacimiento"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.fecha_nacimiento"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.fecha_nacimiento" />
                            </div>

                            <!-- Peso Nacimiento -->
                            <div>
                                <InputLabel for="peso_nacimiento" value="Peso al Nacer (kg) (Opcional)" />
                                <TextInput
                                    id="peso_nacimiento"
                                    type="number"
                                    step="0.01"
                                    class="mt-1 block w-full"
                                    v-model="form.peso_nacimiento"
                                    min="0"
                                />
                                <InputError class="mt-2" :message="form.errors.peso_nacimiento" />
                            </div>

                            <div class="flex items-center justify-end mt-4 md:col-span-2">
                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Actualizar
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
