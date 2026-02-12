<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-emerald-700" />
            </Link>
        </div>
        <div class="mt-4 text-center">
            <h1 class="text-2xl font-bold text-emerald-800 dark:text-emerald-200">Registro Ganado</h1>
            <p class="text-gray-500 text-sm">Acceso al Sistema</p>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg border border-gray-300 dark:border-gray-700"
        >
            <slot />
        </div>

        <div class="mt-4 text-center text-xs text-gray-500">
            &copy; {{ new Date().getFullYear() }} Desarrallodo para la eficiencia del campo.
        </div>
    </div>
</template>
