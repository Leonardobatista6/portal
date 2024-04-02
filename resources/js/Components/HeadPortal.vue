<script setup>
import NavLink from '@/Components/NavLink.vue';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import {computed} from "vue";




</script>


<template>

    <Head>
        <title>Portal jf</title>
        <meta name="description" content="Page Description" />

    </Head>
    <!-- Botões de navegação -->
    <div class="flex justify-center h-16 bg-stone-950">
        <div class="flex flex-row justify-center">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <Link :href="route('dashboard')">
                    <ApplicationMark class="block h-9 w-auto" />
                </Link>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <NavLink :href="route('portal')" :active="route().current('dashboard')">
                    Home
                </NavLink>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <NavLink :href="route('nnacionais')" :active="route().current('dashboard')">
                    Noticias Nacionais
                </NavLink>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <NavLink :href="route('politica')" :active="route().current('dashboard')">
                    Política
                </NavLink>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <NavLink :href="route('economia')" :active="route().current('dashboard')">
                    Economia
                </NavLink>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <NavLink :href="route('esportes')" :active="route().current('dashboard')">
                    Esportes
                </NavLink>
            </div>
        </div>
    </div>  <!-- fim dos Botões de navegação -->
</template>

<style scoped>

</style>
