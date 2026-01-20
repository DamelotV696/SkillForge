<script setup>
import { ref, computed, onMounted } from "vue";
import { Head } from '@inertiajs/vue3';
import Navigation from '@/Components/Navigation.vue';
import { api } from "@/services/api"; 

const props = defineProps({
    categories: Array,
    exchangeTypes: Array,
    level: Array,
});

const title = ref('');
const description = ref('');
const category_id = ref('');
const level_id = ref('');
const place_execution = ref('');
const exchange_type_id = ref('');
const price = ref(null);
const image = ref(null);
const imagePreview = ref(null);

const showPriceField = computed(() => {
    return exchange_type_id.value === 2;
});

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
        image.value = file;

        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const removeImage = () => {
    image.value = null;
    imagePreview.value = null;
    document.getElementById('image-upload').value = '';
};

// onMounted(async () => {
//     await api.get("/sanctum/csrf-cookie");
// });

const createSkill = async () => {
    if (!image.value) {
        alert('Please upload an image');
        return;
    }

    const formData = new FormData();

    formData.append('image', image.value);
    formData.append('title', title.value);
    formData.append('description', description.value);
    formData.append('category_id', category_id.value);
    formData.append('level_id', level_id.value);
    formData.append('place_execution', place_execution.value);
    formData.append('exchange_type_id', exchange_type_id.value);

    if (showPriceField.value) {
        formData.append('price', price.value);
    }

    try {
         await api.post("/skills", formData, {
            headers: { "Content-Type": "multipart/form-data" }
        });

        alert('Skill created successfully!');

        window.location.reload();
    } catch (error) {
        console.error("Error creating skill:", error);
        alert('Error creating skill. Please check the form.');
    }
};
</script>

<template>

    <Head title="Create Skill" />

    <div class="flex bg-[#F0F2F5] min-h-screen font-sans">
        <Navigation />

        <main class="flex-1 p-8">
            <div class="max-w-4xl mx-auto">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-900">Create Skill</h1>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <form @submit.prevent="createSkill" class="space-y-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Skill Image *
                            </label>

                            <div class="space-y-3">
                                <div
                                    class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-blue-400 transition-colors duration-200">

                                    <template v-if="!imagePreview">
                                        <div class="flex items-center justify-center py-4">
                                            <svg class="w-10 h-10 text-gray-400 mr-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <button type="button" @click="$refs.fileInput.click()"
                                                class="text-blue-600 hover:text-blue-800 font-medium">
                                                Upload Image
                                            </button>
                                            <input ref="fileInput" type="file" id="image-upload" accept="image/*"
                                                @change="handleImageUpload" class="hidden" required />
                                        </div>
                                    </template>

                                    <template v-else>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-4">
                                                <img :src="imagePreview" alt="Preview"
                                                    class="w-16 h-16 rounded-lg object-cover" />
                                                <span class="text-sm text-gray-600">{{ image.name }}</span>
                                            </div>
                                            <button type="button" @click="removeImage"
                                                class="text-red-600 hover:text-red-800">
                                                Remove
                                            </button>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                                Skill Title *
                            </label>
                            <input type="text" id="title" v-model="title"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="e.g., Website Development" required />
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                Description *
                            </label>
                            <textarea id="description" v-model="description" rows="4"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Describe your skill or service in detail..." required></textarea>
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Category *
                            </label>
                            <select id="category_id" v-model="category_id"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                required>
                                <option value="" disabled>Select Category</option>
                                <option v-for="category in props.categories" :key="category.id" :value="category.id">
                                    {{ category.title }}
                                </option>
                            </select>
                        </div>

                        <div>
                            <label for="level_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Level *
                            </label>
                            <select id="level_id" v-model="level_id"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                required>
                                <option value="" disabled selected>Select level</option>
                                <option v-for="level in props.level" :key="level.id" :value="level.id">
                                    {{ level.title }}
                                </option>
                            </select>
                        </div>

                        <div>
                            <label for="place_execution" class="block text-sm font-medium text-gray-700 mb-1">
                                Work Location *
                            </label>
                            <input type="text" id="place_execution" v-model="place_execution"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="e.g., Remote, On-site, Hybrid" required />
                        </div>

                        <div>
                            <label for="exchange_type_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Exchange Type *
                            </label>
                            <select id="exchange_type_id" v-model="exchange_type_id"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                required>
                                <option value="" disabled selected>Select type</option>
                                <option v-for="types in props.exchangeTypes" :key="types.id" :value="types.id">
                                    {{ types.title }}
                                </option>
                            </select>
                        </div>

                        <div v-if="showPriceField">
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                                Price *
                            </label>
                            <div class="relative">
                                <input type="number" id="price" v-model.number="price" min="0" step="1"
                                    class="w-full px-4 py-2.5 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                    placeholder="Enter price" required />
                                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">₽</span>
                            </div>
                        </div>

                        <div class="flex gap-4 pt-4">
                            <button type="submit"
                                class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                                Create Skill
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </main>
    </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap');

.font-mono {
    font-family: "Titillium Web", sans-serif;
    font-weight: 600;
    font-size: 17px;
}
</style>