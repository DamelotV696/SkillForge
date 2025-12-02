<script setup>
import { Head } from '@inertiajs/vue3';
import Navigation from '@/Components/Navigation.vue';

// const categories = [
//     "Design", "Programming", "Marketing", "English",
//     "Psychology", "Cooking", "Business", "Guitar"
// ];

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
        color1: '#FFEA00',
        color2: '#FF51D9',

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
        color1: '#F3E57B',
        color2: '#FFA286',

    }, {
        id: 6,
        image: "/images/Cooking.png",
        title: "Cooking",
        vacantions: 530,
        color1: '#F62B2B',
        color2: '#1EE80B',

    }]

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

    <Head title="Welcome" />

    <div class="flex bg-gray-50 dark:bg-white text-white dark:text-dark">
        <Navigation />

        <!-- ОСНОВНОЙ КОНТЕНТ СПРАВА -->
        <main class="flex-1 bg-[#F0F0F0]">

            <!-- БОЛЬШОЙ БЛОК ПОИСКА -->
            <section class="bg-gradient-to-r from-white to-[#98F0C9] p-14 mb-10 border-2 border-[#F0F0F0]">
                <h1 class="text-4xl font-bold mb-4 text-black">Find the<br>perfect exchange</h1>
                <p class="text-gray-600 dark:text-black max-w-xl mb-6">
                    Share your knowledge and learn new things from other people.
                    Free exchange of skills without borders.
                </p>

                <div class="flex mt-4">
                    <input type="text" placeholder="Search"
                        class="border border-gray-300 px-4 py-2 w-96 rounded-l-xl outline-none">
                    <button
                        class="px-6 py-2 bg-[#2EE091] bg-opacity-45 text-gray-600 font-bold rounded-r-xl border border-gray-300 hover:bg-gray-100">
                        Search
                    </button>
                </div>
            </section>

            <!-- КАТЕГОРИИ -->
            <section class="mb-10 px-10">
                <h2 class="text-2xl font-bold text-black mb-4">Categories</h2>
                <div class="categories flex flex-wrap justify-center gap-6">
                    <div v-for="cat in categories" :key="cat.id" class="rounded-xl p-1"
                        :style="{ background: `linear-gradient(to bottom, ${cat.color1}, ${cat.color2})` }">

                        <div class="category bg-white p-5 rounded-xl shadow-sm">
                            <img :src="cat.image" class="w-40 h-36 object-cover mb-4 mx-auto rounded-lg">
                            <div class="text-center">
                                <h3 class="font-semibold text-black mb-2 text-xl">{{ cat.title }}</h3>
                                <span class="px-3 py-1 rounded-xl text-black text-lg">Vacantion:</span>
                                <span class="px-3 py-1 rounded-xl text-xl font-bold"
                                    :style="{ color: cat.color2, borderColor: cat.color2 }">
                                    {{ cat.vacantions }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- КАРТОЧКИ -->
            <section class="px-10 pb-10">
                <h2 class="text-2xl font-bold text-black mb-4">Popular Exchanges</h2>
                <div class="grid gap-7" style="grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));">
                    <div v-for="card in cards" :key="card.id"
                        class="bg-white rounded-2xl shadow hover:shadow-lg transition p-4 border border-gray-200">
                        <img :src="card.image" class="w-full h-40 object-cover rounded-xl mb-4">
                        <h3 class="text-xl font-semibold text-black mb-2">
                            {{ card.title }}
                        </h3>
                        <p class="text-gray-600 mb-4">
                            {{ card.description }}
                        </p>
                        <button
                            class="px-4 py-2 bg-[#2EE091] bg-opacity-40 rounded-xl text-gray-800 font-semibold hover:bg-opacity-60">
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

aside {
    font-family: "Titillium Web", sans-serif;
    font-weight: 600;
}
</style>
