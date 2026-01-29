<script setup>
import Navigation from '@/Components/Navigation.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    user: Object
});
</script>

<template>

    <Head :title="user.name" />

    <div class="flex bg-gray-50 min-h-screen font-sans">
        <Navigation />

        <main class="flex-1 p-8 overflow-y-auto max-w-7xl mx-auto">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 mb-8 flex items-center gap-6">
                <img :src="user.avatar ? `/storage/${user.avatar}` : '/images/placeholder.png'"
                    class="w-24 h-24 object-cover rounded-full border-4 border-emerald-100" />
                <div>
                    <h2 class="text-2xl font-bold">{{ user.name }}</h2>
                    <p v-if="user.profession" class="text-gray-600">{{ user.profession }}</p>
                </div>
            </div>

            <h3 class="text-xl font-semibold mb-4">Навыки пользователя</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="skill in user.skills" :key="skill.id" class="bg-white rounded-xl border p-4">
                    <h4 class="font-bold text-lg mb-1">{{ skill.title }}</h4>
                    <p class="text-gray-700 mb-2">{{ skill.description }}</p>
                    <div class="flex justify-between text-sm text-gray-500">
                        <span>Категория: {{ skill.category?.title }}</span>
                        <span>Уровень: {{ skill.level?.title }}</span>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
