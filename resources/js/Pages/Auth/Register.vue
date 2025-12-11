<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
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

        <form @submit.prevent="submit" class="space-y-4">
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
                <TextInput id="bio" type="text" v-model="form.bio" class="mt-1 block w-full" required />
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
                <Link href="/login" class="underline text-sm text-gray-600 hover:text-gray-900">
                Already registered?
                </Link>
                <PrimaryButton :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
