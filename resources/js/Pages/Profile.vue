<script setup>
import { ref, computed } from "vue";
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import Navigation from '@/Components/Navigation.vue';
import {
  PencilIcon,
  StarIcon,
  TrashIcon,
  EyeIcon,
  PlusIcon,
  AdjustmentsHorizontalIcon,
  MagnifyingGlassIcon,
  CheckIcon,
  XMarkIcon
} from '@heroicons/vue/24/outline';

const props = defineProps({
  user: Object
});

const isEditing = ref(false);
const editingField = ref('name');

const profileForm = useForm({
  name: props.user.name,
  profession: props.user.profession,
  bio: props.user.bio
});

const profileData = ref({
  avatar: 'https://i.pravatar.cc/150?u=leo'
});

const skills = ref([
  {
    id: 1,
    category: 'Frontend',
    type: 'Offering',
    title: 'Learn the Ruby',
    description: 'American actor and producer, born November 11, 1974, who gained international stardom with Titanic (1997)...',
    level: 'Expert'
  },
  {
    id: 2,
    category: 'Backend',
    type: 'Looking For',
    title: 'Learn How To Lie Properly',
    description: 'American actor and producer, born November 11, 1974, who gained international stardom with Titanic (1997)...',
    level: 'Beginner'
  },
  {
    id: 3,
    category: 'Poem',
    type: 'Looking For',
    title: 'Learn the Ruby',
    description: 'American actor and producer, born November 11, 1974, who gained international stardom with Titanic (1997)...',
    level: 'Intermedia'
  }
]);

const getBadgeColor = (type) => {
  if (type === 'Offering') return 'bg-green-100 text-green-700';
  if (type === 'Looking For') return 'bg-yellow-100 text-yellow-700';
  return 'bg-gray-100 text-gray-700';
};

const getCategoryColor = (category) => {
  switch (category) {
    case 'Frontend':
      return 'bg-blue-100 text-yellow-700';
    case 'Backend':
      return 'bg-purple-100 text-purple-800';
    case 'Poem':
      return 'bg-pink-100 text-pink-800';
    case 'Marketing':
      return 'bg-red-100 text-red-800';
    default:
      return 'bg-gray-100 text-gray-800';
  }
};

const startEditing = () => {
  isEditing.value = true;
};

const saveProfile = () => {
  profileForm.put(route('profile.update'), {
    preserveScroll: true,
    onSuccess: () => {
      isEditing.value = false;
    },
    onError: (errors) => {
      console.error('Ошибка сохранения:', errors);
    }
  });
};

const cancelEditing = () => {
  profileForm.reset();
  isEditing.value = false;
};
</script>

