<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    sanidads: Array,
    filters: Object,
});

const form = useForm({});
const search = ref(props.filters.search || '');

let timeout = null;
watch(search, (value) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        router.get(route('sanidads.index'), { search: value }, {
            preserveState: true,
            replace: true,
        });
    }, 300);
});

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
    <Head title="Sanidad" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sanidad</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Contenedor Estilo Carpeta -->
                <div class="bg-white dark:bg-gray-800 border-2 border-gray-400 dark:border-gray-600 shadow-[6px_6px_0px_rgba(0,0,0,0.1)] relative">
                    
                    <div class="absolute -top-8 left-0 text-white font-bold uppercase text-sm tracking-wider">
                        <div class="bg-emerald-700 dark:bg-emerald-600 inline-block py-2 px-6 rounded-t-lg border-t-2 border-l-2 border-r-2 border-gray-400 dark:border-gray-500">
                            Sanidad
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 border-b-2 border-gray-200 dark:border-gray-700 pb-6">
                            <div class="w-full max-w-md relative">
                                <TextInput
                                    v-model="search"
                                    type="search"
                                    placeholder="Buscar por Bovino o Producto..."
                                    class="w-full !rounded-none !border-2 !border-gray-300 focus:!border-emerald-500 !shadow-none bg-gray-50 font-mono text-sm"
                                />
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                    🔍
                                </div>
                            </div>
                            <Link
                                :href="route('sanidads.create')"
                                class="bg-emerald-600 hover:bg-emerald-800 text-white font-bold py-2 px-4 border-2 border-emerald-800 shadow-sm hover:shadow active:translate-y-0.5 transition-all uppercase text-xs tracking-widest"
                            >
                                + Nuevo Registro
                            </Link>
                        </div>

                        <div class="overflow-x-auto border-2 border-gray-200 dark:border-gray-700">
                            <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 border-b-2 border-gray-300 dark:border-gray-500">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 border-r border-gray-300 dark:border-gray-600">Fecha</th>
                                        <th scope="col" class="px-4 py-3 border-r border-gray-300 dark:border-gray-600">Bovino</th>
                                        <th scope="col" class="px-4 py-3 border-r border-gray-300 dark:border-gray-600">Tipo</th>
                                        <th scope="col" class="px-4 py-3 border-r border-gray-300 dark:border-gray-600">Producto</th>
                                        <th scope="col" class="px-4 py-3 border-r border-gray-300 dark:border-gray-600">Próxima Dosis</th>
                                        <th scope="col" class="px-4 py-3 border-r border-gray-300 dark:border-gray-600">Costo</th>
                                        <th scope="col" class="px-4 py-3 text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <tr v-for="item in sanidads" :key="item.id" class="bg-white dark:bg-gray-800 hover:bg-red-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-4 py-3 font-mono text-gray-900 dark:text-white border-r border-gray-200 dark:border-gray-700">
                                            {{ formatDate(item.fecha_aplicacion) }}
                                        </td>
                                        <td class="px-4 py-3 font-bold text-gray-800 dark:text-gray-200 border-r border-gray-200 dark:border-gray-700">
                                            {{ item.bovino ? item.bovino.arete : 'Eliminado' }}
                                        </td>
                                        <td class="px-4 py-3 border-r border-gray-200 dark:border-gray-700">
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase border" 
                                                :class="{
                                                    'bg-blue-100 text-blue-800 border-blue-300': item.tipo === 'Vacuna',
                                                    'bg-yellow-100 text-yellow-800 border-yellow-300': item.tipo === 'Tratamiento',
                                                    'bg-green-100 text-green-800 border-green-300': item.tipo === 'Desparasitación',
                                                    'bg-purple-100 text-purple-800 border-purple-300': item.tipo === 'Vitamina',
                                                    'bg-gray-100 text-gray-800 border-gray-300': !['Vacuna', 'Tratamiento', 'Desparasitación', 'Vitamina'].includes(item.tipo)
                                                }">
                                                {{ item.tipo }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 border-r border-gray-200 dark:border-gray-700">{{ item.producto }}</td>
                                        <td class="px-4 py-3 font-medium text-orange-600 dark:text-orange-400 border-r border-gray-200 dark:border-gray-700">
                                            {{ formatDate(item.proxima_dosis) }}
                                        </td>
                                        <td class="px-4 py-3 border-r border-gray-200 dark:border-gray-700 font-mono">
                                            {{ item.costo ? '$ ' + item.costo : '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-center space-x-2 whitespace-nowrap">
                                            <Link
                                                :href="route('sanidads.edit', item.id)"
                                                class="text-blue-600 hover:text-blue-900 border-2 border-transparent hover:border-blue-200 rounded px-2 py-0.5 transition font-bold text-xs uppercase"
                                            >
                                                Editar
                                            </Link>
                                            <button
                                                @click="deleteSanidad(item.id)"
                                                class="text-red-600 hover:text-red-900 border-2 border-transparent hover:border-red-200 rounded px-2 py-0.5 transition font-bold text-xs uppercase"
                                            >
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="sanidads.length === 0">
                                        <td colspan="7" class="px-6 py-8 text-center text-gray-400 italic">
                                            <div class="text-4xl mb-2">💉</div>
                                            No hay registros sanitarios en la carpeta.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
