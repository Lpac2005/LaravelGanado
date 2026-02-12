<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('users.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Crear Usuario" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Registrar Nuevo Usuario</h2>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Contenedor Estilo Ficha de Usuario -->
                <div class="bg-white dark:bg-gray-800 border-2 border-gray-400 dark:border-gray-600 shadow-[6px_6px_0px_rgba(0,0,0,0.1)] relative mt-8">
                    
                    <div class="absolute -top-5 left-0 right-0 flex justify-center">
                         <div class="bg-gray-800 dark:bg-gray-700 text-white font-bold uppercase text-sm tracking-widest py-1 px-8 rounded-full border-2 border-white dark:border-gray-800 shadow-md">
                            Alta de Usuario
                        </div>
                    </div>

                    <div class="p-8 pt-10">
                        <form @submit.prevent="submit" class="space-y-6">
                            
                            <!-- Sección Identidad -->
                            <div class="border-b-2 border-dashed border-gray-200 dark:border-gray-700 pb-6">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">1. Credenciales de Acceso</h3>
                                
                                <div>
                                    <InputLabel for="name" value="Nombre Completo" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-emerald-500 !shadow-none font-bold"
                                        v-model="form.name"
                                        required
                                        autofocus
                                        autocomplete="name"
                                    />
                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>

                                <div class="mt-6">
                                    <InputLabel for="email" value="Correo Electrónico" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                    <TextInput
                                        id="email"
                                        type="email"
                                        class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-emerald-500 !shadow-none font-mono"
                                        v-model="form.email"
                                        required
                                        autocomplete="username"
                                    />
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>
                            </div>

                            <!-- Sección Seguridad -->
                            <div>
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">2. Seguridad</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <InputLabel for="password" value="Contraseña" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="password"
                                            type="password"
                                            class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-emerald-500 !shadow-none"
                                            v-model="form.password"
                                            required
                                            autocomplete="new-password"
                                        />
                                        <InputError class="mt-2" :message="form.errors.password" />
                                    </div>

                                    <div>
                                        <InputLabel for="password_confirmation" value="Confirmar Contraseña" class="!text-xs !uppercase !tracking-wider !text-gray-500" />
                                        <TextInput
                                            id="password_confirmation"
                                            type="password"
                                            class="mt-1 block w-full !rounded-none !border-gray-300 focus:!border-emerald-500 !shadow-none"
                                            v-model="form.password_confirmation"
                                            required
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

                                <PrimaryButton class="ms-4 !rounded-none !bg-emerald-600 hover:!bg-emerald-800 !px-8 !py-3 !text-sm !tracking-widest border-2 border-emerald-800 shadow-[4px_4px_0px_rgba(0,0,0,0.2)] active:translate-y-0.5 active:shadow-none transition-all" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Guardar Usuario
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
