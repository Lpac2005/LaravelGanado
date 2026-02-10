<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    pesajes: Array,
    filters: Object,
});

const form = useForm({});
const search = ref(props.filters.search || '');

let timeout = null;
watch(search, (value) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        router.get(route('pesajes.index'), { search: value }, {
            preserveState: true,
            replace: true,
        });
    }, 300);
});

const deletePesaje = (id) => {
    if (confirm('¿Estás seguro de que deseas eliminar este registro de peso?')) {
        form.delete(route('pesajes.destroy', id));
    }
};
</script>

<template>
    <Head title="Control de Pesajes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Control de Pesajes</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-4">
                    <div class="w-full max-w-md">
                        <TextInput
                            v-model="search"
                            type="search"
                            placeholder="Buscar por Arete o Nombre..."
                            class="w-full"
                        />
                    </div>
                    <Link
                        :href="route('pesajes.create')"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-md transition ease-in-out duration-150"
                    >
                        + Registrar Peso
                    </Link>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Fecha</th>
                                    <th scope="col" class="px-6 py-3">Bovino (Arete)</th>
                                    <th scope="col" class="px-6 py-3">Peso (kg)</th>
                                    <th scope="col" class="px-6 py-3">Notas</th>
                                    <th scope="col" class="px-6 py-3 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="pesaje in pesajes" :key="pesaje.id" class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ pesaje.fecha }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-800">
                                        {{ pesaje.bovino ? pesaje.bovino.arete : 'Eliminado' }}
                                        <span v-if="pesaje.bovino && pesaje.bovino.nombre" class="text-gray-500 font-normal">
                                            ({{ pesaje.bovino.nombre }})
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-blue-600 font-semibold">
                                        {{ pesaje.peso }} kg
                                    </td>
                                    <td class="px-6 py-4 italic text-gray-400">
                                        {{ pesaje.notas || '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <Link
                                            :href="route('pesajes.edit', pesaje.id)"
                                            class="text-indigo-600 hover:text-indigo-900 font-medium"
                                        >
                                            Editar
                                        </Link>
                                        <button
                                            @click="deletePesaje(pesaje.id)"
                                            class="text-red-600 hover:text-red-900 font-medium"
                                        >
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="pesajes.length === 0">
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        No hay registros de peso.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
