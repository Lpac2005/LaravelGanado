<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    sanidad: Object,
    bovinos: Array,
});

const form = useForm({
    bovino_id: props.sanidad.bovino_id,
    tipo: props.sanidad.tipo,
    producto: props.sanidad.producto,
    fecha_aplicacion: props.sanidad.fecha_aplicacion,
    proxima_dosis: props.sanidad.proxima_dosis,
    costo: props.sanidad.costo,
    notas: props.sanidad.notas,
});

const submit = () => {
    form.put(route('sanidads.update', props.sanidad.id));
};
</script>

<template>
    <Head title="Editar Sanidad" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Registro Sanitario</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Bovino (No Editable) -->
                            <div class="md:col-span-2">
                                <InputLabel for="bovino_id" value="Bovino" />
                                <div class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3 text-gray-500">
                                    {{ bovinos.find(b => b.id == form.bovino_id)?.arete || 'Bovino' }}
                                    {{ bovinos.find(b => b.id == form.bovino_id)?.nombre ? '- ' + bovinos.find(b => b.id == form.bovino_id).nombre : '' }}
                                </div>
                                <input type="hidden" v-model="form.bovino_id" />
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
