<script setup>
import {onBeforeMount, onMounted, ref} from "vue";
import axios from "axios";
import { Link } from '@inertiajs/vue3';

const economiaPorts = ref('http://127.0.0.1:8000/api/economia');
let economia = ref([]);

const noticiasLocaisPorts = ref('http://127.0.0.1:8000/api/noticiaslocal');
let locais = ref([]);

const politicaPorts = ref('http://127.0.0.1:8000/api/politica');
let politica = ref([]);

const noticiasNacionaisPorts = ref('http://127.0.0.1:8000/api/noticiasnacionais');
let nacionais = ref([]);

const esportesPorts = ref('http://127.0.0.1:8000/api/esporte');
let esportes = ref([]);

const entretePorts = ref('http://127.0.0.1:8000/api/entretenimento');
let entrete = ref([]);

const carregaPosts = async () => {
    try {

        const responseLoc = await axios.get(noticiasLocaisPorts.value);
        locais.value = responseLoc.data.reverse();

        const responsePol = await axios.get(politicaPorts.value);
        politica.value = responsePol.data.reverse();

        const responseNac = await axios.get(noticiasNacionaisPorts.value);
        nacionais.value = responseNac.data.reverse();

    } catch (error) {
        console.error(error);
    }
};

const postsEee = async () => {
    try {
        const responseEcon = await axios.get(economiaPorts.value);
        economia.value = responseEcon.data.reverse();

        const resEspot = await axios.get(esportesPorts.value);
        esportes.value = resEspot.data.reverse();

        const resEntre = await axios.get(entretePorts.value);
        entrete.value = resEntre.data.reverse();


    } catch (error) {
        console.error(error);
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
    postsEee();

});


const anuncioLado=ref(false)


</script>

