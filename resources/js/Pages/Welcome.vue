<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Bienvenido a Registro Ganado" />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 font-sans text-gray-800">
        
        <!-- Navbar Clásico -->
        <nav class="bg-emerald-700 text-white shadow-md">
            <div class="max-w-6xl mx-auto px-4">
                <div class="flex justify-between items-center h-14">
                    <!-- Logo y Nombre -->
                    <div class="flex items-center space-x-2">
                        <ApplicationLogo class="w-8 h-8 fill-current text-white" />
                        <span class="font-bold text-lg tracking-wide">REGISTRO GANADO</span>
                    </div>
                    
                    <!-- Enlaces de Navegación -->
                    <div class="flex items-center space-x-4 text-sm">
                        <div v-if="canLogin">
                            <Link
                                v-if="$page.props.auth.user"
                                :href="route('dashboard')"
                                class="hover:text-gray-200 hover:underline"
                            >Ir al Panel</Link>

                            <template v-else>
                                <Link
                                    :href="route('login')"
                                    class="hover:text-gray-200 hover:underline mr-4"
                                >Iniciar Sesión</Link>

                                <Link
                                    v-if="canRegister"
                                    :href="route('register')"
                                    class="px-3 py-1 bg-white text-emerald-800 font-bold rounded hover:bg-gray-200 transition"
                                >Registrarse</Link>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Header tipo "Jumbotron" -->
        <header class="bg-gray-200 dark:bg-gray-800 border-b border-gray-300 dark:border-gray-700 py-16 text-center">
            <div class="max-w-4xl mx-auto px-4">
                <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">Sistema de Gestión Ganadera</h1>
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto">
                    Una herramienta simple y efectiva para administrar su finca. Controle su ganado, pesajes y eventos importantes de manera fácil y rápida.
                </p>
                <div class="flex justify-center gap-4">
                    <Link :href="route('register')" class="px-6 py-3 bg-emerald-600 text-white font-semibold rounded hover:bg-emerald-700 shadow-sm">
                        Crear Cuenta Gratis
                    </Link>
                    <a href="#info" class="px-6 py-3 bg-white text-gray-700 font-semibold rounded border border-gray-300 hover:bg-gray-50 shadow-sm">
                        Leer más información
                    </a>
                </div>
            </div>
        </header>

        <!-- Contenido Principal con Diseño de Rejilla Clásico -->
        <main id="info" class="py-12 max-w-6xl mx-auto px-4">
            
            <div class="text-center mb-10 border-b border-gray-300 pb-4">
                <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-200">Módulos del Sistema</h2>
                <p class="text-gray-500 mt-2">Todo lo que necesita para su trabajo diario</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Tarjeta 1 -->
                <div class="bg-white dark:bg-gray-800 p-6 border border-gray-300 dark:border-gray-700 rounded shadow-sm hover:shadow-md transition">
                    <div class="text-emerald-600 text-4xl mb-4 text-center">🐄</div>
                    <h3 class="text-xl font-bold text-center mb-2 dark:text-white">Bovinos</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm text-center">
                        Registre cada animal con su identificación, raza y detalles. Mantenga un inventario ordenado.
                    </p>
                </div>

                <!-- Tarjeta 2 -->
                <div class="bg-white dark:bg-gray-800 p-6 border border-gray-300 dark:border-gray-700 rounded shadow-sm hover:shadow-md transition">
                    <div class="text-blue-600 text-4xl mb-4 text-center">⚖️</div>
                    <h3 class="text-xl font-bold text-center mb-2 dark:text-white">Pesaje</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm text-center">
                        Controle el peso de sus animales periódicamente. Vea el progreso de engorde.
                    </p>
                </div>

                <!-- Tarjeta 3 -->
                <div class="bg-white dark:bg-gray-800 p-6 border border-gray-300 dark:border-gray-700 rounded shadow-sm hover:shadow-md transition">
                    <div class="text-red-600 text-4xl mb-4 text-center">�</div>
                    <h3 class="text-xl font-bold text-center mb-2 dark:text-white">Sanidad</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm text-center">
                        Gestione vacunas y tratamientos médicos para mantener la salud del hato.
                    </p>
                </div>

                <!-- Tarjeta 4 -->
                <div class="bg-white dark:bg-gray-800 p-6 border border-gray-300 dark:border-gray-700 rounded shadow-sm hover:shadow-md transition">
                    <div class="text-purple-600 text-4xl mb-4 text-center">�</div>
                    <h3 class="text-xl font-bold text-center mb-2 dark:text-white">Eventos</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm text-center">
                        Calendario para recordar fechas importantes y actividades pendientes.
                    </p>
                </div>
            </div>

            <!-- Sección Secundaria "Acerca de" -->
            <div class="mt-12 bg-white dark:bg-gray-800 p-8 border border-gray-300 dark:border-gray-700 rounded">
                <h3 class="text-xl font-bold mb-4 dark:text-white">¿Por qué usar este sistema?</h3>
                <ul class="list-disc pl-5 space-y-2 text-gray-700 dark:text-gray-300">
                    <li>Es fácil de aprender y usar.</li>
                    <li>Funciona en computadoras y tabletas.</li>
                    <li>Mantiene sus datos seguros y organizados.</li>
                    <li>Desarrollado para la máxima eficiencia del campo.</li>
                </ul>
            </div>

        </main>

        <!-- Footer Clásico -->
        <footer class="bg-gray-800 text-gray-300 py-8 border-t border-gray-700 mt-8">
            <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center text-sm">
                <div class="mb-4 md:mb-0">
                    <p>&copy; 2026 Registro Ganado. Todos los derechos reservados.</p>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-white">Términos de Uso</a>
                    <span class="text-gray-600">|</span>
                    <a href="#" class="hover:text-white">Política de Privacidad</a>
                    <span class="text-gray-600">|</span>
                    <a href="#" class="hover:text-white">Soporte</a>
                </div>
            </div>
        </footer>
    </div>
</template>
