<script>
import { onBeforeMount, ref, computed } from 'vue';
import axios from "axios";
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {
        AppLayout,
    },

    setup() {
        // Declaração das variáveis reativas
        const file = ref(null);
        const filePrincipal = ref(null);
        const imagensUrls = ref([]);
        const imgprincipal = ref([]);
        const currentPage = ref(1);
        const perPage = ref(10); // Número de itens por página
        const currentPagePrincipal = ref(1);

        // Função para calcular o total de páginas
        const totalPages = computed(() => Math.ceil(imagensUrls.value.length / perPage.value));
        const totalPagesPrincipal = computed(() => Math.ceil(imgprincipal.value.length / perPage.value));

        // Função para retornar os itens da página atual
        const paginatedImagensUrls = computed(() => {
            const start = (currentPage.value - 1) * perPage.value;
            const end = start + perPage.value;
            return imagensUrls.value.slice(start, end);
        });

        const paginatedImgprincipal = computed(() => {
            const start = (currentPagePrincipal.value - 1) * perPage.value;
            const end = start + perPage.value;
            return imgprincipal.value.slice(start, end);
        });

        const carregarImagens = async () => {
            try {
                const response = await axios.get('http://127.0.0.1:8000/file/imgprincipal');
                imgprincipal.value = response.data.reverse()
            } catch (error) {
                console.error('Erro ao carregar imagens:', error);
            }
            try {
                const response = await axios.get('http://127.0.0.1:8000/file/getimagens');
                imagensUrls.value = response.data.reverse()
            } catch (error) {
                console.error('Erro ao carregar imagens:', error);
            }
        };

        // Chamada à API para carregar as imagens
        onBeforeMount(async () => {
            try {
                const imagensResponse = await axios.get('http://127.0.0.1:8000/file/getimagens');
                imagensUrls.value = imagensResponse.data.reverse();

                const imgPrincipalResponse = await axios.get('http://127.0.0.1:8000/file/imgprincipal');
                imgprincipal.value = imgPrincipalResponse.data.reverse();
            } catch (error) {
                console.error('Erro ao obter imagens:', error);
            }
        });

        // Funções para navegar entre páginas
        const nextPage = () => {
            if (currentPage.value < totalPages.value) {
                currentPage.value++;
            }
        };

        const nextPagePrincipal = () => {
            if (currentPagePrincipal.value < totalPagesPrincipal.value) {
                currentPagePrincipal.value++;
            }
        };

        const previousPage = () => {
            if (currentPage.value > 1) {
                currentPage.value--;
            }
        };

        const previousPagePrincipal = () => {
            if (currentPagePrincipal.value > 1) {
                currentPagePrincipal.value--;
            }
        };

        // Funções para manipular as imagens
        const deletarImg = async (imageUrl) => {
            try {
                if (confirm('Tem certeza que deseja excluir esta imagem?')) {
                    const nomeArquivo = imageUrl.split('/').pop();
                    await axios.delete(`/file/${nomeArquivo}`);
                    imagensUrls.value = imagensUrls.value.filter(image => image !== imageUrl);
                }
            } catch (error) {
                console.error('Erro ao excluir a imagem:', error.message);
            }
        };

        const imgPrincipal = async (imagempath) => {
            try {
                if (confirm('Tem certeza que deseja excluir esta imagem?')) {
                    const nomeArquivo = imagempath.split('/').pop();
                    await axios.delete(`/principal/${nomeArquivo}`);
                    imgprincipal.value = imgprincipal.value.filter(imageUrl => imageUrl !== imagempath);
                }
            } catch (error) {
                console.error('Erro ao excluir a imagem:', error.message);
            }
        };

        const handleFileChange = (event) => {
            file.value = event.target.files[0];
        };

        const handleFile = (event) => {
            filePrincipal.value = event.target.files[0];
        };

        // Envio de arquivos
        const enviar = async () => {
            try {
                const formData = new FormData();
                formData.append('imagem', file.value);
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (csrfToken) {
                    formData.append('X-CSRF-TOKEN', csrfToken.content);
                }
                const response = await axios.post('/file', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                alert(response.data.message);
                document.getElementById('inputv').value = '';
                carregarImagens();

            } catch (error) {
                console.error('Erro ao enviar a imagem', error);
            }
        };

        // Publicação de imagem principal
        const publicar = async () => {
            try {
                const formData = new FormData();
                formData.append('imagem', filePrincipal.value);
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (csrfToken) {
                    formData.append('X-CSRF-TOKEN', csrfToken.content);
                }
                const response = await axios.post('/file/principal', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                alert(response.data.message);
                // Limpar o input e o formulário após o envio bem-sucedido
                document.getElementById('filePrincipalInput').value = '';
                carregarImagens();
            } catch (error) {
                console.error('Erro ao enviar a imagem', error);
                alert(response.data.message);
            }
        };

        // Retornando os dados e funções necessárias para o template
        return {
            imagensUrls,
            imgprincipal,
            paginatedImagensUrls,
            paginatedImgprincipal,
            perPage,
            nextPage,
            nextPagePrincipal,
            previousPage,
            previousPagePrincipal,
            totalPages,
            totalPagesPrincipal,
            deletarImg,
            imgPrincipal,
            handleFileChange,
            handleFile,
            enviar,
            publicar
        };
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
        <div class="md:grid md:grid-cols-2 justify-between">

            <div class="md:py-12 md:col-span-1">  <!-- input  imagens post -->
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <h2 class="text-center mb-2"> <strong> Imagens Variadas</strong> </h2>
                        <div class="flex flex-row justify-center  mx-6 items-center">
                            <input type="file" id="inputv" class="" @change="handleFileChange">
                            <button type="submit" name="imagem" class="inline ml-6 rounded bg-blue-600 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                                    @click="enviar()">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:py-12 md:col-span-1 pt-6 pb-6"> <!--  input imagem principal -->
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <h2 class="text-center mb-2"> <strong> Imagem Principal</strong> </h2>
                        <div class="flex flex-row justify-center mx-6">
                            <input type="file" id="filePrincipalInput" @change="handleFile">
                            <button type="submit" name="imagem" class="inline ml-6 rounded bg-blue-600 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                                    @click="publicar()">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>



        <!-- Lista de imagens laterais -->
    <div class="md:grid md:grid-cols-2 justify-between">
        <div class="md:col-span-1" > <h1 class="text-center text-gray-50 text-2xl bg-slate-900 pb-4 pt-4">Imagens Variadas</h1>
            <div v-if="imagensUrls.length > 0" class="md:col-span-1 md:flex md:flex-wrap md:justify-center">
                <div v-for="(imageUrl, index) in paginatedImagensUrls" :key="index" class=" mr-2 min-w-72 p-4 max-w-80 ">
                    <img class="min-w-80 max-w-52 pb-1" :src="imageUrl" alt="Imagem" />
                    <a
                        class="inline-block rounded border border-indigo-600 bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-red-600 hover:text-slate-50 focus:outline-none focus:ring active:text-slate-50"
                        href="#"
                        @click="deletarImg(imageUrl)"
                    >
                        Excluir
                    </a>
                </div>

                <!-- Controles de paginação -->
                <div class="flex justify-center mt-4 mb-10">
                    <button @click="previousPage" :disabled="currentPage === 1" class="mr-2 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded">
                        Anterior
                    </button>
                    <button @click="nextPage" :disabled="currentPage === totalPages" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded">
                        Próximo
                    </button>
                </div>
            </div>
        </div>


            <!-- Lista de imagens principais -->
        <div class="md:col-span-1 justify-between ml-3">
            <div class="md:col-span-1"> <h1 class="text-center text-gray-50 text-2xl bg-slate-900 pb-4 pt-4">Imagens Principal</h1>
                <div v-if="imgprincipal.length > 0" class="md:col-span-1 md:flex md:flex-wrap md:justify-center">
                    <div v-for="(imagempath, index) in paginatedImgprincipal" :key="index" class="mr-2 mb-2 container min-w-72 p-4 mb-4 max-w-80 block ">
                        <img class="min-w-80 max-w-52 pb-1" :src="imagempath" alt="Imagem" />
                        <a
                            class="inline-block rounded border border-indigo-600 bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-red-600 hover:text-slate-50 focus:outline-none focus:ring active:text-slate-50"
                            href="#"
                            @click="imgPrincipal(imagempath)"
                        >
                            Excluir
                        </a>
                    </div>

                    <!-- Controles de paginação -->
                    <div class="flex justify-center mt-4 mb-10">
                        <button @click="previousPagePrincipal" :disabled="currentPagePrincipal === 1" class="mr-2 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded">
                            Anterior
                        </button>
                        <button @click="nextPagePrincipal" :disabled="currentPagePrincipal === totalPagesPrincipal" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded">
                            Próximo
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </AppLayout>
</template>
