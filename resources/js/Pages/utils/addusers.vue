<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: 'user', // default role
});

// Method to handle form submission
function submitForm() {
    if (form.password !== form.password_confirmation) {
        alert("Passwords do not match!");
        return;
    }
    // Submit form data to the backend (e.g., '/addusers' route)
    form.post('/addusers');
}
</script>

<template>
    <Head title="Add User" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-2xl font-bold text-center text-gray-700">Add New User</h1>
        </template>

        <div class="max-w-lg mx-auto mt-8 p-6 bg-white rounded shadow-md">
            <form @submit.prevent="submitForm">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name:</label>
                    <input v-model="form.name" type="text" id="name" class="w-full p-2 mt-1 border rounded" required />
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email:</label>
                    <input v-model="form.email" type="email" id="email" class="w-full p-2 mt-1 border rounded" required />
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password:</label>
                    <input v-model="form.password" type="password" id="password" class="w-full p-2 mt-1 border rounded" required />
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700">Confirm Password:</label>
                    <input v-model="form.password_confirmation" type="password" id="password_confirmation" name="password_confirmation" class="w-full p-2 mt-1 border rounded" required />
                </div>

                <div class="mb-4">
                    <label for="role" class="block text-gray-700">Role:</label>
                    <select v-model="form.role" id="role" class="w-full p-2 mt-1 border rounded">
                        <option value="user">User</option>
                        <option value="staff">Staff</option>
                        <option value="supervisor">Supervisor</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <button type="submit" class="w-full p-2 mt-4 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Add User
                </button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
