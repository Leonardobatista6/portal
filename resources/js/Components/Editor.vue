<script setup>
import  QuillEditor  from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
</script>

<template >


        <QuillEditor toolbar="#my-toolbar" >
            <template #toolbar>
                <div id="my-toolbar">
                    <!-- Add buttons as you would before -->
                    <button class="ql-bold"></button>
                    <button class="ql-italic"></button>

                    <!-- But you can also add your own -->
                    <button id="custom-button"></button>
                </div>
            </template>
        </QuillEditor>

</template>
<style scoped>

</style>
