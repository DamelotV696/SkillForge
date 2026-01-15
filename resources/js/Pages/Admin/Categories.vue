<script setup>
import { ref, onMounted } from "vue";
import Navigation from "@/Components/AdminNavigation.vue";
import { api } from "@/services/api";
import {
    TrashIcon,
} from '@heroicons/vue/24/outline'

const props = defineProps({
    categories: Array,
    errors: Object,
    auth: Object
});

const title = ref("");
const image = ref(null);

onMounted(async () => {
    await api.get("/sanctum/csrf-cookie");
});

const createCategory = async () => {
    const formData = new FormData();
    formData.append("title", title.value);

    if (image.value) {
        formData.append("image", image.value);
    }

    try {
        await api.post("/api/categories", formData, {
            headers: { "Content-Type": "multipart/form-data" }
        });

        window.location.reload();
    } catch (error) {
        console.error("Error creating category:", error);
    }
};
const deleteCategory = async (id) => {
    await api.delete(`/api/categories/${id}`);
    fetchCategories();
};
const onFileChange = (event) => {
    const files = event.target?.files;
    if (!files || !files.length) return;

    image.value = files[0];
};

</script>

<template>
    <div class="flex bg-gray-50">
        <Navigation />

        <main class="flex-1 p-10 bg-white">
            <h1 class="text-3xl font-bold mb-6">Categories</h1>

            <!-- Таблица категорий -->
            <table class="w-full border-collapse bg-white shadow rounded-xl">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-3 border w-10">ID</th>
                        <th class="px-4 py-3 border w-24">Image</th>
                        <th class="px-4 py-3 border">Title</th>
                        <th class="px-4 py-3 border">Vacantions</th>
                        <th class="px-4 py-3 border">Created</th>
                        <th class="px-4 py-3 border">Event</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in props.categories" :key="category.id" class="hover:bg-gray-50">
                        <td class="px-4 py-3 border">{{ category.id }}</td>
                        <td class="px-4 py-4 border"><img :src="`/storage/${category.image}`" alt="" class="w-24"></td>
                        <td class="px-4 py-3 border">{{ category.title }}</td>
                        <td class="px-4 py-3 border">{{ category.vacantions }}</td>
                        <td class="px-4 py-3 border">
                            {{ new Date(category.created_at).toLocaleDateString() }}
                        </td>
                        <td class="px-4 py-3 border">
                            <button @click="deleteCategory(category.id)" class="text-red-600 ml-4">
                                <TrashIcon class="h-5 w-5 mr-3" />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Форма создания категории -->
            <form @submit.prevent="createCategory" class="w-full border-2 rounded-lg mt-10 p-6">
                <!-- Заголовок -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">
                        Create New Category
                    </h2>
                    <p class="text-gray-600 mt-1">
                        Add a new category to organize your content
                    </p>
                </div>
                

                <!-- Поле загрузки файла -->
                <div class="space-y-3">
                    <label for="image-url" class="block text-sm font-semibold text-gray-700">
                        Image File
                    </label>

                    <input id="image-url" type="file" @change="onFileChange"
                        class="w-full py-3.5 px-4 bg-white border border-gray-300 rounded-lg" />

                </div>

                <div class="space-y-3 mt-6">
                    <label for="title" class="block text-sm font-semibold text-gray-700">
                        Category Title
                    </label>

                    <input id="title" type="text" v-model="title" required placeholder="Enter category title" class="w-full py-3.5 pl-10 pr-4 bg-white border border-gray-300
                        rounded-lg text-gray-900 placeholder-gray-400
                        focus:border-green-600 focus:ring-2 focus:ring-green-300
                        transition-all" />
                </div>

                <!-- Submit -->
                <div class="mt-8 flex items-center justify-between pt-6 border-t border-gray-200">
                    <button type="submit" class="px-6 py-3 border-2 border-green-600 text-green-600 rounded-lg
                        font-bold hover:bg-green-50 transition">
                        Create Category
                    </button>
                </div>
            </form>
        </main>
    </div>
</template>