<template>
    <div class=" lg:grid md:grid-cols-6 lg:gap-4 lg:max-xl dark:bg-gray-950 ">
                                                    <!-- parte de cards -->
            <div class="mx-5 lg:col-span-4 lg:ml-5 mt-3">
                    <div class="pt-2">
                        <strong>
                        <h1 class=" hover:bg-gray-950 hover:text-gray-50 text-center text-2xl font-bold text-gray-900 sm:text-3xl border-y-2 border-red-600 p-4 dark:text-neutral-100">Últimas Notícias</h1>
                    </strong>
                    </div>
                <!-- inicio dos cards -->
                <div class="lg:grid lg:grid-cols-4 gap-6 mt-2">

                    <!-- inicio coluna 1 -->
                        <div class="col-span-4">
                            <!-- inicio dos cards local -->
                            <div class="flex flex-row flex-wrap space-x-0.5">
                                <div v-for="(p, index) in locais.slice(0, 2)" :key="p.id"
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

                                <!-- inicio dos cards politica -->
                                <div v-for="(p, index) in politica.slice(0, 2)" :key="p.id"
                                     class="container min-w-72 p-4 mb-4  max-w-80 block justify-items-center rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
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
                                </div> <!-- fim dos cards politica-->

                                <!-- inicio dos cards politica -->
                                <div v-for="(p, index) in economia.slice(0, 2)" :key="p.id"
                                     class="container min-w-72 p-4 mb-4  max-w-80 block justify-items-center rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
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
                                </div> <!-- fim dos cards politica-->

                            </div>

                        </div>


                </div>

                            <div>
                                    <div>
                                        <a :href="route('nnacionais')" :active="route().current('nnacionais')">
                                        <h1 class=" hover:bg-gray-950 hover:text-gray-50 text-center text-2xl font-bold text-gray-900 sm:text-3xl border-y-2 border-red-600 p-4 mt-5 dark:text-neutral-100">Notícias Local</h1>
                                        </a>
                                        <!-- inicio dos cards -->
                                        <div class="grid grid-cols-4 gap-6 mt-2">

                                            <!-- inicio coluna 1 -->
                                            <div class="col-span-4">
                                                <!-- inicio dos cards local -->
                                                <div class="flex flex-row flex-wrap">
                                                    <div v-for="(p, index) in locais.slice(0, 6)" :key="p.id"
                                                         class="container min-w-72 p-4 mb-4  max-w-80 block justify-items-center rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
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
                                            </div>

                                        </div>
                                    </div>


                                     <div>
                                         <a :href="route('noticiaslocal')" :active="route().current('noticiaslocal')">
                                         <h1 class="hover:bg-gray-950 hover:text-gray-50 text-center text-2xl font-bold text-gray-900 sm:text-3xl border-y-2 border-red-600 p-4 mt-5 dark:text-neutral-100">Notícias Nacionais</h1>
                                         </a>
                                        <!-- inicio dos cards -->
                                        <div class="grid grid-cols-4 gap-6 mt-2">

                                            <!-- inicio coluna 1 -->
                                            <div class="col-span-4">
                                                <!-- inicio dos cards local -->
                                                <div class="flex flex-row flex-wrap">
                                                    <div v-for="(p, index) in nacionais.slice(0, 6)" :key="p.id"
                                                         class="container min-w-72 p-4 mb-4  max-w-80 block justify-items-center rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
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
                                                </div>

                                        </div>
                                    </div>

                                    <div>
                                        <a :href="route('politica')" :active="route().current('politica')">
                                        <h1 class="hover:bg-gray-950 hover:text-gray-50 text-center text-2xl font-bold text-gray-900 sm:text-3xl border-y-2 border-red-600 p-4 mt-5 dark:text-neutral-100">Política</h1>
                                        </a>

                                        <!-- inicio dos cards -->
                                        <div class="grid grid-cols-4 gap-6 mt-2">

                                            <!-- inicio coluna 1 -->
                                            <div class="col-span-4">
                                                <!-- inicio dos cards local -->
                                                <div class="flex flex-row flex-wrap">
                                                    <div v-for="(p, index) in politica.slice(0, 6)" :key="p.id"
                                                         class="container min-w-72 p-4 mb-4  max-w-80 block justify-items-center rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
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
                                            </div>


                                        </div>
                                    </div>
                                    <div>
                                        <a :href="route('economia')" :active="route().current('economia')">
                                        <h1 class=" hover:bg-gray-950 hover:text-gray-50 text-center text-2xl font-bold text-gray-900 sm:text-3xl border-y-2 border-red-600 p-4 mt-5 dark:text-neutral-100">Economia</h1>
                                        </a>

                                        <!-- inicio dos cards -->
                                        <div class="grid grid-cols-4 gap-6 mt-2">

                                            <!-- inicio coluna 1 -->
                                            <div class="col-span-4">
                                                <!-- inicio dos cards -->
                                                <div class="flex flex-row flex-wrap">
                                                    <div v-for="(p, index) in economia.slice(0, 6)" :key="p.id"
                                                         class="container min-w-72 p-4 mb-4  max-w-80 block justify-items-center rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
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
                                                    </div> <!-- fim dos cards -->
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                                <!-- inicio dos cards esportes-->
                                    <div>
                                        <a :href="route('esportes')" :active="route().current('esportes')">
                                        <h1 class="hover:bg-gray-950 hover:text-gray-50 text-center text-2xl font-bold text-gray-900 sm:text-3xl border-y-2 border-red-600 p-4 mt-5 dark:text-neutral-100">Esportes</h1>
                                        </a>

                                        <!-- inicio dos cards -->
                                        <div class="grid grid-cols-4 gap-6 mt-2">

                                            <!-- inicio coluna 1 -->
                                            <div class="col-span-4">
                                                <!-- inicio dos cards local -->
                                                <div class="flex flex-row flex-wrap">
                                                    <div v-for="(p, index) in esportes.slice(0, 6)" :key="p.id"
                                                         class="container min-w-72 p-4 mb-4  max-w-80 block justify-items-center rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
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
                                            </div>


                                        </div>
                                    </div>

                                    <div>
                                        <a
                                            :href="route('entretenimento')" :active="route().current('entretenimento')" >
                                        <h1 class="hover:bg-gray-950 hover:text-gray-50 text-center text-2xl font-bold text-gray-900 sm:text-3xl border-y-2 border-red-600 p-4 mt-5">Entretenimento</h1>
                                        </a>
                                        <!-- inicio dos cards -->
                                        <div class="grid grid-cols-4 gap-6 mt-2">

                                            <!-- inicio coluna 1 -->
                                            <div class="col-span-4">
                                                <!-- inicio dos cards local -->
                                                <div class="flex flex-row flex-wrap">
                                                    <div v-for="(p, index) in entrete.slice(0, 6)" :key="p.id"
                                                         class="container min-w-72 p-4 mb-4  max-w-80 block justify-items-center rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
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
                                            </div>


                                        </div>
                                    </div>


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

</template>
<style scoped>

</style>
