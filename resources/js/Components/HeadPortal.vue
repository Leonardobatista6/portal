<script setup>
import NavLink from '@/Components/NavLink.vue';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const isMobileMenuOpen = ref(false);

function toggleMobileMenu() {
    isMobileMenuOpen.value = !isMobileMenuOpen.value;
}


</script>


<template>
        <title>Portal jf</title>
        <meta name="description" content="Page Description" />

    <!-- Botão de menu para dispositivos móveis -->
    <div class="md:max-lg flex justify-between items-center sm:justify-center h-16 bg-gray-950 px-4 sm:px-0">

            <div class="flex-shrink-0 sm:flex sm:order-first pr-20">
                <Link :href="route('portal')">
                    <ApplicationMark class=" block h-9 w-auto" />
                </Link>
            </div>


            <!-- Ícone de menu para dispositivos móveis -->
            <div class="sm:hidden">
                <button @click="toggleMobileMenu" class="text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

            <!-- Links de navegação para telas maiores -->
            <div class="hidden space-x-8 sm:flex sm:justify-center lg:justify-items-center">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <NavLink  :href="route('portal')" :active="route().current('portal')">
                        Home
                    </NavLink>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <NavLink :href="route('noticiaslocal')" :active="route().current('noticiaslocal')">
                        Noticias Local
                    </NavLink>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <NavLink :href="route('nnacionais')" :active="route().current('nnacionais')">
                        Noticias Nacionais
                    </NavLink>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <NavLink :href="route('politica')" :active="route().current('politica')">
                        Política
                    </NavLink>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <NavLink :href="route('economia')" :active="route().current('economia')">
                        Economia
                    </NavLink>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <NavLink :href="route('esportes')" :active="route().current('esportes')">
                        Esportes
                    </NavLink>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <NavLink :href="route('entretenimento')" :active="route().current('entretenimento')">
                        Entretenimento
                    </NavLink>
                </div>

            </div>

    </div>

    <!-- Menu móvel -->
    <transition name="fade">
        <div v-if="isMobileMenuOpen" class="sm:hidden">
            <!-- Lista de itens de navegação para dispositivos móveis -->
            <div class="px-2 pt-2 pb-3 space-y-1">
                <!-- Navigation Links -->
                <div class=" space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <NavLink :href="route('portal')" :active="route().current('portal')">
                        Home
                    </NavLink>
                </div>
                <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <NavLink :href="route('noticiaslocal')" :active="route().current('noticiaslocal')">
                        Noticias Local
                    </NavLink>
                </div>
                <div class=" space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <NavLink  :href="route('nnacionais')" :active="route().current('nnacionais')">
                        Noticias Nacionais
                    </NavLink>
                </div>
                <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <NavLink  :href="route('politica')" :active="route().current('politica')">
                        Política
                    </NavLink>
                </div>
                <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <NavLink  :href="route('economia')" :active="route().current('economia')">
                        Economia
                    </NavLink>
                </div>
                <div class=" space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <NavLink  :href="route('esportes')" :active="route().current('esportes')">
                        Esportes
                    </NavLink>
                </div>
                <div class=" space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <NavLink :href="route('entretenimento')" :active="route().current('entretenimento')">
                        Entretenimento
                    </NavLink>
                </div>
            </div>
        </div>
    </transition>



</template>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to {
    opacity: 0%;
}

</style>
