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
    producto: '',
    fecha_aplicacion: new Date().toISOString().slice(0, 10),
    proxima_dosis: '',
    costo: '',
    notas: '',
});

const submit = () => {
    form.post(route('sanidads.store'));
};
</script>

<template>
    <Head title="Registrar Sanidad" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nuevo Registro Sanitario</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Bovino -->
                            <div class="md:col-span-2">
                                <InputLabel for="bovino_id" value="Seleccionar Bovino" />
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

                            <!-- Tipo -->
                            <div>
                                <InputLabel for="tipo" value="Tipo de Aplicación" />
                                <select
                                    id="tipo"
                                    v-model="form.tipo"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="" disabled>Seleccione...</option>
                                    <option value="Vacuna">Vacuna</option>
                                    <option value="Desparasitación">Desparasitación</option>
                                    <option value="Vitamina">Vitamina</option>
                                    <option value="Antibiótico">Antibiótico</option>
                                    <option value="Tratamiento">Tratamiento</option>
                                    <option value="Examen">Examen</option>
                                    <option value="Otro">Otro</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.tipo" />
                            </div>

                            <!-- Producto -->
                            <div>
                                <InputLabel for="producto" value="Producto / Medicamento" />
                                <TextInput
                                    id="producto"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.producto"
                                    required
                                    placeholder="Nombre del medicamento"
                                />
                                <InputError class="mt-2" :message="form.errors.producto" />
                            </div>

                            <!-- Fecha Aplicación -->
                            <div>
                                <InputLabel for="fecha_aplicacion" value="Fecha de Aplicación" />
                                <TextInput
                                    id="fecha_aplicacion"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.fecha_aplicacion"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.fecha_aplicacion" />
                            </div>

                            <!-- Próxima Dosis -->
                            <div>
                                <InputLabel for="proxima_dosis" value="Próxima Dosis (Opcional)" />
                                <TextInput
                                    id="proxima_dosis"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.proxima_dosis"
                                    :min="form.fecha_aplicacion"
                                />
                                <InputError class="mt-2" :message="form.errors.proxima_dosis" />
                            </div>

                            <!-- Costo -->
                            <div>
                                <InputLabel for="costo" value="Costo (Opcional)" />
                                <TextInput
                                    id="costo"
                                    type="number"
                                    step="0.01"
                                    class="mt-1 block w-full"
                                    v-model="form.costo"
                                    min="0"
                                    placeholder="0.00"
                                />
                                <InputError class="mt-2" :message="form.errors.costo" />
                            </div>

                            <!-- Notas -->
                            <div class="md:col-span-2">
                                <InputLabel for="notas" value="Notas Adicionales" />
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
                                    Registrar Aplicación
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
