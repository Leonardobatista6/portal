<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

import axios from "axios";
import {onBeforeMount, onBeforeUpdate, ref} from "vue";

const urlPorts = ref('http://127.0.0.1:8000/publi');
const ports = ref([]);

const deletarPost = async (postId) => {
    try {
        if (confirm('Tem certeza que deseja excluir este post?')) {
            await axios.delete(`/publi/${postId}`);
            carregaPosts();
            // Atualizar a lista de postagens após a exclusão, se necessário
        }
    } catch (error) {
        console.error('Erro ao excluir o post:', error.message);
    }
};

const carregaPosts = async () => {
    try {
        const response = await axios.get(urlPorts.value);
        ports.value = response.data.reverse();
    } catch (error) {
            console.error('Erro na requisição:', error.message);
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
                        :src="p.imagem_url"
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
                        {{p.sub_titulo}}
                    </p>
                </div>
                <button @click="deletarPost(p.id)">Excluir</button>
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
