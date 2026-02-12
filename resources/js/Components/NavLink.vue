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
});

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center px-3 py-2 bg-emerald-900 border border-emerald-800 rounded-md font-semibold text-sm leading-5 text-white focus:outline-none transition duration-150 ease-in-out shadow-inner'
        : 'inline-flex items-center px-3 py-2 border border-transparent rounded-md font-medium text-sm leading-5 text-emerald-100 hover:text-white hover:bg-emerald-600 focus:outline-none focus:text-white focus:bg-emerald-600 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
