<script setup>
import LayoutPortal from '@/Layouts/LayoutPortal.vue';
import {ref, onMounted, onBeforeMount} from 'vue';
import axios from "axios";

const gif=ref('http://127.0.0.1:8000/storage/imagens/1795987640927998.png')

defineProps({
   post: Array,
});

const noticia = ref([]);

const anuncioLado=ref([])
const anuncioPost=ref([])


onMounted(() => {
    console.log('Dados recebidos do backend:', post);
    noticia.value = post;
    console.log('Valor de noticia:', noticia.value);
});

onBeforeMount(() => {
    axios.get('http://127.0.0.1:8000/publicidade/getlado')
        .then(response => {
            anuncioLado.value = response.data.reverse();
        })
        .catch(error => {
            console.error('Erro ao obter imagens:', error);
        });

    // Obter a imagem principal
    axios.get('http://127.0.0.1:8000/publicidade/getpost')
        .then(response => {
            anuncioPost.value = response.data.reverse();
        })
        .catch(error => {
            console.error('Erro ao obter imagens:', error);
        });
});

</script>

<template>
    <layout-portal>
        <template v-slot:publicacao>

            <div class=" lg:grid md:grid-cols-6 lg:gap-4 lg:max-xl dark:bg-gray-950 ">
                <!-- parte de cards -->
                <div class="mx-5 lg:col-span-4 lg:ml-5 mt-3">

                        <!-- inicio dos cards -->
                        <div class="lg:grid lg:grid-cols-4 gap-6 mt-2">

                            <!-- inicio coluna 1 -->
                            <div class="col-span-4">

                                <!-- tag do anuncio da publicação 900x150 -->
                                <img :src="anuncioPost" class="pb-4 mx-auto`">

                                <div v-html="post.conteudo" class="md:ml-6"></div>

                            </div>

                        </div>  <!-- fim da coluna -->

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
    </layout-portal>
</template>

<style>

</style>
