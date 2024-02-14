<script setup>
import LayoutPortal from "@/Layouts/LayoutPortal.vue";
import ConteudosPagina from "@/Components/ConteudosPagina.vue";

</script>


<template>
    <layout-portal>
        <template v-slot:esportes>
            <conteudos-pagina></conteudos-pagina>
        </template>
    </layout-portal>
</template>

<style scoped>

</style>
