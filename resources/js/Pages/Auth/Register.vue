<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextareaInput from '@/Components/TextareaInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    avatar: null,
    name: '',
    email: '',
    city: '',
    profession: '',
    bio: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <form @submit.prevent="submit" class="space-y-4" enctype="multipart/form-data">
            <div class="mb-6">
                <InputLabel for="avatar" value="Avatar" class="block text-sm font-medium text-gray-700 mb-1" />

                <TextInput id="avatar" type="file"@change="form.avatar = $event.target.files[0]"
                    class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 transition duration-200 ease-in-out"
                    autofocus />

                <InputError :message="form.errors.avatar" class="mt-2 text-sm text-red-600" />
            </div>
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput id="name" type="text" v-model="form.name" class="mt-1 block w-full" required autofocus />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <div>
                <InputLabel for="city" value="City" />
                <TextInput id="city" type="text" v-model="form.city" class="mt-1 block w-full" required />
                <InputError :message="form.errors.city" class="mt-2" />
            </div>

            <div>
                <InputLabel for="profession" value="Profession" />
                <TextInput id="profession" type="text" v-model="form.profession" class="mt-1 block w-full" required />
                <InputError :message="form.errors.profession" class="mt-2" />
            </div>

            <div>
                <InputLabel for="bio" value="Bio" />
                <TextareaInput id="bio" type="text" v-model="form.bio" class="mt-1 block w-full" required />
                <InputError :message="form.errors.bio" class="mt-2" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />
                <TextInput id="email" type="email" v-model="form.email" class="mt-1 block w-full" required />
                <InputError :message="form.errors.email" class="mt-2" />
            </div>

            <div>
                <InputLabel for="password" value="Password" />
                <TextInput id="password" type="password" v-model="form.password" class="mt-1 block w-full" required />
                <InputError :message="form.errors.password" class="mt-2" />
            </div>

            <div>
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput id="password_confirmation" type="password" v-model="form.password_confirmation"
                    class="mt-1 block w-full" required />
                <InputError :message="form.errors.password_confirmation" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <Link href="/login"
                    class="inline-flex items-center rounded-md border border-transparent bg-gray-200 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-800 transition duration-150 ease-in-out hover:bg-gray-300 focus:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 active:bg-gray-400">
                    Login
                </Link>
                <PrimaryButton :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
