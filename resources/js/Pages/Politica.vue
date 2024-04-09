<script setup>
import LayoutPortal from "@/Layouts/LayoutPortal.vue";
import axios from "axios";
import {onBeforeMount, onBeforeUpdate, ref} from "vue";

const urlPorts = ref('http://127.0.0.1:8000/api/politica');
let ports = ref([]);

const carregaPosts = async () => {
    try {
        const response = await axios.get(urlPorts.value);
        ports.value = response.data.reverse();
        console.log(ports.value);
    } catch (error) {
        console.error(error);
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
    <layout-portal>
        <template v-slot:esportes>
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
                            Some quick example text to build on the card title and make up the
                            bulk of the card's content.
                        </p>
                    </div>
                </div> <!-- fim dos cards -->
            </div>
        </template>
    </layout-portal>
</template>

<style scoped>

</style>
