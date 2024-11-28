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
        <Head title="Register - Help Desk Ticketing System" />

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="text-center text-2xl font-bold tracking-tight text-gray-900 mb-8">
                Help Desk Ticketing System
            </h2>
            <h3 class="mt-2 text-center text-xl text-gray-600 mb-8">
                Create Your Account
            </h3>
        </div>

        <form @submit.prevent="submit" class="space-y-6">
            <div class="bg-white px-4 py-8 shadow sm:rounded-lg sm:px-10">
                <div>
                    <InputLabel for="name" value="Name" class="font-semibold" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Email" class="font-semibold" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        v-model="form.email"
                        required
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Password" class="font-semibold" />
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <InputLabel
                        for="password_confirmation"
                        value="Confirm Password"
                        class="font-semibold"
                    />
                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.password_confirmation"
                    />
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <Link
                        :href="route('login')"
                        class="text-sm text-indigo-600 hover:text-indigo-500 font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Already have an account? Sign in
                    </Link>

                    <PrimaryButton
                        class="ml-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Create Account
                    </PrimaryButton>
                </div>
            </div>
        </form>

    </GuestLayout>
</template>