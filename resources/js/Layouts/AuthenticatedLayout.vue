<script setup>
import { ref, onMounted } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import SidebarLink from '@/Components/SidebarLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const isDark = ref(false);
const sidebarOpen = ref(true);

const toggleTheme = () => {
    isDark.value = !isDark.value;
    if (isDark.value) {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    }
};

onMounted(() => {
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        isDark.value = true;
        document.documentElement.classList.add('dark');
    } else {
        isDark.value = false;
        document.documentElement.classList.remove('light');
    }
});
</script>

<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex font-sans">
        
        <!-- Sidebar Industrial/Dossier -->
        <aside 
            :class="sidebarOpen ? 'w-64' : 'w-20'"
            class="hidden md:flex flex-col bg-white dark:bg-gray-800 border-r-4 border-gray-800 dark:border-gray-700 transition-all duration-300 relative z-20"
        >
            <!-- Header Sidebar (Logo Expandido/Colapsado) -->
            <div class="h-20 flex items-center justify-center border-b-4 border-gray-800 dark:border-gray-700 bg-gray-800 dark:bg-gray-900 shadow-lg">
                <Link :href="route('dashboard')" class="flex items-center">
                    <ApplicationLogo class="h-10 w-auto fill-current text-white" />
                    <span v-if="sidebarOpen" class="ml-3 text-white font-black text-xl tracking-tighter uppercase italic">Ganado Pro</span>
                </Link>
            </div>

            <!-- Botonera de Navegación (Pestañas de Archivador) -->
            <nav class="flex-1 px-4 py-8 overflow-y-auto bg-white dark:bg-gray-800">
                <div class="space-y-4">
                    <p v-if="sidebarOpen" class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-4 border-b border-gray-200 dark:border-gray-700 pb-1">Menú Principal</p>
                    
                    <SidebarLink :href="route('dashboard')" :active="route().current('dashboard')" color="gray">
                        <template #icon>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        </template>
                        <span v-if="sidebarOpen">Panel de Control</span>
                    </SidebarLink>

                    <SidebarLink :href="route('bovinos.index')" :active="route().current('bovinos.*')" color="blue">
                        <template #icon>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/></svg>
                        </template>
                        <span v-if="sidebarOpen">Registro</span>
                    </SidebarLink>

                    <SidebarLink :href="route('pesajes.index')" :active="route().current('pesajes.*')" color="emerald">
                        <template #icon>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75z"/></svg>
                        </template>
                        <span v-if="sidebarOpen">Peso</span>
                    </SidebarLink>

                    <SidebarLink :href="route('sanidads.index')" :active="route().current('sanidads.*')" color="red">
                        <template #icon>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L5.597 15.12a2 2 0 00-1.022.547l-2.387.477a2 2 0 001.56 2.317l2.387-.477a4 4 0 012.574-.344l.318-.158a4 4 0 002.574-.344l2.387.477a2 2 0 001.56-2.317l-2.387-.477z"/></svg>
                        </template>
                        <span v-if="sidebarOpen">Sanidad</span>
                    </SidebarLink>

                    <SidebarLink :href="route('eventos.index')" :active="route().current('eventos.*')" color="purple">
                        <template #icon>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </template>
                        <span v-if="sidebarOpen">Calendario</span>
                    </SidebarLink>

                    <SidebarLink :href="route('users.index')" :active="route().current('users.*')" color="gray">
                        <template #icon>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </template>
                        <span v-if="sidebarOpen">Usuario</span>
                    </SidebarLink>
                </div>
            </nav>

            <!-- Botón Colapsar -->
            <button 
                @click="sidebarOpen = !sidebarOpen"
                class="h-10 border-t-4 border-gray-800 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-500 hover:text-gray-800 dark:hover:text-white transition-colors"
            >
                {{ sidebarOpen ? '« Contraer Panel' : '»' }}
            </button>
        </aside>

        <!-- Contenido Principal -->
        <div class="flex-1 flex flex-col min-h-screen">
            
            <!-- Navbar Superior (Slim) -->
            <header class="h-16 bg-white dark:bg-gray-800 border-b-4 border-gray-800 dark:border-gray-700 flex items-center justify-between px-8 z-10 shadow-sm">
                
                <!-- Breadcrumbs o Título Seccion -->
                <div>
                    <h2 class="font-black text-xs uppercase tracking-[0.2em] text-gray-400">
                        Sistema de Gestión Pecuaria <span class="mx-2 text-gray-300">/</span> 
                        <span class="text-gray-800 dark:text-white">Estación de Control</span>
                    </h2>
                </div>

                <div class="flex items-center space-x-6">
                    <!-- Sello de Fecha Industrial -->
                    <div class="hidden lg:flex items-center bg-gray-50 dark:bg-gray-900 border-2 border-gray-800 px-3 py-1 -rotate-1 shadow-[2px_2px_0px_rgba(0,0,0,1)]">
                        <span class="text-[10px] font-mono font-bold text-gray-600 dark:text-gray-400 uppercase">
                            REG: {{ new Date().toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' }) }}
                        </span>
                    </div>

                    <!-- Theme Toggle -->
                    <button @click="toggleTheme" class="text-gray-500 hover:text-gray-800 dark:hover:text-white transition-colors">
                        <svg v-if="!isDark" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        <svg v-else class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </button>

                    <!-- Profile Dropdown -->
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <button class="flex items-center text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 hover:text-black dark:hover:text-white transition-colors">
                                {{ $page.props.auth.user.name }}
                                <svg class="ml-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                        </template>
                        <template #content>
                            <div class="rounded-none border-2 border-gray-800 overflow-hidden shadow-[4px_4px_0px_rgba(0,0,0,1)] bg-white">
                                <DropdownLink :href="route('profile.edit')" class="!text-xs !font-bold !uppercase uppercase !border-b-2 !border-gray-100"> Ficha de Perfil </DropdownLink>
                                <DropdownLink :href="route('logout')" method="post" as="button" class="!text-xs !font-bold !uppercase !text-red-600"> Terminar Turno </DropdownLink>
                            </div>
                        </template>
                    </Dropdown>
                </div>
            </header>

            <!-- Page Heading (Breadcrumb-style Area) -->
            <div class="bg-gray-50 dark:bg-gray-900 border-b-2 border-gray-200 dark:border-gray-800 px-8 py-4" v-if="$slots.header">
                <slot name="header" />
            </div>

            <!-- Main Content Area -->
            <main class="flex-1 p-8 overflow-y-auto bg-white dark:bg-gray-900/50">
                <slot />
            </main>

            <!-- Footer Industrial -->
            <footer class="bg-white dark:bg-gray-800 border-t-4 border-gray-800 dark:border-gray-700 px-8 py-2 flex justify-between items-center text-[10px] font-mono text-gray-400">
                <span>TERMINAL_IDENTIFIER: {{ $page.props.auth.user.id }}-SEC_PRO</span>
                <span class="font-bold">MODO: OPERACIÓN TÉCNICA ACTIVA</span>
            </footer>
        </div>

        <!-- Móvil: Menú Hamburguesa (Trigger) -->
        <div class="md:hidden fixed bottom-6 right-6 z-50">
            <button @click="showingNavigationDropdown = !showingNavigationDropdown" class="bg-gray-800 text-white p-4 rounded-full shadow-2xl border-2 border-white">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
            </button>
        </div>

        <!-- Móvil: Overlay y Menú -->
        <div v-if="showingNavigationDropdown" class="md:hidden fixed inset-0 bg-black/50 z-[100] flex justify-end">
            <div class="w-64 bg-white dark:bg-gray-800 h-full border-l-4 border-gray-800 flex flex-col">
                <!-- Similitud con Sidebar de Escritorio pero vertical -->
                <div class="p-6 bg-gray-800 text-white font-black uppercase italic">Menu Móvil</div>
                <nav class="p-4 space-y-2 flex-1">
                    <SidebarLink :href="route('dashboard')" :active="route().current('dashboard')">Panel</SidebarLink>
                    <SidebarLink :href="route('bovinos.index')" :active="route().current('bovinos.*')">Bovinos</SidebarLink>
                    <!-- ... resto de links simplificados ... -->
                    <SidebarLink :href="route('logout')" method="post" as="button" color="red">Salir</SidebarLink>
                </nav>
            </div>
        </div>

    </div>
</template>
