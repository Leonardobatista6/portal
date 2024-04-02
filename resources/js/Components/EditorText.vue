<script setup>
import { RichTextEditorComponent as EjsRichtexteditor,Toolbar,Link,Image,HtmlEditor,Video,QuickToolbar,FileManager } from "@syncfusion/ej2-vue-richtexteditor";
import { provide,ref } from "vue";

import { registerLicense } from '@syncfusion/ej2-base';
import axios from "axios";
registerLicense('Ngo9BigBOggjHTQxAR8/V1NAaF1cXmhIfEx1RHxQdld5ZFRHallYTnNWUj0eQnxTdEFjW31fcXRXRGNfVUB1XA==');

const titulo = ref('');
const sub = ref('');
const categoria = ref('');
const subTitulo = ref('');
const imagemUrl = ref('');
const rteInstance = ref('');
const imagensIncorporadas = ref([]);
const post = ref("");


const richtexteditor =  [Toolbar, Link, Image, HtmlEditor,Video,QuickToolbar,FileManager];
const toolbarSettings= {
    items:['image']
}

const insertImageSettings = {
    display: 'inline',
    saveUrl: 'http://127.0.0.1:8000/file',
    path: 'http://127.0.0.1:8000/public/imagens',
    success: (args) => {
        // Certifique-se de que args.file existe e contém as propriedades corretas
        if (args.file && args.file.rawFile) {
            imagensIncorporadas.value.push({ file: args.file.rawFile });
        }
    },
};

const insertVideoSettings = {
    display: 'inline',
    saveUrl: '',
    removeUrl: '',
};

provide('richtexteditor', richtexteditor);



// Método para salvar imagens separadamente
const salvarImagens = async () => {
    try {
        console.log('imagensIncorporadas:', imagensIncorporadas.value);

        const requests = imagensIncorporadas.value.map(async (imagem) => {
            console.log('Enviando imagem:', imagem.file);

            const formData = new FormData();
            formData.append("imagem", imagem.file);

            const response = await axios.post('http://127.0.0.1:8000/file', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    // Adicione outros cabeçalhos necessários aqui, se houver
                }
            });

            console.log('Resposta do Laravel:', response.data);
        });

        await Promise.all(requests);
    } catch (error) {
        console.error('Erro ao salvar imagens:', error);
    }
};



        // Método para salvar o post
        const salvar = async () => {
            try {
                const formData = new FormData();
                formData.append('categoria', categoria.value);
                formData.append('titulo', titulo.value);
                formData.append('conteudo', post.value);
                formData.append('sub_titulo', subTitulo.value);
                formData.append('imagem_url', imagemUrl.value);

                const response = await axios.post('/salvar-conteudo', formData);

                console.log('Salvo com sucesso');

                alert(response.data.message);

               //  Após salvar o post, salve as imagens incorporadas, se houver
              //  if (imagensIncorporadas.value.length > 0) {
              //      await salvarImagens();
              //     imagensIncorporadas.value = []; // Limpa a lista após salvar
              //  }
            } catch (error) {
                console.error('Erro ao salvar:', error);
           }
           // reload();
             this.$router.push('/dashboard');

        };

        const reload = () => {
            location.reload();
        };

</script>

<template>
    <div class="flex-row justify-center mx-40 bg-gray-100">
        <div class="flex space-x-4 justify-items-center my-6 ">
            <div class="items-center mx-auto space-x-10  ">
                <label class="text-lg text-stone-950">Categoria:{{categoria}}</label>
                <select data-te-select-init class="mx-6" v-model="categoria">
                    <option value=""></option>
                    <option value="1">Noticias Nacionais</option>
                    <option value="2">Politica</option>
                    <option value="3">Economia</option>
                    <option value="4">Esportes</option>
                </select>
                <input type="text" placeholder="Digite o titulo do post" v-model="titulo">
                <button
                    type="submit" @click="salvar()"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    class="inline-block rounded bg-blue-600 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                    Publicar
                </button>
            </div>
        </div>
        <h2 class="text-center mb-2"> <strong> Titulo do Post</strong> </h2>
        <h1 class="text-lg text-center text-stone-950 mb-2">{{titulo}}</h1>
        <div>
            <input type="text" placeholder="Digite o sub titulo do post" v-model="subTitulo">

            <input class="mx-6" type="text" placeholder="cole o link da imagem principal" v-model="imagemUrl">
        <div>
            <h2 class="text-center mb-2"> <strong> Sub Titulo do Post</strong> </h2>

            <h1 class="text-lg text-center text-stone-950 mb-2">{{subTitulo}}</h1>

        </div>

            <div class="control-section">
                <div class="sample-container;">
                    <div class="default-section">
                        <ejs-richtexteditor id="default" v-model="post" :insertVideoSettings = "insertVideoSettings"
                                            ref="rteObj"
                                            :insertImageSettings="insertImageSettings"
                        ></ejs-richtexteditor>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>

@import "././node_modules/@syncfusion/ej2-base/styles/material.css";
@import "././node_modules/@syncfusion/ej2-inputs/styles/material.css";
@import "././node_modules/@syncfusion/ej2-lists/styles/material.css";
@import "././node_modules/@syncfusion/ej2-popups/styles/material.css";
@import "././node_modules/@syncfusion/ej2-buttons/styles/material.css";
@import "././node_modules/@syncfusion/ej2-navigations/styles/material.css";
@import "././node_modules/@syncfusion/ej2-splitbuttons/styles/material.css";
@import "././node_modules/@syncfusion/ej2-vue-richtexteditor/styles/material.css";
</style>
