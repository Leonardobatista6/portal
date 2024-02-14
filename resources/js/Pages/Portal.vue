<script setup>
import LayoutPortal from '@/Layouts/LayoutPortal.vue';
import Conteudos from "@/Components/Conteudos.vue";

</script>

<template>
    <layout-portal>
        <template v-slot:conteudo>
            <conteudos></conteudos>
        </template>
    </layout-portal>
</template>

<style>

</style>
