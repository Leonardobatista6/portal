<script setup>
import HeadPortal from '@/Components/HeadPortal.vue';
import FooterPortal from '@/Components/FooterPortal.vue';


</script>

<template>

    <head-portal></head-portal>
    <slot name="conteudo"/>
    <slot name="politica"/>
    <slot name="economia"/>
    <slot name="esportes"/>
    <slot name="noticiasnacionais"/>
    <slot name="publicacao"></slot>
    <footer-portal></footer-portal>

</template>
<style scoped>

</style>
