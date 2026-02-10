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
    <Head title="Bovinos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Gestión de Bovinos</h2>
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
                        :href="route('bovinos.create')"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-md transition ease-in-out duration-150"
                    >
                        + Nuevo Bovino
                    </Link>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Arete</th>
                                    <th scope="col" class="px-6 py-3">Nombre</th>
                                    <th scope="col" class="px-6 py-3">Raza</th>
                                    <th scope="col" class="px-6 py-3">Sexo</th>
                                    <th scope="col" class="px-6 py-3">Fecha Nacimiento</th>
                                    <th scope="col" class="px-6 py-3">Peso Nac.</th>
                                    <th scope="col" class="px-6 py-3 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="bovino in bovinos" :key="bovino.id" class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ bovino.arete }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ bovino.nombre || '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ bovino.raza }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span :class="{'text-blue-600': bovino.sexo === 'Macho', 'text-pink-600': bovino.sexo === 'Hembra'}">
                                            {{ bovino.sexo }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ bovino.fecha_nacimiento }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ bovino.peso_nacimiento ? bovino.peso_nacimiento + ' kg' : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <Link
                                            :href="route('bovinos.edit', bovino.id)"
                                            class="text-indigo-600 hover:text-indigo-900 font-medium"
                                        >
                                            Editar
                                        </Link>
                                        <button
                                            @click="deleteBovino(bovino.id)"
                                            class="text-red-600 hover:text-red-900 font-medium"
                                        >
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="bovinos.length === 0">
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                        No hay bovinos registrados.
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
