<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    eventos: Array,
    filters: Object,
});

const form = useForm({});
const search = ref(props.filters.search || '');

let timeout = null;
watch(search, (value) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        router.get(route('eventos.index'), { search: value }, {
            preserveState: true,
            replace: true,
        });
    }, 300);
});

const deleteEvento = (id) => {
    if (confirm('¿Estás seguro de que deseas eliminar este evento?')) {
        form.delete(route('eventos.destroy', id));
    }
};

const formatDate = (dateString) => {
    if (!dateString) return '-';
    // Crear fecha manejando zona horaria local
    const date = new Date(dateString);
    return new Date(date.valueOf() + date.getTimezoneOffset() * 60000).toLocaleDateString('es-ES');
};
</script>

<template>
    <Head title="Eventos Ganaderos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Calendario de Eventos</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-4">
                    <div class="w-full max-w-md">
                        <TextInput
                            v-model="search"
                            type="search"
                            placeholder="Buscar por Bovino o Tipo..."
                            class="w-full"
                        />
                    </div>
                    <Link
                        :href="route('eventos.create')"
                        class="bg-purple-600 hover:bg-purple-800 text-white font-bold py-2 px-4 rounded shadow-md transition ease-in-out duration-150"
                    >
                        + Nuevo Evento
                    </Link>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Fecha</th>
                                    <th scope="col" class="px-6 py-3">Tipo</th>
                                    <th scope="col" class="px-6 py-3">Bovino</th>
                                    <th scope="col" class="px-6 py-3">Detalle</th>
                                    <th scope="col" class="px-6 py-3 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="evento in eventos" :key="evento.id" class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ formatDate(evento.fecha) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" 
                                            :class="{
                                                'bg-pink-100 text-pink-800': evento.tipo === 'Parto',
                                                'bg-indigo-100 text-indigo-800': evento.tipo === 'Celo',
                                                'bg-blue-100 text-blue-800': evento.tipo === 'Servicio',
                                                'bg-yellow-100 text-yellow-800': evento.tipo === 'Destete',
                                                'bg-red-100 text-red-800': evento.tipo === 'Muerte',
                                                'bg-green-100 text-green-800': evento.tipo === 'Venta',
                                                'bg-gray-100 text-gray-800': !['Parto', 'Celo', 'Servicio', 'Destete', 'Muerte', 'Venta'].includes(evento.tipo)
                                            }">
                                            {{ evento.tipo }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-800">
                                        {{ evento.bovino ? evento.bovino.arete : 'Eliminado' }}
                                        <span v-if="evento.bovino && evento.bovino.nombre" class="text-gray-500 font-normal">
                                            ({{ evento.bovino.nombre }})
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 italic text-gray-500">
                                        {{ evento.detalle || '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <Link
                                            :href="route('eventos.edit', evento.id)"
                                            class="text-indigo-600 hover:text-indigo-900 font-medium"
                                        >
                                            Editar
                                        </Link>
                                        <button
                                            @click="deleteEvento(evento.id)"
                                            class="text-red-600 hover:text-red-900 font-medium"
                                        >
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="eventos.length === 0">
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        No hay eventos registrados.
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
