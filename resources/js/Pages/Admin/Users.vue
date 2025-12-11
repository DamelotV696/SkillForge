<script setup>
import { ref, onMounted } from "vue";
import Navigation from "@/Components/AdminNavigation.vue";
import { api } from "@/services/api";


const props = defineProps({
  users: Object
});
</script>

<template>
    <div class="flex bg-gray-50">
        <Navigation />

        <main class="flex-1 p-10 bg-white">
            <h1 class="text-3xl font-bold mb-6">Users</h1>

            <div v-if="loading" class="text-lg">Loading...</div>

            <table v-else class="w-full border-collapse bg-white shadow rounded-xl">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-3 border">ID</th>
                        <th class="px-4 py-3 border">Name</th>
                        <th class="px-4 py-3 border">Email</th>
                        <th class="px-4 py-3 border">City</th>
                        <th class="px-4 py-3 border">Profession</th>
                        <th class="px-4 py-3 border">Rating</th>
                        <th class="px-4 py-3 border">Created</th>
                        <th class="px-4 py-3 border">Event</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id" class="hover:bg-gray-50">
                        <td class="px-4 py-3 border">{{ user.id }}</td>
                        <td class="px-4 py-3 border">{{ user.name }}</td>
                        <td class="px-4 py-3 border">{{ user.email }}</td>
                        <td class="px-4 py-3 border">{{ user.city }}</td>
                        <td class="px-4 py-3 border">{{ user.profession }}</td>
                        <td class="px-4 py-3 border">{{ user.rating }}</td>
                        <td class="px-4 py-3 border">{{ user.created_at }}</td>
                        <td class="px-4 py-3 border">❌</td>
                    </tr>
                </tbody>
            </table>
        </main>
    </div>
</template>
