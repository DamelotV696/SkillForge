<script setup>
import Navigation from '@/Components/Navigation.vue';
import { useI18n } from 'vue-i18n';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    skill: Object
})
const { t } = useI18n();
function formatTimeAgoShort(date) {
    const d = new Date(date);
    const diff = Date.now() - d.getTime();
    const seconds = Math.floor(diff / 1000);
    const minutes = Math.floor(seconds / 60);
    const hours = Math.floor(minutes / 60);
    const days = Math.floor(hours / 24);

    if (days > 0) return `${days}d ago`;
    if (hours > 0) return `${hours}h ago`;
    if (minutes > 0) return `${minutes}m ago`;
    return 'Just now';
}
</script>

<template>

    <Head :title="skill.title" />

    <div class="flex bg-gray-50 min-h-screen font-sans">
        <Navigation />

        <main class="flex-1 p-8 overflow-y-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <h1 class="text-3xl font-bold font-mono text-gray-800 mb-4">
                            {{ skill.title }}
                        </h1>

                        <div class="flex flex-wrap items-center gap-4 text-gray-600 mb-6">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ formatTimeAgoShort(skill.created_at) }}</span>
                            </div>

                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ skill.place_execution }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="relative overflow-hidden rounded-2xl h-96">
                        <img :src="skill.image ? `/storage/${skill.image}` : '/images/placeholder.png'"
                            class="w-full h-full object-cover" :alt="skill.title" />
                        <div class="absolute top-4 left-4">
                            <span
                                class="px-3 py-1.5 bg-emerald-500/90 backdrop-blur-sm text-white text-sm font-semibold rounded-lg">
                                {{ skill.level.title }}
                            </span>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="px-3 py-1.5 bg-gray-200 text-gray-700 text-sm font-semibold rounded-lg">
                                {{ skill.category.title }}
                            </span>
                            <span class="px-3 py-1.5 bg-emerald-100 text-emerald-700 text-sm font-semibold rounded-lg">
                                {{ skill.level.title }}
                            </span>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Description</h2>
                        <div class="prose max-w-none">
                            <p class="text-gray-700 leading-relaxed">{{ skill.description }}</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl border border-gray-200 p-6">
                        <div class="flex flex-col items-center text-center mb-6">
                            <div class="relative mb-4">
                                <img :src="skill.user.avatar ? `/storage/${skill.user.avatar}` : '/images/placeholder.png'"
                                    class="w-32 h-32 object-cover rounded-full border-4 border-emerald-100"
                                    :alt="skill.user.name" />
                            </div>

                            <h3 class="text-2xl font-bold font-mono text-gray-800 mb-2">
                                {{ skill.user.name }}
                            </h3>

                            <div v-if="skill.user.profession" class="mb-6">
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-sm font-semibold rounded-lg">
                                    {{ skill.user.profession }}
                                </span>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div v-if="skill.user.rating" class="p-3 bg-gray-50 rounded-lg">
                                <h4 class="font-semibold text-gray-800 mb-1">Рейтинг</h4>
                                <p class="text-xl font-bold text-gray-900">{{ skill.user.rating }}/5</p>
                            </div>

                            <div v-if="skill.user.city" class="p-3 bg-gray-50 rounded-lg">
                                <h4 class="font-semibold text-gray-800 mb-1">Город</h4>
                                <p class="text-gray-700">{{ skill.user.city }}</p>
                            </div>

                            <div v-if="skill.user.email" class="p-3 bg-gray-50 rounded-lg">
                                <h4 class="font-semibold text-gray-800 mb-1">Email</h4>
                                <p class="text-gray-700 break-all">{{ skill.user.email }}</p>
                            </div>

                            <button
                                class="w-full mt-6 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-300">
                                Связаться с пользователем
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>