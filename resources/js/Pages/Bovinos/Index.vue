<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    bovinos: Array,
    filters: Object,
});

const form = useForm({});
const search = ref(props.filters.search || '');

let timeout = null;
watch(search, (value) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        router.get(route('bovinos.index'), { search: value }, {
            preserveState: true,
            replace: true,
        });
    }, 300);
});

const deleteBovino = (id) => {
    if (confirm('¿Estás seguro de que deseas eliminar este bovino?')) {
        form.delete(route('bovinos.destroy', id));
    }
};
</script>

<template>
    <Head title="Registro" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Registro</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Contenedor Estilo Carpeta -->
                <div class="bg-white dark:bg-gray-800 border-2 border-gray-400 dark:border-gray-600 shadow-[6px_6px_0px_rgba(0,0,0,0.1)] relative">
                    
                    <!-- Pestaña de Carpeta -->
                    <div class="absolute -top-8 left-0 text-white font-bold uppercase text-sm tracking-wider">
                        <div class="bg-emerald-700 dark:bg-emerald-600 inline-block py-2 px-6 rounded-t-lg border-t-2 border-l-2 border-r-2 border-gray-400 dark:border-gray-500">
                            Registro
                        </div>
                    </div>

                    <div class="p-6">
                        <!-- Barra de Herramientas -->
                        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 border-b-2 border-gray-200 dark:border-gray-700 pb-6">
                            <div class="w-full max-w-md relative">
                                <TextInput
                                    v-model="search"
                                    type="search"
                                    placeholder="Buscar por Arete o Nombre..."
                                    class="w-full !rounded-none !border-2 !border-gray-300 focus:!border-emerald-500 !shadow-none bg-gray-50 font-mono text-sm"
                                />
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                    🔍
                                </div>
                            </div>
                            <Link
                                :href="route('bovinos.create')"
                                class="bg-emerald-600 hover:bg-emerald-800 text-white font-bold py-2 px-4 border-2 border-emerald-800 shadow-sm hover:shadow active:translate-y-0.5 transition-all uppercase text-xs tracking-widest"
                            >
                                + Nuevo Bovino
                            </Link>
                        </div>

                        <!-- Tabla de Datos -->
                        <div class="overflow-x-auto border-2 border-gray-200 dark:border-gray-700">
                            <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 border-b-2 border-gray-300 dark:border-gray-500">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 border-r border-gray-300 dark:border-gray-600">Arete</th>
                                        <th scope="col" class="px-4 py-3 border-r border-gray-300 dark:border-gray-600">Nombre</th>
                                        <th scope="col" class="px-4 py-3 border-r border-gray-300 dark:border-gray-600">Raza</th>
                                        <th scope="col" class="px-4 py-3 border-r border-gray-300 dark:border-gray-600">Sexo</th>
                                        <th scope="col" class="px-4 py-3 border-r border-gray-300 dark:border-gray-600">F. Nacimiento</th>
                                        <th scope="col" class="px-4 py-3 border-r border-gray-300 dark:border-gray-600">Peso Nac.</th>
                                        <th scope="col" class="px-4 py-3 text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <tr v-for="bovino in bovinos" :key="bovino.id" class="bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-4 py-3 font-mono font-bold text-gray-900 dark:text-white border-r border-gray-200 dark:border-gray-700">
                                            {{ bovino.arete }}
                                        </td>
                                        <td class="px-4 py-3 border-r border-gray-200 dark:border-gray-700">
                                            {{ bovino.nombre || '-' }}
                                        </td>
                                        <td class="px-4 py-3 border-r border-gray-200 dark:border-gray-700">
                                            {{ bovino.raza }}
                                        </td>
                                        <td class="px-4 py-3 border-r border-gray-200 dark:border-gray-700">
                                            <span 
                                                class="px-2 py-0.5 rounded text-[10px] font-bold uppercase border"
                                                :class="{'bg-blue-100 text-blue-800 border-blue-300': bovino.sexo === 'Macho', 'bg-pink-100 text-pink-800 border-pink-300': bovino.sexo === 'Hembra'}"
                                            >
                                                {{ bovino.sexo }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 border-r border-gray-200 dark:border-gray-700 whitespace-nowrap">
                                            {{ bovino.fecha_nacimiento }}
                                        </td>
                                        <td class="px-4 py-3 border-r border-gray-200 dark:border-gray-700">
                                            {{ bovino.peso_nacimiento ? bovino.peso_nacimiento + ' kg' : '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-center space-x-2 whitespace-nowrap">
                                            <Link
                                                :href="route('bovinos.edit', bovino.id)"
                                                class="text-blue-600 hover:text-blue-900 border-2 border-transparent hover:border-blue-200 rounded px-2 py-0.5 transition font-bold text-xs uppercase"
                                            >
                                                Editar
                                            </Link>
                                            <button
                                                @click="deleteBovino(bovino.id)"
                                                class="text-red-600 hover:text-red-900 border-2 border-transparent hover:border-red-200 rounded px-2 py-0.5 transition font-bold text-xs uppercase"
                                            >
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="bovinos.length === 0">
                                        <td colspan="7" class="px-6 py-8 text-center text-gray-400 italic">
                                            <div class="text-4xl mb-2">🐄</div>
                                            No hay registros de bovinos en la carpeta.
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
