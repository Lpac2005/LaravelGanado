<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    sanidads: Array,
});

const form = useForm({});

const deleteSanidad = (id) => {
    if (confirm('¿Estás seguro de que deseas eliminar este registro sanitario?')) {
        form.delete(route('sanidads.destroy', id));
    }
};

const formatDate = (dateString) => {
    if (!dateString) return '-';
    // Crear fecha manejando zona horaria local para evitar retraso de un día
    const date = new Date(dateString);
    return new Date(date.valueOf() + date.getTimezoneOffset() * 60000).toLocaleDateString('es-ES');
};
</script>

<template>
    <Head title="Control Sanitario" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Control Sanitario</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end mb-4">
                    <Link
                        :href="route('sanidads.create')"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow-md transition ease-in-out duration-150"
                    >
                        + Nuevo Registro
                    </Link>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Fecha</th>
                                    <th scope="col" class="px-6 py-3">Bovino</th>
                                    <th scope="col" class="px-6 py-3">Tipo</th>
                                    <th scope="col" class="px-6 py-3">Producto</th>
                                    <th scope="col" class="px-6 py-3">Próxima Dosis</th>
                                    <th scope="col" class="px-6 py-3">Costo</th>
                                    <th scope="col" class="px-6 py-3 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in sanidads" :key="item.id" class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        {{ formatDate(item.fecha_aplicacion) }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-800">
                                        {{ item.bovino ? item.bovino.arete : 'Eliminado' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" 
                                            :class="{
                                                'bg-blue-100 text-blue-800': item.tipo === 'Vacuna',
                                                'bg-yellow-100 text-yellow-800': item.tipo === 'Tratamiento',
                                                'bg-green-100 text-green-800': item.tipo === 'Desparasitación',
                                                'bg-purple-100 text-purple-800': item.tipo === 'Vitamina',
                                                'bg-gray-100 text-gray-800': !['Vacuna', 'Tratamiento', 'Desparasitación', 'Vitamina'].includes(item.tipo)
                                            }">
                                            {{ item.tipo }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ item.producto }}</td>
                                    <td class="px-6 py-4 text-orange-600 font-medium">
                                        {{ formatDate(item.proxima_dosis) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ item.costo ? '$ ' + item.costo : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <Link
                                            :href="route('sanidads.edit', item.id)"
                                            class="text-indigo-600 hover:text-indigo-900 font-medium"
                                        >
                                            Editar
                                        </Link>
                                        <button
                                            @click="deleteSanidad(item.id)"
                                            class="text-red-600 hover:text-red-900 font-medium"
                                        >
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="sanidads.length === 0">
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                        No hay registros sanitarios.
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
