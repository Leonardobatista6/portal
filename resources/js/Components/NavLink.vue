<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-red-600 lg:border-b-3 lg:border-red-600 text-sm font-medium leading-5 text-slate-900 lg:text-slate-50 focus:outline-none focus:border-red-600 transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-slate-900 lg:text-slate-50  hover:border-red-600 focus:outline-none focus:text-gray-700 focus:border-red-600 transition duration-150 ease-in-out';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
