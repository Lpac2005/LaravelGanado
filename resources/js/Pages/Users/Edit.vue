<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    user: Object,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.put(route('users.update', props.user.id), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Editar Usuario" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-black text-2xl text-gray-800 dark:text-white uppercase tracking-tighter italic">Editar Ficha de Usuario: {{ user.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <!-- Contenedor Estilo Ficha de Usuario -->
                <div class="bg-white dark:bg-gray-800 border-2 border-gray-400 dark:border-gray-600 shadow-[6px_6px_0px_rgba(0,0,0,0.1)] relative mt-8">
                    <div class="absolute -top-5 left-0 right-0 flex justify-center">
                         <div class="bg-gray-800 dark:bg-gray-700 text-white font-bold uppercase text-sm tracking-widest py-1 px-8 rounded-full border-2 border-white dark:border-gray-800 shadow-md">
                            Perfil de Usuario
                        </div>
                    </div>

                    <div class="p-8 pt-10">
                        <form @submit.prevent="submit" class="space-y-6">
                            <!-- Sección Identidad -->
                            <div class="border-b-2 border-dashed border-gray-100 dark:border-gray-700 pb-6">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">1. Datos de Acceso</h3>
                                <div class="space-y-4">
                                    <div>
                                        <InputLabel for="name" value="Nombre del Funcionario" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="name"
                                            type="text"
                                            class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-emerald-500 !shadow-none font-bold"
                                            v-model="form.name"
                                            required
                                            autofocus
                                        />
                                        <InputError class="mt-2" :message="form.errors.name" />
                                    </div>

                                    <div>
                                        <InputLabel for="email" value="Correo Institucional" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="email"
                                            type="email"
                                            class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-emerald-500 !shadow-none font-bold"
                                            v-model="form.email"
                                            required
                                        />
                                        <InputError class="mt-2" :message="form.errors.email" />
                                    </div>
                                </div>
                            </div>

                            <!-- Sección Seguridad -->
                            <div>
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">2. Seguridad y Credenciales</h3>
                                <p class="text-[10px] text-gray-400 mb-4 italic italic uppercase tracking-tighter">* Dejar campos vacíos si no desea cambiar la clave actual</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <InputLabel for="password" value="Nueva Contraseña" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="password"
                                            type="password"
                                            class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-emerald-500 !shadow-none font-mono"
                                            v-model="form.password"
                                            autocomplete="new-password"
                                        />
                                        <InputError class="mt-2" :message="form.errors.password" />
                                    </div>

                                    <div>
                                        <InputLabel for="password_confirmation" value="Confirmar Clave" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="password_confirmation"
                                            type="password"
                                            class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-emerald-500 !shadow-none font-mono"
                                            v-model="form.password_confirmation"
                                            autocomplete="new-password"
                                        />
                                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-8 pt-6 border-t-2 border-gray-100 dark:border-gray-700">
                                <Link
                                    :href="route('users.index')"
                                    class="text-gray-500 hover:text-gray-700 underline text-sm mr-4 uppercase tracking-wider font-bold"
                                >
                                    Cancelar
                                </Link>

                                <PrimaryButton class="ms-4 !rounded-none !bg-gray-800 hover:!bg-black !px-8 !py-3 !text-sm !tracking-widest border-2 border-black shadow-[4px_4px_0px_rgba(0,0,0,0.2)] active:translate-y-0.5 active:shadow-none transition-all" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Actualizar Perfil
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
