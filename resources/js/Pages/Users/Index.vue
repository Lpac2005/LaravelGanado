<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

defineProps({
    users: Array,
});

const form = useForm({});
const confirmingUserDeletion = ref(false);
const userToDelete = ref(null);

const confirmUserDeletion = (user) => {
    userToDelete.value = user;
    confirmingUserDeletion.value = true;
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
    userToDelete.value = null;
};

const deleteUser = () => {
    if (userToDelete.value) {
        form.delete(route('users.destroy', userToDelete.value.id), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
            onFinish: () => form.reset(),
        });
    }
};
</script>

<template>
    <Head title="Usuario" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Usuario</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Mensajes flash -->
                <div v-if="$page.props.flash?.message" class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-none shadow-sm">
                    {{ $page.props.flash.message }}
                </div>
                <div v-if="$page.props.errors?.error" class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-none shadow-sm">
                    {{ $page.props.errors.error }}
                </div>

                <!-- Contenedor Estilo Carpeta -->
                <div class="bg-white dark:bg-gray-800 border-2 border-gray-400 dark:border-gray-600 shadow-[6px_6px_0px_rgba(0,0,0,0.1)] relative mt-8">
                    
                    <div class="absolute -top-8 left-0 text-white font-bold uppercase text-sm tracking-wider">
                        <div class="bg-emerald-700 dark:bg-emerald-600 inline-block py-2 px-6 rounded-t-lg border-t-2 border-l-2 border-r-2 border-gray-400 dark:border-gray-500">
                            Usuario
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex flex-col md:flex-row justify-end items-center mb-6 gap-4 border-b-2 border-gray-200 dark:border-gray-700 pb-6">
                            <Link
                                :href="route('users.create')"
                                class="bg-emerald-600 hover:bg-emerald-800 text-white font-bold py-2 px-4 border-2 border-emerald-800 shadow-sm hover:shadow active:translate-y-0.5 transition-all uppercase text-xs tracking-widest"
                            >
                                + Nuevo Usuario
                            </Link>
                        </div>

                        <div class="overflow-x-auto border-2 border-gray-200 dark:border-gray-700">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 border-b-2 border-gray-300 dark:border-gray-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 border-r border-gray-300 dark:border-gray-600 text-left">Nombre</th>
                                        <th scope="col" class="px-6 py-3 border-r border-gray-300 dark:border-gray-600 text-left">Email</th>
                                        <th scope="col" class="px-6 py-3 text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <tr v-for="user in users" :key="user.id" class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200 dark:border-gray-700">
                                            <div class="text-sm font-bold text-gray-900 dark:text-white uppercase">{{ user.name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200 dark:border-gray-700">
                                            <div class="text-sm font-mono text-gray-600 dark:text-gray-300">{{ user.email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center space-x-2">
                                            <Link 
                                                :href="route('users.edit', user.id)" 
                                                class="text-blue-600 hover:text-blue-900 border-2 border-transparent hover:border-blue-200 rounded px-2 py-0.5 transition font-bold text-xs uppercase"
                                            >
                                                Editar
                                            </Link>
                                            <button 
                                                @click="confirmUserDeletion(user)" 
                                                class="text-red-600 hover:text-red-900 border-2 border-transparent hover:border-red-200 rounded px-2 py-0.5 transition font-bold text-xs uppercase disabled:opacity-50 disabled:cursor-not-allowed"
                                                :disabled="user.id === $page.props.auth.user.id"
                                            >
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div v-if="users.length === 0" class="text-center py-8 text-gray-500 italic">
                            No hay usuarios registrados.
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Confirmación -->
        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6 bg-white dark:bg-gray-800">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    ¿Estás seguro de que quieres eliminar a este usuario?
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Esta acción no se puede deshacer. El usuario <strong>{{ userToDelete?.name }}</strong> será eliminado permanentemente del sistema.
                </p>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancelar
                    </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Eliminar Usuario
                    </DangerButton>
                </div>
            </div>
        </Modal>

    </AuthenticatedLayout>
</template>
