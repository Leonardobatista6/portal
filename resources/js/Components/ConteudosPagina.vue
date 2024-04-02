<script setup>

import {onBeforeMount, onBeforeUpdate, ref} from "vue";
import axios from "axios";

const urlPorts = ref('http://127.0.0.1:8000/publicacao');
let ports = ref([]);

const carregaPosts = async () => {
    try {
        const response = await axios.get(urlPorts.value);
        ports.value = response.data;
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

<div>

            <!-- inicio coluna de cards  -->
           <div class="grid grid-cols-6 gap-4 ml-10 ">
               <div class="col-span-4 mt-3">
                   <div>
                       <h1 class="text-center text-2xl ">Ultimas noticias</h1>
                   </div>


                </div>
               <!-- inicio anuncios  -->
               <div class="col-span-2 bg-indigo-600 mx-6 mt-3 items-center">
                   <div class="">
                       <h2 class="text-center">Anuncios</h2>
                           <div class="" >
                               <img src="https://picsum.photos/seed/picsum/300/500" class="mx-auto" >

                           </div>
                   </div>
               </div>
           </div>



</div>
</template>

<style>

</style>
