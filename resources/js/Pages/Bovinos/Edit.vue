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
            <h2 class="font-black text-2xl text-gray-800 dark:text-white uppercase tracking-tighter italic">Editar Ficha de Registro: {{ bovino.arete }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <!-- Contenedor Estilo Ficha de Identificación -->
                <div class="bg-white dark:bg-gray-800 border-2 border-gray-400 dark:border-gray-600 shadow-[6px_6px_0px_rgba(0,0,0,0.1)] relative mt-8">
                    <!-- Etiqueta Superior -->
                    <div class="absolute -top-5 left-0 right-0 flex justify-center">
                         <div class="bg-blue-700 dark:bg-blue-600 text-white font-bold uppercase text-sm tracking-widest py-1 px-8 rounded-full border-2 border-white dark:border-gray-800 shadow-md">
                            Ficha de Identificación
                        </div>
                    </div>

                    <div class="p-8 pt-10">
                        <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Sección Datos Identidad -->
                            <div class="md:col-span-2 border-b-2 border-dashed border-gray-100 dark:border-gray-700 pb-4 mb-2">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">1. Identidad del Animal</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Arete -->
                                    <div>
                                        <InputLabel for="arete" value="Arete (Identificador)" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="arete"
                                            type="text"
                                            class="mt-1 block w-full !rounded-none !border-2 !border-gray-300 focus:!border-blue-500 !shadow-none font-bold text-lg"
                                            v-model="form.arete"
                                            required
                                            autofocus
                                        />
                                        <InputError class="mt-2" :message="form.errors.arete" />
                                    </div>

                                    <!-- Nombre -->
                                    <div>
                                        <InputLabel for="nombre" value="Nombre (Alias)" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="nombre"
                                            type="text"
                                            class="mt-1 block w-full !rounded-none !border-2 !border-gray-300 focus:!border-blue-500 !shadow-none font-bold text-lg"
                                            v-model="form.nombre"
                                        />
                                        <InputError class="mt-2" :message="form.errors.nombre" />
                                    </div>
                                </div>
                            </div>

                            <!-- Sección Características -->
                            <div class="md:col-span-2 border-b-2 border-dashed border-gray-100 dark:border-gray-700 pb-4 mb-2">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">2. Características Técnicas</h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <!-- Raza -->
                                    <div>
                                        <InputLabel for="raza" value="Raza" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="raza"
                                            type="text"
                                            class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-blue-500 !shadow-none"
                                            v-model="form.raza"
                                            required
                                        />
                                        <InputError class="mt-2" :message="form.errors.raza" />
                                    </div>

                                    <!-- Sexo -->
                                    <div>
                                        <InputLabel for="sexo" value="Sexo" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <select
                                            id="sexo"
                                            v-model="form.sexo"
                                            class="mt-1 block w-full !rounded-none !border-2 !border-gray-300 focus:!border-blue-500 !shadow-none bg-white font-bold"
                                            required
                                        >
                                            <option value="" disabled>Seleccione...</option>
                                            <option value="Macho">Macho</option>
                                            <option value="Hembra">Hembra</option>
                                        </select>
                                        <InputError class="mt-2" :message="form.errors.sexo" />
                                    </div>

                                    <!-- Peso Nacimiento -->
                                    <div>
                                        <InputLabel for="peso_nacimiento" value="Peso Nacer (kg)" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="peso_nacimiento"
                                            type="number"
                                            step="0.01"
                                            class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-blue-500 !shadow-none font-mono"
                                            v-model="form.peso_nacimiento"
                                            min="0"
                                        />
                                        <InputError class="mt-2" :message="form.errors.peso_nacimiento" />
                                    </div>
                                </div>
                            </div>

                            <!-- Fecha Nacimiento -->
                            <div class="md:col-span-2">
                                <InputLabel for="fecha_nacimiento" value="Fecha de Nacimiento" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                <TextInput
                                    id="fecha_nacimiento"
                                    type="date"
                                    class="mt-1 block w-64 !rounded-none !border-gray-300 focus:!border-blue-500 !shadow-none font-bold"
                                    v-model="form.fecha_nacimiento"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.fecha_nacimiento" />
                            </div>

                            <!-- Botones -->
                            <div class="flex items-center justify-end mt-8 pt-6 border-t-2 border-gray-100 dark:border-gray-700 md:col-span-2">
                                <Link :href="route('bovinos.index')" class="text-gray-500 hover:text-gray-700 underline text-sm mr-4 uppercase tracking-wider font-bold">
                                    Cancelar
                                </Link>
                                <PrimaryButton class="!rounded-none !bg-blue-600 hover:!bg-blue-800 !px-8 !py-3 !text-sm !tracking-widest border-2 border-blue-800 shadow-[4px_4px_0px_rgba(0,0,0,0.2)] active:translate-y-0.5 active:shadow-none transition-all" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Actualizar Ficha
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
