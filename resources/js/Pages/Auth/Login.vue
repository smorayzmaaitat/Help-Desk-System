<template>
    <GuestLayout>
        <Head title="Login - Help Desk Ticketing System" />

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="text-center text-2xl font-bold tracking-tight text-gray-900 mb-6">
                Help Desk Ticketing System
            </h2>
            <h3 class="mt-2 text-center text-xl text-gray-600 mb-8">
                Sign in to your account
            </h3>
        </div>

        <div class=" px-4 py-8 shadow sm:rounded-lg sm:px-10">
            <div v-if="status" class="mb-4 rounded-md  p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ status }}</p>
                    </div>
                </div>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <!-- Email Input -->
                <div>
                    <InputLabel for="email" value="Email" class="font-semibold" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <!-- Password Input -->
                <div class="mt-4">
                    <InputLabel for="password" value="Password" class="font-semibold" />
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <!-- Role Selection -->
                <div class="mt-4">
                    <InputLabel for="role" value="Role" class="font-semibold" />
                    <select
                        id="role"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        v-model="form.role"
                        required
                    >
                        <option disabled value="">Select your role</option>
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                        <option value="supervisor">Supervisor</option>
                        <option value="user">User</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.role" />
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-offset-0" />
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <!-- Submit Button and Links -->
                <div>
                    <PrimaryButton
                        class="w-full justify-center rounded-md bg-indigo-600 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Sign in
                    </PrimaryButton>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-sm text-indigo-600 hover:text-indigo-500"
                    >
                        Forgot your password?
                    </Link>

                    <Link
                        :href="route('register')"
                        class="text-sm text-indigo-600 hover:text-indigo-500"
                    >
                        Don't have an account?
                    </Link>
                </div>
            </form>
        </div>


    </GuestLayout>
</template>

<script>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

export default {
    components: {
        Checkbox,
        GuestLayout,
        InputError,
        InputLabel,
        PrimaryButton,
        TextInput,
        Head,
        Link,
    },
    props: {
        canResetPassword: Boolean,
        status: String,
    },
    data() {
        return {
            form: useForm({
                email: '',
                password: '',
                role: '',
                remember: false,
                errors: {},
                processing: false,
            }),
        };
    },
    methods: {
        submit() {
            this.form.processing = true;
            this.form.post(route('login'), {
                onFinish: () => {
                    this.form.processing = false;
                    this.form.reset('password');
                },
                onError: (errors) => {
                    this.form.errors = errors;
                },
            });
        },
    },
};
</script>