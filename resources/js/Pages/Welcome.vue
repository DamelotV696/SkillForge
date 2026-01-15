<script setup>
import { Head } from '@inertiajs/vue3';
import Navigation from '@/Components/Navigation.vue';

const props = defineProps({
    categories: Array,
});
const categories = [
    {
        id: 1,
        image: "/images/frontend.png",
        title: "Frontend",
        vacantions: 500,
        color1: '#CF6F00',
        color2: '#E5D200',
    }, {
        id: 2,
        image: "/images/poem.png",
        title: "Poem",
        vacantions: 300,
        color1: '#FF51D9',
        color2: '#FFEA00',
    }, {
        id: 3,
        image: "/images/music.png",
        title: "Music",
        vacantions: 100,
        color1: '#E03160',
        color2: '#A2A9B1',
    }, {
        id: 4,
        image: "/images/backend.png",
        title: "Backend",
        vacantions: 800,
        color1: '#840054',
        color2: '#756BFF',
    }, {
        id: 5,
        image: "/images/Architecture.png",
        title: "Architecture",
        vacantions: 250,
        color1: '#FFA286',
        color2: '#F3E57B',
    }, {
        id: 6,
        image: "/images/Cooking.png",
        title: "Cooking",
        vacantions: 530,
        color1: '#F62B2B',
        color2: '#1EE80B',
    }
]

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

    <Head title="Главная" />

    <div class="flex bg-gray-50 dark:bg-white text-white dark:text-dark">
        <Navigation />

        <!-- ОСНОВНОЙ КОНТЕНТ СПРАВА -->
        <main class="flex-1 bg-[#F0F0F0] min-h-screen">

            <!-- БОЛЬШОЙ БЛОК ПОИСКА -->
            <section class="bg-gradient-to-r from-white to-[#98F0C9] p-14 mb-10">
                <h1 class="text-4xl font-bold mb-4 text-black">Find the<br>perfect exchange</h1>
                <p class="text-lg text-gray-600 dark:text-black max-w-xl mb-6">
                    Share your knowledge and learn new things from other people.
                    Free exchange of skills without borders.
                </p>

                <div class="flex mt-4">
                    <input type="text" placeholder="Search"
                        class="border border-gray-300 px-4 py-3 w-96 rounded-l-xl outline-none text-base">
                    <button
                        class="px-6 py-3 bg-[#2EE091] bg-opacity-45 text-gray-600 font-bold rounded-r-xl border border-gray-300 hover:bg-gray-100 text-base">
                        Search
                    </button>
                </div>
            </section>

            <!-- КАТЕГОРИИ -->
            <section class="mb-10 px-10">
                <h2 class="text-3xl font-bold text-black mb-8 text-center">Categories</h2>
                <div class="categories flex flex-wrap justify-center gap-6">
                    <div v-for="category in props.categories" :key="category.id" class="rounded-xl p-1">

                        <div class="category bg-white p-5 rounded-xl shadow-sm w-52 text-center">
                            <img :src="`/storage/${category.image}`" class="w-28 h-28 object-cover mb-4 mx-auto rounded-lg">
                            <h3 class="font-bold text-gray-800 mb-3 text-xl">{{ category.title }}</h3>
                            <div class="space-y-2">
                                <p class="text-gray-600 text-base">Vacancies:</p>
                                <span class="px-4 py-2 rounded-xl text-black border border-[#E03160] text-xl font-bold block">
                                    {{ category.vacantions }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- КАРТОЧКИ -->
            <section class="px-10 pb-10 mb-10 p-10 bg-white rounded-3xl mx-10">
                <h2 class="text-3xl font-bold text-black mb-8 text-center">Current offers</h2>
                <div class="grid gap-7" style="grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));">
                    <div v-for="card in cards" :key="card.id"
                        class="rounded-2xl shadow hover:shadow-xl transition-all duration-300 p-5 border border-gray-100 bg-white">


                        <img :src="card.image" class="w-full h-48 object-cover rounded-xl mb-4">
                        <div class="mb-1">
                            <span
                                class="px-3 py-1 bg-[#2EE091] bg-opacity-20 text-[#2EE091] text-sm font-semibold rounded-full">
                                {{ card.level }}
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-gray-800 mb-3 leading-tight">
                            {{ card.title }}
                        </h3>

                        <p class="text-gray-600 mb-4 text-base leading-relaxed">
                            {{ card.description }}
                        </p>

                        <div class="flex items-center text-gray-500 text-sm mb-4">
                            <span class="mr-4">{{ card.time }}</span>
                        </div>
                        <div class="flex items-center text-gray-500 text-sm mb-4">
                            <span>{{ card.location }}</span>
                        </div>

                        <button
                            class="w-36 px-4 py-3 bg-[#2EE091] bg-opacity-40 rounded-xl text-gray-800 font-semibold hover:bg-opacity-60 transition-all duration-300 text-base">
                            View details
                        </button>
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

/* Консистентные размеры текста */
h1 {
    font-size: 2.25rem;
    /* text-4xl */
    line-height: 2.5rem;
}

h2 {
    font-size: 1.875rem;
    /* text-3xl */
    line-height: 2.25rem;
}

h3 {
    font-size: 1.25rem;
    /* text-xl */
    line-height: 1.75rem;
}

p,
span,
button,
input {
    font-size: 1rem;
    /* text-base */
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
</style>