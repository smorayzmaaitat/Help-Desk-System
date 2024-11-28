<script>
import { Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3'

export default {
    name: 'EditUser',
    components: {
        AuthenticatedLayout,
    },
    props: {
        userData: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            form: {
                name: this.userData.name,
                email: this.userData.email,
                role: this.userData.role,
                status: this.userData.status,
            },
            processing: false,
            errors: {}
        }
    },
    methods: {
        submitForm() {
            this.processing = true;
            
            // Using Inertia to submit the form
            router.put(`/update/${this.userData.id}`, this.form, {
                onSuccess: () => {
                    this.processing = false;
                   
                },
                onError: (errors) => {
                    this.errors = errors;
                    this.processing = false;
                }
            });
        },
        cancelEdit() {
            router.visit('/all_users');
        }
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-2xl font-bold mb-6">Edit User: {{ userData.name }}</h2>
                        
                        <form @submit.prevent="submitForm" class="space-y-6">
                            <!-- Name Input -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input 
                                    type="text"
                                    id="name"
                                    v-model="form.name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                />
                                <p v-if="errors.name" class="mt-1 text-sm text-red-600">{{ errors.name }}</p>
                            </div>

                            <!-- Email Input -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input 
                                    type="email"
                                    id="email"
                                    v-model="form.email"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                />
                                <p v-if="errors.email" class="mt-1 text-sm text-red-600">{{ errors.email }}</p>
                            </div>

                            <!-- Role Select -->
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                <select 
                                    id="role"
                                    v-model="form.role"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >

                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                    <option value="staff">Staff</option>
                                    <option value="supervisor">Supervisor</option>
                                </select>
                                <p v-if="errors.role" class="mt-1 text-sm text-red-600">{{ errors.role }}</p>
                            </div>


                            <!-- Form Actions -->
                            <div class="flex justify-end space-x-3">
                                <button
                                    type="button"
                                    @click="cancelEdit"
                                    class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50"
                                >
                                    Cancel
                                </button>
                                <button
                                    type="submit"
                                    :disabled="processing"
                                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    :class="{ 'opacity-75 cursor-not-allowed': processing }"
                                >
                                    {{ processing ? 'Saving...' : 'Save Changes' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>