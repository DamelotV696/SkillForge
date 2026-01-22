<template>
    <aside class="sticky top-0 w-64 bg-white h-screen border-r  p-4 overflow-y-auto">
        <div class="flex items-center gap-3 mb-8">
            <img :src="'/images/logo-light2.png'" alt="SkillForge" class="h-12 mt-6">
        </div>

        <nav class="space-y-1.5 mt-16">
            <Link href="/"
                class="flex items-center px-3 py-2 rounded text-gray-700 hover:bg-[#2EE091] hover:bg-opacity-40 group">
                <HomeIcon class="h-5 w-5 mr-3" />
                Home
            </Link>
            <Link href="/profile"
                class="flex items-center px-3 py-2 rounded text-gray-700 hover:bg-[#2EE091] hover:bg-opacity-40 group">
                <UserIcon class="h-5 w-5 mr-3" />
                Profile
            </Link>
            <Link href="#"
                class="flex items-center px-3 py-2 rounded text-gray-700 hover:bg-[#2EE091] hover:bg-opacity-40 group">
                <ChartBarIcon class="h-5 w-5 mr-3" />
                Dashboard
            </Link>
            <Link href="#"
                class="flex items-center px-3 py-2 rounded text-gray-700 hover:bg-[#2EE091] hover:bg-opacity-40 group">
                <ArrowsRightLeftIcon class="h-5 w-5 mr-3" />
                Exchanges
            </Link>
            <Link href="#"
                class="flex items-center px-3 py-2 rounded text-gray-700 hover:bg-[#2EE091] hover:bg-opacity-40 group">
                <BellIcon class="h-5 w-5 mr-3" />
                Notifications
            </Link>
            <Link href="/settings"
                class="flex items-center px-3 py-2 rounded text-gray-700 hover:bg-[#2EE091] hover:bg-opacity-40 group">
                <Cog6ToothIcon class="h-5 w-5 mr-3" />
                Settings
            </Link>
            <Link href="/logout" method="post"
                class="flex items-center px-3 py-2 rounded text-gray-700 hover:bg-[#2EE091] hover:bg-opacity-40 group">
                <ArrowRightOnRectangleIcon class="h-5 w-5 mr-3" />
                Log out
            </Link>

            <Link href="/admin/users"
                class="flex items-center px-3 py-2 rounded text-gray-700 hover:bg-[#2EE091] hover:bg-opacity-40 group">
                <ShieldCheckIcon class="h-5 w-5 mr-3" />
                Admin
            </Link>
        </nav>
    </aside>
</template>

<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import {
    HomeIcon,
    ChartBarIcon,
    ArrowsRightLeftIcon,
    UserIcon,
    BellIcon,
    ShieldCheckIcon,
    Cog6ToothIcon,
    ArrowRightOnRectangleIcon
} from '@heroicons/vue/24/outline'

</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap');

aside {
    font-family: "Titillium Web", sans-serif;
    font-weight: 600;
}
</style>
