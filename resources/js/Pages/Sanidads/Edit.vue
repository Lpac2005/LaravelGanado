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
            <h2 class="font-black text-2xl text-gray-800 dark:text-white uppercase tracking-tighter italic">Editar Registro Clínico</h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <!-- Contenedor Estilo Ficha Médica -->
                <div class="bg-white dark:bg-gray-800 border-2 border-gray-400 dark:border-gray-600 shadow-[6px_6px_0px_rgba(0,0,0,0.1)] relative mt-8">
                    <div class="absolute -top-5 left-0 right-0 flex justify-center">
                         <div class="bg-red-600 dark:bg-red-700 text-white font-bold uppercase text-sm tracking-widest py-1 px-8 rounded-full border-2 border-white dark:border-gray-800 shadow-md">
                            Historial Médico
                        </div>
                    </div>

                    <div class="p-8 pt-10">
                        <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            
                            <!-- Sección Datos del Paciente -->
                            <div class="md:col-span-2 border-b-2 border-dashed border-gray-200 dark:border-gray-700 pb-4 mb-2">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">1. Identidad del Paciente</h3>
                                <div class="mt-1 block w-full !rounded-none !border-2 !border-gray-200 bg-gray-50 py-3 px-4 font-black text-xl text-gray-600 italic">
                                    {{ bovinos.find(b => b.id == form.bovino_id)?.arete }}
                                    {{ bovinos.find(b => b.id == form.bovino_id)?.nombre ? '- ' + bovinos.find(b => b.id == form.bovino_id).nombre : '' }}
                                </div>
                                <input type="hidden" v-model="form.bovino_id" />
                            </div>

                            <!-- Sección Tratamiento -->
                            <div class="md:col-span-2 border-b-2 border-dashed border-gray-200 dark:border-gray-700 pb-4 mb-2">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">2. Detalle del Tratamiento</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <InputLabel for="tipo" value="Categoría de Intervención" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <select
                                            id="tipo"
                                            v-model="form.tipo"
                                            class="mt-1 block w-full !rounded-none !border-2 !border-gray-300 focus:!border-red-500 !shadow-none bg-white font-bold"
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

                                    <div>
                                        <InputLabel for="producto" value="Nombre del Producto" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="producto"
                                            type="text"
                                            class="mt-1 block w-full !rounded-none !border-2 !border-gray-300 focus:!border-red-500 !shadow-none font-bold"
                                            v-model="form.producto"
                                            required
                                        />
                                        <InputError class="mt-2" :message="form.errors.producto" />
                                    </div>
                                </div>
                            </div>

                            <!-- Sección Fechas y Costos -->
                            <div>
                                <InputLabel for="fecha_aplicacion" value="Fecha de Aplicación" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                <TextInput
                                    id="fecha_aplicacion"
                                    type="date"
                                    class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-red-500 !shadow-none"
                                    v-model="form.fecha_aplicacion"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.fecha_aplicacion" />
                            </div>

                            <div>
                                <InputLabel for="proxima_dosis" value="Próxima Citación" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                <TextInput
                                    id="proxima_dosis"
                                    type="date"
                                    class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-red-500 !shadow-none font-bold text-red-600"
                                    v-model="form.proxima_dosis"
                                    :min="form.fecha_aplicacion"
                                />
                                <InputError class="mt-2" :message="form.errors.proxima_dosis" />
                            </div>

                            <div class="md:col-span-2">
                                <InputLabel for="costo" value="Valor de la Intervención ($)" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                <TextInput
                                    id="costo"
                                    type="number"
                                    step="0.01"
                                    class="mt-1 block w-48 !rounded-none !border-gray-300 focus:!border-red-500 !shadow-none font-mono font-bold"
                                    v-model="form.costo"
                                    min="0"
                                />
                                <InputError class="mt-2" :message="form.errors.costo" />
                            </div>

                            <!-- Sección Notas -->
                            <div class="md:col-span-2">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">3. Notas Clínicas</h3>
                                <textarea
                                    id="notas"
                                    v-model="form.notas"
                                    class="mt-1 block w-full !rounded-none !border-2 !border-gray-300 focus:!border-red-500 !shadow-none bg-white font-medium italic text-gray-700"
                                    rows="4"
                                    placeholder="Detalle la reacción, dosis exacta o recomendaciones médicas..."
                                ></textarea>
                                <InputError class="mt-2" :message="form.errors.notas" />
                            </div>

                            <div class="flex items-center justify-end mt-8 pt-6 border-t-2 border-gray-100 dark:border-gray-700 md:col-span-2">
                                <Link :href="route('sanidads.index')" class="text-gray-500 hover:text-gray-700 underline text-sm mr-4 uppercase tracking-wider font-bold">
                                    Cancelar
                                </Link>
                                <PrimaryButton class="!rounded-none !bg-red-600 hover:!bg-red-800 !px-8 !py-3 !text-sm !tracking-widest border-2 border-red-800 shadow-[4px_4px_0px_rgba(0,0,0,0.2)] active:translate-y-0.5 active:shadow-none transition-all" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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
