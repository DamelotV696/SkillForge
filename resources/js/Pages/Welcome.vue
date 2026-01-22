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

const cards = [
    {
        id: 1,
        image: "https://picsum.photos/300/200?1",
        level: "Expert",
        title: "Learn Photoshop",
        description: "I will teach you the basics of Photoshop and photo editing.",
        time: "22 minutes ago",
        location: "Moscow",
    },
    {
        id: 2,
        image: "https://picsum.photos/300/200?2",
        level: "Expert",
        title: "Guitar Lessons",
        description: "Learn to play acoustic guitar from scratch.",
        time: "22 minutes ago",
        location: "Moscow",
    },
    {
        id: 3,
        image: "https://picsum.photos/300/200?3",
        level: "Expert",
        title: "Frontend Mentorship",
        description: "I will help you learn HTML, CSS, JS and React.",
        time: "22 minutes ago",
        location: "Moscow",
    },
    {
        id: 4,
        image: "https://picsum.photos/300/200?4",
        level: "Expert",
        title: "Cooking Italian Food",
        description: "Master pasta, pizza and sauces.",
        time: "22 minutes ago",
        location: "Moscow",
    },
    {
        id: 5,
        image: "https://picsum.photos/300/200?5",
        level: "Expert",
        title: "English Speaking Practice",
        description: "Improve your speaking skills with real conversations.",
        time: "22 minutes ago",
        location: "Moscow",
    },
    {
        id: 6,
        image: "https://picsum.photos/300/200?6",
        level: "Expert",
        title: "SMM for Beginners",
        description: "Learn how to grow social media accounts.",
        time: "22 minutes ago",
        location: "Moscow",
    }
];
</script>

<template>

    <Head title="Home" />

    <div class="flex bg-gray-50 dark:bg-white text-white dark:text-dark">
        <Navigation />

        <main class="flex-1 bg-gray-100 min-h-screen">


            <section class="bg-gradient-to-r from-white to-[#98F0C9] p-14 mb-10">
                <h1 class="text-4xl font-bold mb-4 text-black">{{ t('home_title') }}</h1>
                <p class="text-lg text-gray-600 dark:text-black max-w-xl mb-6">{{ t('home_description') }}</p>

                <div class="flex mt-4">
                    <input type="text" :placeholder="t('search_placeholder')"
                        class="border border-gray-300 px-4 py-3 w-96 rounded-l-xl outline-none text-base">
                    <button
                        class="px-6 py-3 bg-[#2EE091] bg-opacity-45 text-gray-600 font-bold rounded-r-xl border border-gray-300 hover:bg-gray-100 text-base">
                        {{ t('search_placeholder') }}
                    </button>
                </div>
            </section>

            <section class="mb-10 px-10">
                <h2 class="text-3xl font-bold text-black mb-8 text-center">{{ t('categories_title') }}</h2>
                <div class="categories grid grid-cols-6 gap-6">
                    <div v-for="category in props.categories.data" :key="category.id" class="rounded-xl p-1">
                        <div class="category bg-white p-5 rounded-xl shadow-sm w-52 text-center">
                            <img :src="`/storage/${category.image}`"
                                class="w-28 h-28 object-cover mb-4 mx-auto rounded-lg">
                            <h3 class="font-bold text-gray-800 mb-3 text-xl">{{ category.title }}</h3>
                            <div class="space-y-2">
                                <p class="text-gray-600 text-base">{{ t('vacancies') }}:</p>
                                <span
                                    class="px-4 py-2 rounded-xl text-black border border-[#E03160] text-xl font-bold block">
                                    {{ category.vacantions }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="px-6 py-12 bg-white rounded-3xl mx-4 md:mx-10 lg:px-10">
                <div class="max-w-7xl mx-auto">
                    <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center md:text-4xl">{{ t('current_offers') }}
                    </h2>
                    <div class="grid gap-8" style="grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));">
                        <div v-for="skill in props.skill" :key="skill.id"
                            class="group relative flex flex-col rounded-2xl border border-gray-200 bg-white p-6 hover:border-[#2EE091]/30 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 h-full min-h-[520px]">

                            <div class="relative overflow-hidden rounded-xl mb-6 h-48 flex-shrink-0">
                                <img :src="`/storage/${skill.image}`"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    :alt="skill.title">
                            </div>

                            <div class="mb-3 flex-shrink-0">
                                <span
                                    class="inline-flex items-center px-3 py-1.5 bg-[#2EE091]/10 text-[#2EE091] text-sm font-semibold rounded-full border border-[#2EE091]/20">
                                    {{ skill.level.title }}
                                </span>
                            </div>

                            <h3
                                class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-[#2EE091] transition-colors duration-200 flex-shrink-0">
                                {{ skill.title }}
                            </h3>

                            <div class="relative mb-6 flex-grow overflow-hidden">
                                <p class="text-gray-600 text-base leading-relaxed line-clamp-3 pb-1">
                                    {{ skill.description }}
                                </p>
                            </div>

                            <div class="flex flex-wrap items-center gap-4 mb-6 text-sm text-gray-500 flex-shrink-0">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-medium">{{ formatTimeAgoShort(skill.created_at) }}</span>
                                </div>

                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="font-medium">{{ skill.place_execution }}</span>
                                </div>
                            </div>
                            <div class="flex items-center"></div>
                            <button
                                class="w-full px-6 py-3 bg-[#2EE091] text-gray-900 font-semibold rounded-xl hover:bg-[#26cc82] active:scale-95 transition-all duration-200 flex items-center justify-center group/btn flex-shrink-1">
                                {{ t('view_details') }}
                            </button>
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

h1 {
    font-size: 2.25rem;
    line-height: 2.5rem;
}

h2 {
    font-size: 1.875rem;
    line-height: 2.25rem;
}

h3 {
    font-size: 1.25rem;
    line-height: 1.75rem;
}

p,
span,
button,
input {
    font-size: 1rem;
    line-height: 1.5rem;
}

.text-sm {
    font-size: 0.875rem;
    line-height: 1.25rem;
}

.text-lg {
    font-size: 1.125rem;
    line-height: 1.75rem;
}

.text-xl {
    font-size: 1.25rem;
    line-height: 1.75rem;
}

.text-2xl {
    font-size: 1.5rem;
    line-height: 2rem;
}

.text-3xl {
    font-size: 1.875rem;
    line-height: 2.25rem;
}

.text-4xl {
    font-size: 2.25rem;
    line-height: 2.5rem;
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

.text-fade-mask {
    mask-image: linear-gradient(to bottom, black 60%, transparent 100%);
    -webkit-mask-image: linear-gradient(to bottom, black 60%, transparent 100%);
}
</style>
