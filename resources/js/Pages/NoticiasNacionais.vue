<template>
    <layout-portal>
        <template v-slot:economia>
            <div class="flex flex-row flex-wrap mx-4">
                <div v-for="p in displayedPorts" :key="p.id"
                     class="container min-w-72 p-4 mb-4  max-w-80 block justify-items-center rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                    <div
                        class="relative overflow-hidden bg-cover bg-no-repeat"
                        data-te-ripple-init
                        data-te-ripple-color="light">
                        <img
                            class="rounded-t-lg min-w-72 max-w-80 mb-2"
                            :src="p.imagem_url"
                            alt="" />
                        <a href="#">
                            <div
                                class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-[hsla(0,0%,98%,0.15)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100"></div>
                        </a>
                    </div>
                    <div class=" min-w-72 max-w-80">
                        <h5
                            class=" min-w-64 max-w-80 max-h-28 min-h-20 pb-2  text-xl font-family:Times New Roman leading-tight text-neutral-800 dark:text-neutral-50">
                            <strong> {{p.titulo}} </strong>
                        </h5>
                        <p class=" min-w-72 max-w-80 max-h-28 min-h-20 font-family:Times New Roman text-base text-neutral-600 dark:text-neutral-200">
                            {{ p.sub_titulo }}
                        </p>
                    </div>
                </div> <!-- fim dos cards -->
            </div>
            <!-- Botões de navegação da página -->
            <div v-if="pageCount > 1" class="flex justify-center mt-4">
                <button
                    @click="handlePrev"
                    :disabled="currentPage === 1"
                    class="px-3 py-1 mr-2 rounded text-gray-800 bg-slate-200  hover:text-white hover:bg-slate-900 focus:outline-none"
                >
                    Anterior
                </button>
                <button
                    @click="handleNext"
                    :disabled="currentPage === pageCount"
                    class="px-3 py-1 rounded text-gray-800 bg-slate-200 hover:text-white hover:bg-slate-900 focus:outline-none"
                >
                    Próximo
                </button>
            </div>
        </template>
    </layout-portal>
</template>

<script setup>
import { onBeforeMount, ref, computed } from "vue";
import LayoutPortal from "@/Layouts/LayoutPortal.vue";
import axios from "axios";

const urlPorts = ref('http://127.0.0.1:8000/api/noticiasnacionais');
let ports = ref([]);
const currentPage = ref(1);
const perPage = 4;

const carregaPosts = async () => {
    try {
        const response = await axios.get(urlPorts.value);
        ports.value = response.data.reverse();
    } catch (error) {
        console.error(error);
    }
};

const pageCount = computed(() => {
    return Math.ceil(ports.value.length / perPage);
});

const displayedPorts = computed(() => {
    const start = (currentPage.value - 1) * perPage;
    const end = start + perPage;
    return ports.value.slice(start, end);
});

const handlePrev = () => {
    if (currentPage.value > 1) {
        currentPage.value -= 1;
    }
};

const handleNext = () => {
    if (currentPage.value < pageCount.value) {
        currentPage.value += 1;
    }
};

onBeforeMount(() => {
    carregaPosts();
});

</script>
