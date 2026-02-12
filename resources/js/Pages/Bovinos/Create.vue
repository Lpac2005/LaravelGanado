<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    arete: '',
    nombre: '',
    fecha_nacimiento: '',
    raza: '',
    sexo: '',
    peso_nacimiento: '',
});

const submit = () => {
    form.post(route('bovinos.store'));
};
</script>

<template>
    <Head title="Crear Bovino" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Registrar Nuevo Bovino</h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Contenedor Estilo Ficha de Registro -->
                <div class="bg-white dark:bg-gray-800 border-2 border-gray-400 dark:border-gray-600 shadow-[6px_6px_0px_rgba(0,0,0,0.1)] relative mt-8">
                    
                    <div class="absolute -top-5 left-0 right-0 flex justify-center">
                         <div class="bg-blue-700 dark:bg-blue-600 text-white font-bold uppercase text-sm tracking-widest py-1 px-8 rounded-full border-2 border-white dark:border-gray-800 shadow-md">
                            Formulario de Alta
                        </div>
                    </div>

                    <div class="p-8 pt-10">
                        <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            
                            <!-- Sección Identificación -->
                            <div class="md:col-span-2 border-b-2 border-dashed border-gray-200 dark:border-gray-700 pb-4 mb-2">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">1. Identificación del Animal</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Arete -->
                                    <div>
                                        <InputLabel for="arete" value="Arete (ID Único)" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="arete"
                                            type="text"
                                            class="mt-1 block w-full !rounded-none !border-2 !border-gray-300 focus:!border-blue-500 !shadow-none bg-white font-mono font-bold text-lg"
                                            v-model="form.arete"
                                            required
                                            autofocus
                                            autocomplete="off"
                                            placeholder="Ej. MC-001"
                                        />
                                        <InputError class="mt-2" :message="form.errors.arete" />
                                    </div>

                                    <!-- Nombre -->
                                    <div>
                                        <InputLabel for="nombre" value="Nombre (Alias)" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="nombre"
                                            type="text"
                                            class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-blue-500 !shadow-none"
                                            v-model="form.nombre"
                                            autocomplete="off"
                                            placeholder="Opcional"
                                        />
                                        <InputError class="mt-2" :message="form.errors.nombre" />
                                    </div>
                                </div>
                            </div>

                            <!-- Sección Características -->
                            <div class="md:col-span-2 border-b-2 border-dashed border-gray-200 dark:border-gray-700 pb-4 mb-2">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">2. Características Físicas</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Raza -->
                                    <div>
                                        <InputLabel for="raza" value="Raza Predominante" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="raza"
                                            type="text"
                                            class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-blue-500 !shadow-none"
                                            v-model="form.raza"
                                            required
                                            autocomplete="off"
                                        />
                                        <InputError class="mt-2" :message="form.errors.raza" />
                                    </div>

                                    <!-- Sexo -->
                                    <div>
                                        <InputLabel for="sexo" value="Sexo" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <div class="mt-1 flex gap-4">
                                            <label class="flex-1 cursor-pointer">
                                                <input type="radio" v-model="form.sexo" value="Macho" class="peer sr-only">
                                                <div class="text-center py-2 border-2 border-gray-200 rounded peer-checked:border-blue-500 peer-checked:bg-white peer-checked:text-blue-700 hover:bg-gray-50 font-bold text-sm uppercase transition">
                                                    Macho
                                                </div>
                                            </label>
                                            <label class="flex-1 cursor-pointer">
                                                <input type="radio" v-model="form.sexo" value="Hembra" class="peer sr-only">
                                                <div class="text-center py-2 border-2 border-gray-200 rounded peer-checked:border-pink-500 peer-checked:bg-white peer-checked:text-pink-700 hover:bg-gray-50 font-bold text-sm uppercase transition">
                                                    Hembra
                                                </div>
                                            </label>
                                        </div>
                                        <InputError class="mt-2" :message="form.errors.sexo" />
                                    </div>
                                </div>
                            </div>

                            <!-- Sección Nacimiento -->
                            <div class="md:col-span-2">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">3. Datos de Origen</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Fecha Nacimiento -->
                                    <div>
                                        <InputLabel for="fecha_nacimiento" value="Fecha de Nacimiento" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="fecha_nacimiento"
                                            type="date"
                                            class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-blue-500 !shadow-none font-mono"
                                            v-model="form.fecha_nacimiento"
                                            required
                                        />
                                        <InputError class="mt-2" :message="form.errors.fecha_nacimiento" />
                                    </div>

                                    <!-- Peso Nacimiento -->
                                    <div>
                                        <InputLabel for="peso_nacimiento" value="Peso al Nacer (kg)" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <div class="relative mt-1 rounded-md shadow-sm">
                                            <TextInput
                                                id="peso_nacimiento"
                                                type="number"
                                                step="0.01"
                                                class="block w-full !rounded-none !border-gray-300 focus:!border-blue-500 !shadow-none pr-12 font-mono"
                                                v-model="form.peso_nacimiento"
                                                min="0"
                                                placeholder="0.00"
                                            />
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">kg</span>
                                            </div>
                                        </div>
                                        <InputError class="mt-2" :message="form.errors.peso_nacimiento" />
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-8 pt-6 border-t-2 border-gray-100 dark:border-gray-700 md:col-span-2">
                                <Link :href="route('bovinos.index')" class="text-gray-500 hover:text-gray-700 underline text-sm mr-4 uppercase tracking-wider font-bold">
                                    Cancelar
                                </Link>
                                <PrimaryButton class="!rounded-none !bg-blue-600 hover:!bg-blue-800 !px-8 !py-3 !text-sm !tracking-widest" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Guardar Ficha
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
