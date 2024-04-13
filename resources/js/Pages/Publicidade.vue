<script >

import AppLayout from '@/Layouts/AppLayout.vue';
import {onBeforeMount, ref} from 'vue';
import axios from "axios";

// Declare a variável reativa 'file'
const file = ref(null);

const filePrincipal = ref(null);

const imagensUrls = ref([]);
const imgprincipal = ref([]);

const carregarImagens = async () => {
    try {
        const response = await axios.get('http://127.0.0.1:8000/publicidade/getlado');
        imagensUrls.value = response.data.reverse()
    } catch (error) {
        console.error('Erro ao carregar imagens:', error);
    }
    try {
        const response = await axios.get('http://127.0.0.1:8000/publicidade/getpost');
        imgprincipal.value = response.data.reverse()
    } catch (error) {
        console.error('Erro ao carregar imagens:', error);
    }
};

export default {
    components: {
        AppLayout,
    },

    setup() {
        onBeforeMount(() => {
            axios.get('http://127.0.0.1:8000/publicidade/getlado')
                .then(response => {
                    imagensUrls.value = response.data.reverse();
                })
                .catch(error => {
                    console.error('Erro ao obter imagens:', error);
                });

            // Obter a imagem principal
            axios.get('http://127.0.0.1:8000/publicidade/getpost')
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

                    await axios.delete(`http://127.0.0.1:8000/publicidade/${nomeArquivo}`);
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
                    await axios.delete(`/publipost/${nomeArquivo}`);

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
        // Método para enviar o anuncio lado
        async enviar() {
            try {
                const formData = new FormData();
                formData.append('imagem', this.file);

                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (csrfToken) {
                    formData.append('X-CSRF-TOKEN', csrfToken.content);
                }

                const response = await axios.post('/publicidade/lado', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });

                alert(response.data.message);
                document.getElementById('input1').value = '';
                carregarImagens()
            } catch (error) {
                console.error('Erro ao enviar a imagem', error);
            }
        },

        // função para anuncio post
        async publicar() {
            try {
                const formData = new FormData();
                formData.append('imagem', this.filePrincipal);

                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (csrfToken) {
                    formData.append('X-CSRF-TOKEN', csrfToken.content);
                }

                const response = await axios.post('/publicidade/post', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });

                //   console.log('Salvo com sucesso', response.data);
                alert(response.data.message);
                document.getElementById('input2').value = '';
                carregarImagens()
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
                Imagens Anuncios
            </h2>
        </template>

        <!--   inicio dos inputs -->
        <div class="md:grid md:grid-cols-2 justify-between">

            <div class="md:py-12 md:col-span-1">  <!-- input  imagens post -->
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <h2 class="text-center mb-2"> <strong> Publicidade Lateral</strong> </h2>
                        <div class="flex flex-row justify-center  mx-6 items-center">
                            <input type="file" id="input1" class="" @change="handleFileChange">
                            <button type="submit" name="imagem" class="inline ml-6 rounded bg-blue-600 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                                    @click="enviar()">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:py-12 md:col-span-1 pt-6 pb-6"> <!--  input imagem principal -->
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <h2 class="text-center mb-2"> <strong>  Publicidade Post</strong> </h2>
                        <div class="flex flex-row justify-center mx-6">
                            <input type="file" id="input2" class="" @change="handleFile">
                            <button type="submit" name="imagem" class="inline ml-6 rounded bg-blue-600 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                                    @click="publicar()">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!--   inicio das imagens -->

        <div class="md:grid md:grid-cols-2 gap-2 pt-6">

            <div class="md:col-span-1">
                <h2 class="text-center text-2xl">Anuncios lateral </h2>
                <div class="flex flex-wrap justify-center mx-4 pt-6">
                    <div v-for="imagempath in imagensUrls" :key="imagempath" class="mr-2 mb-2">
                        <img class="min-w-80 max-w-52 pb-1" :src="imagempath" alt="Imagem" />
                        <a
                            class="inline-block rounded border border-indigo-600 bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-red-600 hover:text-slate-50 focus:outline-none focus:ring active:text-slate-50"
                            href="#"
                            @click="deletarImg(imagempath)"
                        >
                            Excluir
                        </a>
                    </div>
                </div>

            </div>

            <div class=" md:col-span-1 pt-10">
                <h2 class="text-center text-2xl">Anuncios Post </h2>
                <div class="flex flex-wrap justify-center mx-4 pt-6">
                    <div v-for="imagemUrl in imgprincipal" :key="imagemUrl" class="mr-2 mb-2">
                        <img class="min-w-80 max-w-52 pb-1" :src="imagemUrl" alt="Imagem" />
                        <a
                            class="inline-block rounded border border-indigo-600 bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-red-600 hover:text-slate-50 focus:outline-none focus:ring active:text-slate-50"
                            href="#"
                            @click="imgPrincipal(imagemUrl)"
                        >
                            Excluir
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </AppLayout>
</template>
