<script setup>
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import Navigation from '@/Components/Navigation.vue';
import { Link } from '@inertiajs/vue3';
import { useI18n } from 'vue-i18n';

const props = defineProps({
    categories: Object,
    skill: Object,
});

const { t, locale } = useI18n();

function changeLang(lang) {
    locale.value = lang;
    router.post(route('language.change'), { lang }, { preserveScroll: true, preserveState: true });
}

function formatTimeAgoShort(created_at) {
    const createdAt = new Date(created_at);
    const now = new Date();
    const diffMs = now - createdAt;

    if (diffMs < 0 || isNaN(diffMs)) return 'now';

    const diffMinutes = Math.floor(diffMs / (1000 * 60));
    const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
    const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));

    if (diffMinutes < 1) return 'now';
    if (diffMinutes < 60) return `${diffMinutes}m ago`;
    if (diffHours < 24) return `${diffHours}h ago`;
    return `${diffDays}d ago`;
}
</script>

<template>

    <Head title="Home" />

        <div class="flex bg-gray-50 text-white">
        <Navigation />

        <main class="flex-1 bg-gray-50 min-h-screen">
            <section
                class="relative bg-gradient-to-br from-white via-emerald-50 to-green-50 p-8 md:p-14 mb-10 overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-200 rounded-full -mr-32 -mt-32 opacity-50">
                </div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-green-200 rounded-full -ml-48 -mb-48 opacity-30">
                </div>

                <div class="relative max-w-4xl">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900 leading-tight">
                        {{ t('home_title') }}
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mb-8">
                        {{ t('home_description') }}
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 max-w-2xl">
                        <div class="flex-1 relative">
                            <input type="text" :placeholder="t('search_placeholder')"
                                class="w-full border border-gray-300 px-5 py-4 rounded-xl outline-none text-base focus:border-emerald-400 focus:ring-2 focus:ring-emerald-200 transition-all duration-300">
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <button
                            class="px-8 py-4 bg-emerald-500 text-white font-semibold rounded-xl hover:bg-emerald-600 active:scale-95 transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                            <span>{{ t('search_placeholder') }}</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </section>

            <section class="mb-12 px-4 md:px-8 lg:px-12">
                <div class="max-w-7xl mx-auto">
                    <div class="text-center mb-10">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                            {{ t('categories_title') }}
                        </h2>
                        <p class="text-gray-600 max-w-2xl mx-auto">{{ t('category_discription') }}</p>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
                        <Link v-for="category in props.categories.data" :key="category.id"
                            :href="route('categories.show', category.id)" class="group relative block">
                            <div
                                class="bg-white rounded-2xl p-4 md:p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:border-emerald-200 transition-all duration-300 hover:-translate-y-1 h-full">

                                <div class="flex flex-col items-center text-center h-full">
                                    <div class="relative mb-4">
                                        <div
                                            class="w-16 h-16 md:w-20 md:h-20 rounded-xl bg-gradient-to-br from-emerald-100 to-green-100 p-1.5">
                                            <div class="w-full h-full rounded-lg bg-white p-1">
                                                <img :src="`/storage/${category.image}`"
                                                    class="w-full h-full object-cover rounded-md" :alt="category.title">
                                            </div>
                                        </div>
                                        <div
                                            class="absolute -top-2 -right-2 w-8 h-8 bg-emerald-500 text-white rounded-full flex items-center justify-center shadow-md">
                                            <span class="text-xs font-bold">{{ category.vacantions }}</span>
                                        </div>
                                    </div>

                                    <h3
                                        class="font-semibold text-gray-800 text-sm md:text-base mb-2 leading-tight group-hover:text-emerald-600 transition-colors duration-300 flex-grow">
                                        {{ category.title }}
                                    </h3>
                                </div>
                                <div
                                    class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-400 to-green-500 rounded-b-2xl transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300">
                                </div>
                            </div>
                        </Link>
                    </div>
                </div>
            </section>

            <section class="px-4 md:px-8 lg:px-12 pb-16">
                <div class="max-w-7xl mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                            {{ t('current_offers') }}
                        </h2>
                        <p class="text-gray-600 max-w-2xl mx-auto"> {{ t('current_offers_description') }}</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                        <div v-for="skill in props.skill" :key="skill.id"
                            class="group bg-white rounded-2xl border border-gray-200 hover:border-emerald-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden h-full flex flex-col">

                            <div class="relative overflow-hidden h-56">
                                <img :src="`/storage/${skill.image}`"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    :alt="skill.title">
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="px-3 py-1.5 bg-emerald-500/90 backdrop-blur-sm text-white text-sm font-semibold rounded-lg">
                                        {{ skill.level.title }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6 flex flex-col flex-grow">
                                <h3
                                    class="text-xl font-bold text-gray-900 mb-3 group-hover:text-emerald-600 transition-colors duration-300 line-clamp-2">
                                    {{ skill.title }}
                                </h3>

                                <p class="text-gray-600 mb-6 flex-grow line-clamp-3">
                                    {{ skill.description }}
                                </p>

                                <div class="flex flex-wrap items-center gap-4 mb-6 text-sm text-gray-500">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>{{ formatTimeAgoShort(skill.created_at) }}</span>
                                    </div>

                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span>{{ skill.place_execution }}</span>
                                    </div>
                                </div>

                                <Link :href="route('skills.show', skill.id)"
                                    class="w-full px-6 py-3 bg-emerald-50 text-emerald-700 font-semibold rounded-xl hover:bg-emerald-100 active:scale-95 transition-all duration-300 border border-emerald-100 group-hover:border-emerald-200 flex items-center justify-center gap-2">
                                    {{ t('view_details') }}
                                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300;400;600;700&display=swap');

* {
    font-family: "Titillium Web", sans-serif;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

::selection {
    background-color: #10b981;
    color: white;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.grid>div {
    animation: fadeIn 0.5s ease-out forwards;
    opacity: 0;
}

.grid>div:nth-child(1) {
    animation-delay: 0.1s;
}

.grid>div:nth-child(2) {
    animation-delay: 0.2s;
}

.grid>div:nth-child(3) {
    animation-delay: 0.3s;
}

.grid>div:nth-child(4) {
    animation-delay: 0.4s;
}

.grid>div:nth-child(5) {
    animation-delay: 0.5s;
}

.grid>div:nth-child(6) {
    animation-delay: 0.6s;
}

html {
    scroll-behavior: smooth;
}

.shadow-sm {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.shadow-lg {
    box-shadow: 0 10px 25px rgba(16, 185, 129, 0.1);
}

.hover\:shadow-xl:hover {
    box-shadow: 0 20px 40px rgba(16, 185, 129, 0.15);
}
</style>