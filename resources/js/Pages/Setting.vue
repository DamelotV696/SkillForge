<script setup>
import { ref, computed } from "vue";
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { useI18n } from 'vue-i18n';
import Navigation from '@/Components/Navigation.vue';

const { t, locale } = useI18n();

function changeLang(lang) {
    locale.value = lang;
    router.post(route('language.change'), { lang }, { preserveScroll: true, preserveState: true });
}

const settings = ref({
    notifications: true,
    darkMode: false,
    autoSave: true,
    fontSize: 'medium'
});
</script>

<template>

    <Head title="Settings" />

    <div class="flex bg-gray-100 min-h-screen font-sans">
        <Navigation />

        <main class="flex-1 min-h-screen p-6 md:p-8">
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">
                    {{ t('settings.title') }}
                </h1>
                <p class="text-gray-600">
                    {{ t('settings.subtitle') }}
                </p>
            </div>

            <div class="max-w-4xl ">
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <div class="flex items-center mb-6">
                        <div class="p-3 bg-blue-50 rounded-xl mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">
                                {{ t('settings.language.title') }}
                            </h2>
                            <p class="text-gray-600 text-sm">
                                {{ t('settings.language.description') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-4">
                        <button @click="changeLang('en')" :class="[
                            'flex items-center px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105',
                            locale === 'en'
                                ? 'bg-blue-500 text-white shadow-lg shadow-blue-200'
                                : 'bg-white text-gray-700 border-2 border-gray-200 hover:border-blue-300 hover:shadow-md'
                        ]">
                            <span class="mr-2 text-xl">Eng</span>
                        </button>

                        <button @click="changeLang('ru')" :class="[
                            'flex items-center px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105',
                            locale === 'ru'
                                ? 'bg-red-500 text-white shadow-lg shadow-red-200'
                                : 'bg-white text-gray-700 border-2 border-gray-200 hover:border-red-300 hover:shadow-md'
                        ]">
                            <span class="mr-2 text-xl">Ru</span>
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <div class="flex items-center mb-6">
                        <div class="p-3 bg-purple-50 rounded-xl mr-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">
                                {{ t('settings.appearance.title') }}
                            </h2>
                            <p class="text-gray-600 text-sm">
                                {{ t('settings.appearance.description') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                        <div>
                            <h3 class="font-medium text-gray-800">{{ t('settings.appearance.darkMode') }}</h3>
                            <p class="text-sm text-gray-500">{{ t('settings.appearance.darkModeHint') }}</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" v-model="settings.darkMode" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer 
                                      peer-checked:after:translate-x-full peer-checked:after:border-white 
                                      after:content-[''] after:absolute after:top-[2px] after:left-[2px] 
                                      after:bg-white after:border-gray-300 after:border after:rounded-full 
                                      after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600">
                            </div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between py-3">
                        <div>
                            <h3 class="font-medium text-gray-800">{{ t('settings.appearance.fontSize') }}</h3>
                            <p class="text-sm text-gray-500">{{ t('settings.appearance.fontSizeHint') }}</p>
                        </div>
                        <select v-model="settings.fontSize" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                       focus:ring-purple-500 focus:border-purple-500 px-6 py-2">
                            <option value="small">{{ t('settings.appearance.small') }}</option>
                            <option value="medium">{{ t('settings.appearance.medium') }}</option>
                            <option value="large">{{ t('settings.appearance.large') }}</option>
                        </select>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center mb-6">
                        <div class="p-3 bg-green-50 rounded-xl mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">
                                {{ t('settings.notifications.title') }}
                            </h2>
                            <p class="text-gray-600 text-sm">
                                {{ t('settings.notifications.description') }}
                            </p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <div>
                                <h3 class="font-medium text-gray-800">{{ t('settings.notifications.email') }}</h3>
                                <p class="text-sm text-gray-500">{{ t('settings.notifications.emailHint') }}</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" v-model="settings.notifications" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 
                                          peer-focus:ring-green-300 peer-checked:after:translate-x-full 
                                          peer-checked:after:border-white after:content-[''] after:absolute 
                                          after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 
                                          after:border after:rounded-full after:h-5 after:w-5 after:transition-all 
                                          peer-checked:bg-green-500">
                                </div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between py-3">
                            <div>
                                <h3 class="font-medium text-gray-800">{{ t('settings.notifications.autoSave') }}</h3>
                                <p class="text-sm text-gray-500">{{ t('settings.notifications.autoSaveHint') }}</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" v-model="settings.autoSave" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 
                                          peer-focus:ring-blue-300 peer-checked:after:translate-x-full 
                                          peer-checked:after:border-white after:content-[''] after:absolute 
                                          after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 
                                          after:border after:rounded-full after:h-5 after:w-5 after:transition-all 
                                          peer-checked:bg-blue-500">
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-8">
                    <button
                        class="flex items-center gap-2 px-4 py-2 border-2 border-gray-500 text-gray-900 rounded hover:bg-green-600 transition">
                        {{ t('settings.actions.cancel') }}
                    </button>
                    <button
                        class="flex items-center gap-2 px-4 py-2 border-2 border-[#13AC68] bg-[#13AC68] text-white rounded hover:bg-green-600 transition">
                        <span class="font-bold">{{ t('settings.actions.save') }}</span>
                    </button>
                </div>
            </div>
        </main>
    </div>
</template>

<style scoped>

* {
    transition: background-color 0.3s ease, border-color 0.3s ease;
}

::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>