<template>
  <Head title="Профиль пользователя" />

  <div class="flex bg-[#F0F2F5] min-h-screen font-sans">
    <Navigation />

    <main class="flex-1 p-8 overflow-y-auto">
      <h1 class="text-2xl font-bold font-mono mb-6 text-gray-800">User Profile</h1>

      <div class="bg-white rounded-2xl shadow-sm p-8 mb-8 relative">
        <div class="flex justify-between items-start mb-6">
          <div class="flex items-center gap-3">
            <div class="w-1.5 h-6 bg-[#2EE091] rounded-full"></div>
            <h2 class="text-xl font-mono font-semibold text-gray-800">Main Details</h2>
          </div>

          <div v-if="!isEditing">
            <button
              @click="startEditing"
              class="flex items-center gap-2 px-4 py-2 border border-2 border-[#13AC68] text-[#13AC68] rounded hover:bg-green-50 transition">
              <PencilIcon class="w-4 h-4" />
              <span class="font-bold">Edit Profile</span>
            </button>
          </div>
          
          <div v-else class="flex gap-2">
            <button
              @click="saveProfile"
              class="flex items-center gap-2 px-4 py-2 border border-2 border-[#13AC68] bg-[#13AC68] text-white rounded hover:bg-green-600 transition">
              <CheckIcon class="w-4 h-4" />
              <span class="font-bold">Save</span>
            </button>
            <button
              @click="cancelEditing"
              class="flex items-center gap-2 px-4 py-2 border border-2 border-gray-300 text-gray-700 rounded hover:bg-gray-50 transition">
              <XMarkIcon class="w-4 h-4" />
              <span class="font-bold">Cancel</span>
            </button>
          </div>
        </div>

        <div class="flex flex-col md:flex-row gap-8 items-center">
          <div class="flex-shrink-0">
            <img :src="profileData.avatar" alt="Avatar"
              class="w-24 h-24 rounded-full object-cover border-4 border-gray-100 shadow-sm">
          </div>

          <div class="flex-1 grid grid-cols-1 md:grid-cols-8 w-full gap-6">
            <div>
              <p class="text-gray-400 text-sm mb-1 font-mono">FullName</p>
              <div v-if="!isEditing">
                <p class="font-bold text-gray-800 text-lg">{{ user.name }}</p>
              </div>
              <div v-else>
                <input
                  v-model="profileForm.name"
                  type="text"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2EE091] focus:border-transparent"
                  placeholder="Введите имя"
                />
              </div>
            </div>
            
            <div>
              <p class="text-gray-400 text-sm mb-1 font-mono">Role</p>
              <div v-if="!isEditing">
                <p class="font-bold text-gray-800 text-lg">{{ user.profession }}</p>
              </div>
              <div v-else>
                <input
                  v-model="profileForm.profession"
                  type="text"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2EE091] focus:border-transparent"
                  placeholder="Введите профессию"
                />
              </div>
            </div>
            
            <div class="col-span-1 md:col-span-2">
              <p class="text-gray-400 text-sm mb-1 font-mono">Email Address</p>
              <p class="font-bold text-gray-800 text-lg break-all">{{ user.email }}</p>
            </div>
            
            <div>
              <p class="text-gray-400 text-sm mb-1 font-mono">Rate</p>
              <div class="flex items-center text-yellow-400 font-bold text-lg">
                <StarIcon class="w-5 h-5 mr-1" />
                {{ user.rating }}
              </div>
            </div>
          </div>
        </div>

        <hr class="border-gray-200 my-6">

        <div>
          <p class="text-gray-400 text-sm mb-2 font-mono">Bio</p>
          <div v-if="!isEditing">
            <p class="text-gray-600 leading-relaxed font-mono text-sm">
              {{ user.bio }}
            </p>
          </div>
          <div v-else>
            <textarea
              v-model="profileForm.bio"
              rows="3"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2EE091] focus:border-transparent"
              placeholder="Расскажите о себе"
            ></textarea>
          </div>
        </div>
      </div>

      <!-- Остальной код остается без изменений -->
      <div>
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
          <div class="flex items-center gap-3 mb-4 md:mb-0">
            <div class="w-1.5 h-6 bg-[#2EE091] rounded-full"></div>
            <h2 class="text-xl font-mono font-semibold text-gray-800">Active Skills</h2>
          </div>

          <div class="flex gap-3">
            <button
              class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded hover:bg-gray-50 text-gray-700 transition">
              <AdjustmentsHorizontalIcon class="w-5 h-5" />
              Filter
            </button>
            <button
              class="flex items-center gap-2 px-4 py-2 bg-[#2EE091] text-white rounded hover:bg-opacity-90 transition shadow-md shadow-green-200">
              <PlusIcon class="w-5 h-5" />
              Add Skills
            </button>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="skill in skills" :key="skill.id"
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col h-full">
            <div class="flex justify-between items-start mb-4">
              <span :class="['bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-1 rounded',getCategoryColor(skill.category)]">
                {{ skill.category }}
              </span>
              <span
                :class="['text-xs font-semibold px-2.5 py-1 rounded flex items-center gap-1', getBadgeColor(skill.type)]">
                <MagnifyingGlassIcon v-if="skill.type === 'Looking For'" class="w-3 h-3" />
                <span v-else class="w-3 h-3 text-green-600">Q</span> {{ skill.type }}
              </span>
            </div>

            <h3 class="font-bold text-lg mb-2 font-mono tracking-wide">{{ skill.title }}</h3>
            <p class="text-gray-500 text-sm mb-6 flex-grow font-mono leading-relaxed">
              {{ skill.description }}
            </p>

            <hr class="border-gray-100 mb-4">

            <div class="flex justify-between items-center">
              <div class="text-gray-600 font-mono text-sm">
                Level: <span class="font-bold text-gray-800">{{ skill.level }}</span>
              </div>

              <div class="flex gap-2">
                <button class="p-2 border border-red-400 text-red-500 rounded hover:bg-red-50 transition">
                  <TrashIcon class="w-4 h-4" />
                </button>
                <button class="p-2 border border-[#2EE091] text-[#2EE091] rounded hover:bg-green-50 transition">
                  <EyeIcon class="w-4 h-4" />
                </button>
                <button class="p-2 border border-blue-400 text-blue-500 rounded hover:bg-blue-50 transition">
                  <PencilIcon class="w-4 h-4" />
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap');

.font-mono {
  font-family: "Titillium Web", sans-serif;
  font-weight: 600;
  font-size: 17px;
}
</style>