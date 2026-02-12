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
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Contenedor Estilo Ficha Médica -->
                <div class="bg-white dark:bg-gray-800 border-2 border-gray-400 dark:border-gray-600 shadow-[6px_6px_0px_rgba(0,0,0,0.1)] relative mt-8">
                    
                    <div class="absolute -top-5 left-0 right-0 flex justify-center">
                         <div class="bg-red-600 dark:bg-red-700 text-white font-bold uppercase text-sm tracking-widest py-1 px-8 rounded-full border-2 border-white dark:border-gray-800 shadow-md">
                            Registro Clínico
                        </div>
                    </div>

                    <div class="p-8 pt-10">
                        <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            
                            <!-- Sección Datos Principales -->
                            <div class="md:col-span-2 border-b-2 border-dashed border-gray-200 dark:border-gray-700 pb-4 mb-2">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">1. Datos del Paciente y Evento</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    
                                    <!-- Bovino -->
                                    <div class="md:col-span-2">
                                        <InputLabel for="bovino_id" value="Seleccionar Bovino" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <select
                                            id="bovino_id"
                                            v-model="form.bovino_id"
                                            class="mt-1 block w-full !rounded-none !border-2 !border-gray-300 focus:!border-red-500 !shadow-none bg-white font-bold text-lg"
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
                                        <InputLabel for="tipo" value="Tipo de Aplicación" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <select
                                            id="tipo"
                                            v-model="form.tipo"
                                            class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-red-500 !shadow-none"
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

                                    <!-- Fecha Aplicación -->
                                    <div>
                                        <InputLabel for="fecha_aplicacion" value="Fecha de Aplicación" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="fecha_aplicacion"
                                            type="date"
                                            class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-red-500 !shadow-none font-mono"
                                            v-model="form.fecha_aplicacion"
                                            required
                                        />
                                        <InputError class="mt-2" :message="form.errors.fecha_aplicacion" />
                                    </div>
                                </div>
                            </div>

                            <!-- Sección Detalles del Producto -->
                            <div class="md:col-span-2 border-b-2 border-dashed border-gray-200 dark:border-gray-700 pb-4 mb-2">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">2. Detalle del Tratamiento</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Producto -->
                                    <div class="md:col-span-2">
                                        <InputLabel for="producto" value="Producto / Medicamento" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="producto"
                                            type="text"
                                            class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-red-500 !shadow-none font-bold"
                                            v-model="form.producto"
                                            required
                                            placeholder="Nombre del medicamento"
                                        />
                                        <InputError class="mt-2" :message="form.errors.producto" />
                                    </div>

                                    <!-- Próxima Dosis -->
                                    <div>
                                        <InputLabel for="proxima_dosis" value="Próxima Dosis (Agenda)" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="proxima_dosis"
                                            type="date"
                                            class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-red-500 !shadow-none font-mono text-orange-600"
                                            v-model="form.proxima_dosis"
                                            :min="form.fecha_aplicacion"
                                        />
                                        <InputError class="mt-2" :message="form.errors.proxima_dosis" />
                                    </div>

                                    <!-- Costo -->
                                    <div>
                                        <InputLabel for="costo" value="Costo Estimado" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <div class="relative mt-1 rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">$</span>
                                            </div>
                                            <TextInput
                                                id="costo"
                                                type="number"
                                                step="0.01"
                                                class="block w-full !rounded-none !border-gray-300 focus:!border-red-500 !shadow-none pl-7 font-mono"
                                                v-model="form.costo"
                                                min="0"
                                                placeholder="0.00"
                                            />
                                        </div>
                                        <InputError class="mt-2" :message="form.errors.costo" />
                                    </div>
                                </div>
                            </div>

                            <!-- Notas -->
                            <div class="md:col-span-2">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">3. Notas Clínicas</h3>
                                <InputLabel for="notas" value="Observaciones / Reacciones" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                <textarea
                                    id="notas"
                                    v-model="form.notas"
                                    class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-red-500 !shadow-none bg-white font-medium italic text-gray-700 font-mono"
                                    rows="3"
                                ></textarea>
                                <InputError class="mt-2" :message="form.errors.notas" />
                            </div>

                            <div class="flex items-center justify-end mt-8 pt-6 border-t-2 border-gray-100 dark:border-gray-700 md:col-span-2">
                                <Link :href="route('sanidads.index')" class="text-gray-500 hover:text-gray-700 underline text-sm mr-4 uppercase tracking-wider font-bold">
                                    Cancelar
                                </Link>
                                <PrimaryButton class="!rounded-none !bg-red-600 hover:!bg-red-800 !px-8 !py-3 !text-sm !tracking-widest border-2 border-red-800 shadow-[4px_4px_0px_rgba(0,0,0,0.2)] active:translate-y-0.5 active:shadow-none transition-all" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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
