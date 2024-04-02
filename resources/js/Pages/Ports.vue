<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from "@/Components/Welcome.vue";

import axios from "axios";
import {onBeforeMount, onBeforeUpdate, ref} from "vue";

const urlPorts = ref('http://127.0.0.1:8000/api/ports');
let ports = ref([]);

const carregaPosts = async () => {
    try {
        const response = await axios.get(urlPorts.value);
        ports.value = response.data;
        console.log(ports.value);
    } catch (error) {
        if (error.response && error.response.status === 401) {
            console.error('Usuário não autenticado');
            // Faça aqui o tratamento necessário para redirecionar para a página de login ou exibir uma mensagem adequada.
        } else {
            console.error('Erro na requisição:', error.message);
        }
    }
};

const onVisit = () => {
    console.log('Página visitada');
    carregaPosts();
};

onBeforeMount(() => {
    console.log('Componente está prestes a ser montado no DOM usando onBeforeMount');
    carregaPosts();
});

onBeforeUpdate(() => {
    console.log('Componente está prestes a ser atualizado usando onBeforeUpdate');
    // Chame carregaPosts aqui se necessário antes da atualização
});


</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Meus Ports
            </h2>
        </template>

        <div class="flex flex-row flex-wrap ">
            <div v-for="p in ports" :key="p.id"
                 class=" w-1/4 p-4 mb-4 block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                <div
                    class="relative overflow-hidden bg-cover bg-no-repeat"
                    data-te-ripple-init
                    data-te-ripple-color="light">
                    <img
                        class="rounded-t-lg"
                        src="https://tecdn.b-cdn.net/img/new/standard/nature/186.jpg"
                        alt="" />
                    <a href="#!">
                        <div
                            class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-[hsla(0,0%,98%,0.15)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100"></div>
                    </a>
                </div>
                <div class=" mx-2 w-60 p-6">
                    <h5
                        class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                        {{p.titulo}}
                    </h5>
                    <p class="text-base text-neutral-600 dark:text-neutral-200">
                        Some quick example text to build on the card title and make up the
                        bulk of the card's content.
                    </p>
                </div>
            </div> <!-- fim dos cards -->
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                </div>
            </div>
        </div>
    </AppLayout>
</template>
