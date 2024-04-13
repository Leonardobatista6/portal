<script setup>
import LayoutPortal from '@/Layouts/LayoutPortal.vue';
import { defineProps } from 'vue';

const props = defineProps({
    dadosDaPesquisa: Array,
});

console.log("Resultado da pesquisa:", dadosDaPesquisa);

</script>
<template>
    <layout-portal>
        <template v-slot:resultado>
            <div class="lg:grid md:grid-cols-6 lg:gap-4 lg:max-xl dark:bg-gray-950">
                <div class="mx-5 lg:col-span-4 lg:ml-5 mt-3">
                    <div v-if="dadosDaPesquisa !== null">
                        <div v-if="dadosDaPesquisa.length > 0">
                            <div class="flex flex-row flex-wrap space-x-0.5">
                                <div v-for="p in dadosDaPesquisa" :key="p.id"
                                     class="container min-w-72 p-4 mb-4 max-w-80 block  justify-items-center rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                                    <div
                                        class="relative overflow-hidden bg-cover bg-no-repeat"
                                        data-te-ripple-init
                                        data-te-ripple-color="light">
                                        <img
                                            class="rounded-t-lg min-w-72 max-w-80 mb-2"
                                            :src="p.imagem_url"
                                            alt="" />
                                        <a :href="`/publicacao/${p.titulo}`">
                                            <div
                                                class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-[hsla(0,0%,98%,0.15)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100"></div>
                                        </a>
                                    </div>
                                    <div class=" min-w-72 max-w-80">
                                        <a :href="`/publicacao/${p.titulo}`">
                                            <h5
                                                class=" min-w-64 max-w-80 max-h-28 min-h-20 pb-2  text-xl font-family:Times New Roman leading-tight text-neutral-800 dark:text-neutral-50">
                                                <strong> {{p.titulo}} </strong>
                                            </h5>

                                        </a>
                                    </div>
                                </div> <!-- fim dos cards local -->
                            </div>
                        </div>
                        <div v-else>
                            <p>Nenhum resultado encontrado.</p>
                        </div>
                    </div>
                    <div v-else>
                        <p>Carregando...</p>
                    </div>
                </div>
                <div class="mx-8 lg:col-span-2 lg:border-l-2 border-red-600 lg:mx-10 lg:mt-3 lg:items-center">
                    <div>
                        <h2 class="sm:text-center">Anuncios</h2>
                    </div>
                </div>
            </div>
        </template>
    </layout-portal>
</template>
