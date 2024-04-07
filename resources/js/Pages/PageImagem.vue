<script >

import AppLayout from '@/Layouts/AppLayout.vue';
import {onBeforeMount, ref} from 'vue';
import axios from "axios";

// Declare a variável reativa 'file'
const file = ref(null);

const filePrincipal = ref(null);

const imagensUrls = ref([]);
const imgprincipal = ref([]);


export default {
    components: {
        AppLayout,
    },

    setup() {
        onBeforeMount(() => {
            axios.get('http://127.0.0.1:8000/file/getimagens')
                .then(response => {
                    imagensUrls.value = response.data.reverse();
                })
                .catch(error => {
                    console.error('Erro ao obter imagens:', error);
                });

            // Obter a imagem principal
            axios.get('http://127.0.0.1:8000/file/imgprincipal')
                .then(response => {
                    imgprincipal.value = response.data.reverse();
                })
                .catch(error => {
                    console.error('Erro ao obter imagens:', error);
                });
        });

        return { file, imagensUrls,imgprincipal};
    },
    data() {
        return {
            // Declare 'file' como uma variável de dados
            file: null,
        };
    },
    methods: {
         async deletarImg (imagempath) {
             try {
                 if (confirm('Tem certeza que deseja excluir esta imagem?')) {
                     const nomeArquivo = imagempath.split('/').pop();

                     await axios.delete(`/file/${nomeArquivo}`);
                     // Atualize a lista de imagens após a exclusão, se necessário
                     imagensUrls.value = imagensUrls.value.filter(imageUrl => imageUrl !== imagempath); // Atualiza a lista de imagens
                 }
             } catch (error) {
                 console.error('Erro ao excluir a imagem:', error.message);
             }
        },

        async imgPrincipal (imagempath) {
            try {
                if (confirm('Tem certeza que deseja excluir esta imagem?')) {
                    const nomeArquivo = imagempath.split('/').pop();
                    await axios.delete(`/principal/${nomeArquivo}`);

                    imgprincipal.value = imgprincipal.value.filter(imageUrl => imageUrl !== imagempath);
                    imgprincipal.value = [...imgprincipal.value]; // Forçar a atualização da lista de imagens
                    console.log('Imagem excluída com sucesso');
                }
            } catch (error) {
                console.error('Erro ao excluir a imagem:', error.message);
            }
        },


        // Método para lidar com a mudança de arquivo
        handleFileChange(event) {
            // Atualize o valor de 'file' quando o usuário selecionar um arquivo
            this.file = event.target.files[0];
        },
        // Método para lidar com a mudança de arquivo
        handleFile(event) {
            // Atualize o valor de 'file' quando o usuário selecionar um arquivo
            this.filePrincipal = event.target.files[0];
        },
        // Método para enviar o arquivo
        async enviar() {
            try {
                const formData = new FormData();
                formData.append('imagem', this.file);

                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (csrfToken) {
                    formData.append('X-CSRF-TOKEN', csrfToken.content);
                }

                const response = await axios.post('/file', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });

             //   console.log('Salvo com sucesso', response.data);
                console.log(response.data)
                alert(response.data.message);
                onBeforeMount();
            } catch (error) {
                console.error('Erro ao enviar a imagem', error);
            }
        },

        // função para imagem principal
        async publicar() {
            try {
                const formData = new FormData();
                formData.append('imagem', this.filePrincipal);

                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (csrfToken) {
                    formData.append('X-CSRF-TOKEN', csrfToken.content);
                }

                const response = await axios.post('/file/principal', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });

                //   console.log('Salvo com sucesso', response.data);
                alert(response.data.message);
                onBeforeMount();
            } catch (error) {
                console.error('Erro ao enviar a imagem', error);
                alert(response.data.message);
            }
        },

    },
};

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Imagens do portal
            </h2>
        </template>

        <!--   inicio dos inputs -->
        <div class="flex flex-row justify-between">

            <div class="py-12">  <!-- input  imagens post -->
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class=" ">
                            <h2 class="text-center mb-2"> <strong> Imagens do post</strong> </h2>
                            <input type="file" @change="handleFileChange">
                            <button type="submit" name="imagem" class="inline ml-6 rounded bg-blue-600 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                                    @click="enviar()">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-12"> <!--  input imagem principal -->
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="flex-row-reverse ">
                            <h2 class="text-center mb-2"> <strong>  Inserir imagem principal</strong> </h2>
                            <input type="file" @change="handleFile">
                            <button type="submit" name="imagem" class="inline ml-6 rounded bg-blue-600 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                                    @click="publicar()">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!--   inicio das imagens -->

        <div class="grid grid-cols-2 gap-2 ">

            <div>
                <h2 class="text-center text-2xl">imagens dos post </h2>
                <div class="flex flex-wrap mx-4">
                    <div v-for="imageUrl in imagensUrls" :key="imageUrl" class="mr-2 mb-2">
                        <img class="min-w-80 max-w-52" :src="imageUrl" alt="Imagem" />
                        <button @click="deletarImg(imageUrl)">Excluir</button>
                       id aqui: {{imageUrl}}
                    </div>
                </div>

            </div>

            <div class="border-r-2 border-indigo-700">
                <h2 class="text-center text-2xl">imagem principal </h2>
                <div class="flex flex-wrap mx-4">
                    <div v-for="imageUrl in imgprincipal" :key="imageUrl" class="mr-2 mb-2">
                        <img class="min-w-80 max-w-52" :src="imageUrl" alt="Imagem" />
                        <button @click="imgPrincipal(imageUrl)">Excluir</button>
                        id aqui: {{imageUrl}}
                    </div>
                </div>

            </div>

        </div>

    </AppLayout>
</template>
