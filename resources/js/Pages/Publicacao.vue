<script setup>
import LayoutPortal from '@/Layouts/LayoutPortal.vue';
import { ref, onMounted } from 'vue';

defineProps({
   dadosDoBackend: Array,
});


</script>

<template>
    <layout-portal>
        <template v-slot:publicacao>
            <div class="mx-6">
              <strong> <h1 class="text-2xl text-center py-4" v-html="dadosDoBackend.titulo"></h1> </strong>
                <div v-html="dadosDoBackend.conteudo"></div>
            </div>
        </template>
    </layout-portal>
</template>

<style>

</style>
