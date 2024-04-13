<script setup>
import { onBeforeMount, ref,computed } from "vue";
import LayoutPortal from "@/Layouts/LayoutPortal.vue";
import axios from "axios";
import {  Link } from '@inertiajs/vue3';

const urlPorts = ref('http://127.0.0.1:8000/api/esporte');
let ports = ref([]);
const currentPage = ref(1);
const perPage = 6;

const carregaPosts = async () => {
    try {
        const response = await axios.get(urlPorts.value);
        ports.value = response.data.reverse();
    } catch (error) {
        console.error(error);
    }
};

const pageCount = computed(() => {
    return Math.ceil(ports.value.length / perPage);
});

const displayedPorts = computed(() => {
    const start = (currentPage.value - 1) * perPage;
    const end = start + perPage;
    return ports.value.slice(start, end);
});

const handlePrev = () => {
    if (currentPage.value > 1) {
        currentPage.value -= 1;
    }
};

const handleNext = () => {
    if (currentPage.value < pageCount.value) {
        currentPage.value += 1;
    }
};


onBeforeMount(() => {
    // console.log('Componente está prestes a ser montado no DOM usando onBeforeMount');

    axios.get('http://127.0.0.1:8000/publicidade/getlado')
        .then(response => {
            anuncioLado.value = response.data.reverse();
        })
        .catch(error => {
            console.error('Erro ao obter imagens:', error);
        });
    carregaPosts();
});


const anuncioLado=ref(false)

</script>

<template>
    <layout-portal>
        <template v-slot:esportes>
            <div class=" lg:grid md:grid-cols-6 lg:gap-4 lg:max-xl dark:bg-gray-950 ">
                <!-- parte de cards -->
                <div class="mx-5 lg:col-span-4 lg:ml-5 mt-3">
                    <div class="pt-2"> <strong>
                        <h1 class="text-center text-2xl font-bold text-gray-900 sm:text-3xl border-y-2 border-red-600 p-2 dark:text-neutral-100">Últimas Notícias</h1>
                    </strong>
                    </div>
                    <!-- inicio dos cards -->
                    <div class="lg:grid lg:grid-cols-4 gap-6 mt-2">

                        <!-- inicio coluna 1 -->
                        <div class="col-span-4">
                            <!-- inicio dos cards local -->
                            <div class="flex flex-row flex-wrap space-x-0.5">
                                <div v-for="p in displayedPorts" :key="p.id"
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
                                        <p class=" min-w-72 max-w-80 max-h-28 min-h-20 font-family:Times New Roman text-base text-neutral-600 dark:text-neutral-200">
                                            {{ p.sub_titulo }}
                                        </p>
                                        </a>
                                    </div>
                                </div> <!-- fim dos cards local -->
                            </div>
                        </div>  <!-- fim da coluna -->

                    </div>

                </div>
                <!-- parte de anuncios lado -->
                <div class=" mx-8 lg:col-span-2 lg:border-l-2 border-red-600 lg:mx-10 lg:mt-3 lg:items-center mt-4">
                    <div>
                        <h2 class="text-center">Publicidade</h2>
                        <div v-for="imageUrl in anuncioLado " :key="index">
                            <img :src="imageUrl" class="sm:mx-auto md:my-2">

                        </div>
                    </div>
                </div>
            </div>
            <!-- Botões de navegação da página -->
            <div v-if="pageCount > 1" class="flex justify-center mt-4">
                <button
                    @click="handlePrev"
                    :disabled="currentPage === 1"
                    class="px-3 py-1 mr-2 rounded text-gray-800 bg-slate-200  hover:text-white hover:bg-slate-900 focus:outline-none"
                >
                    Anterior
                </button>
                <button
                    @click="handleNext"
                    :disabled="currentPage === pageCount"
                    class="px-3 py-1 rounded text-gray-800 bg-slate-200 hover:text-white hover:bg-slate-900 focus:outline-none"
                >
                    Próximo
                </button>
            </div>
        </template>
    </layout-portal>
</template>
