<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
    color: {
        type: String,
        default: 'emerald'
    }
});

const colorClasses = computed(() => {
    const colors = {
        emerald: 'border-emerald-700 text-emerald-700 bg-emerald-50 dark:bg-emerald-900/20 dark:text-emerald-400',
        blue: 'border-blue-700 text-blue-700 bg-blue-50 dark:bg-blue-900/20 dark:text-blue-400',
        red: 'border-red-700 text-red-700 bg-red-50 dark:bg-red-900/20 dark:text-red-400',
        purple: 'border-purple-700 text-purple-700 bg-purple-50 dark:bg-purple-900/20 dark:text-purple-400',
        gray: 'border-gray-700 text-gray-700 bg-gray-50 dark:bg-gray-800 dark:text-gray-300',
    };
    return colors[props.color] || colors.emerald;
});

const classes = computed(() =>
    props.active
        ? `flex items-center px-4 py-3 mb-2 border-l-4 font-bold text-sm tracking-widest uppercase transition-all shadow-[4px_4px_0px_rgba(0,0,0,0.1)] translate-x-1 ${colorClasses.value}`
        : 'flex items-center px-4 py-3 mb-2 border-l-4 border-transparent font-bold text-sm tracking-widest uppercase text-gray-500 hover:text-gray-700 hover:bg-gray-100 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:bg-gray-800 transition-all text-xs'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot name="icon" />
        <span class="ml-3"><slot /></span>
    </Link>
</template>
