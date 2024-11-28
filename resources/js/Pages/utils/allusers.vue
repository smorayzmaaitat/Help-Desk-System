<script>
import { Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3'
import { useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css'; 




export default {
    name: 'UsersManagement',
    components: {
        AuthenticatedLayout,
    },
    props: {
        users: {
            type: Array,
            default: () => [],
        }   ,
         flash: {
      type: Object,
      default: () => ({})
    }
  },

  mounted() {
    console.log("----------", this.flash.success);
    const toast = useToast();
    if (this.flash.success) {
      toast.success(this.flash.success, {
        position: 'top-right',
        duration: 3000,
      });
    }
  },
    data() {
        return {
            searchQuery: '',
            selectedUser: null,
            isManageModalOpen: false,
        }
    },
    computed: {
        filteredUsers() {
            if (!this.searchQuery) return this.users;
            const query = this.searchQuery.toLowerCase();
            return this.users.filter(user => 
                user.name.toLowerCase().includes(query) || 
                user.email.toLowerCase().includes(query)
            );
        }
    },
    methods: {
        openManageModal(user) {
            this.selectedUser = user;
            this.isManageModalOpen = true;
        },
        closeManageModal() {
            this.selectedUser = null;
            this.isManageModalOpen = false;
        },
        handleManageUser(action) {
            if (action === 'edit') {
                // Navigate to edit page with user data
                router.visit(`edituser/${this.selectedUser.id}`, {
                    method: 'get',
                    data: { userData: this.selectedUser }
                });
            } 
            if (action === 'delete') {
                // Navigate to edit page with user data
                router.visit(`delete/${this.selectedUser.id}`, {
                    method: 'put',
                    data: { userData: this.selectedUser }
                });
            }
            else {
                console.log(`Performing ${action} on user:`, this.selectedUser);
                this.closeManageModal();
            }
        }
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-6 flex justify-between items-center">
                    <h1 class="text-2xl font-semibold text-gray-900">
                        Users Management
                    </h1>
                    <!-- Search Bar -->
                    <div class="relative">
                        <input
                            type="text"
                            v-model="searchQuery"
                            placeholder="Search users..."
                            class="w-64 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>
                </div>

                <!-- Users Table -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Role
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="user in filteredUsers" :key="user.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <!-- User Avatar -->
                                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <span class="text-gray-500 font-medium">
                                                        {{ user.name.charAt(0) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ user.name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ user.email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ user.role }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                            :class="{
                                                'bg-green-100 text-green-800': user.status === 'active',
                                                'bg-red-100 text-red-800': user.status === 'inactive'
                                            }">
                                            {{ user.status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button
                                            @click="openManageModal(user)"
                                            class="text-indigo-600 hover:text-indigo-900 bg-indigo-100 px-3 py-1 rounded-md"
                                        >
                                            Manage
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Management Modal -->
                <div v-if="isManageModalOpen" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
                    <div class="bg-white rounded-lg p-6 max-w-md w-full">
                        <h2 class="text-xl font-semibold mb-4">Manage User: {{ selectedUser?.name }}</h2>
                        <div class="space-y-4">
                            <button
                                @click="handleManageUser('edit')"
                                class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                            >
                                Edit User
                            </button>

                            <button
                                @click="handleManageUser('delete')"
                                class="w-full bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                            >
                                Delete User
                            </button>
                            <button
                                @click="closeManageModal"
                                class="w-full bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400"
                            >
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>