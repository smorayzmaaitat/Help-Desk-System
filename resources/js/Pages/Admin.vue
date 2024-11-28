<template>
    <Head title="Dashboard - Help Desk Ticketing System" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <!-- Welcome Section -->
                        <div class="text-center mb-8">
                            <h3 class="text-lg text-gray-600">
                                Welcome back, {{ userName }}!
                            </h3>
                        </div>

                        <!-- Quick Actions Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                            <!-- Add Users Card -->
                            <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-200">
                                <div class="p-5">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-medium text-gray-900">Add Users</h4>
                                            <p class="mt-1 text-sm text-gray-500">Create new user accounts</p>
                                        </div>
                                    </div>
                                    <Link
                                        href="/addusers"
                                        class="mt-4 w-full inline-flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                    >
                                        Go to Add Users
                                    </Link>
                                </div>
                            </div>

                            <!-- Manage Users Card -->
                            <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-200">
                                <div class="p-5">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-medium text-gray-900">Manage Users</h4>
                                            <p class="mt-1 text-sm text-gray-500">Manage accounts and roles</p>
                                        </div>
                                    </div>
                                    <Link
                                        href="/all_users"
                                        class="mt-4 w-full inline-flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    >
                                        Manage User Accounts
                                    </Link>
                                </div>
                            </div>

                            <!-- Quick Stats Card -->
                            <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-200">
                                <div class="p-5">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />

                                        </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-medium text-gray-900">View All Tickets</h4>
                                            <p class="mt-1 text-sm text-gray-500">View all system Tickets</p>
                                        </div>
                                    </div>
                                    <Link
                                        href="/alltickitadmin"
                                        class="mt-4 w-full inline-flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                    >
                                    View All Tickets
                                    </Link>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Links Section -->
                        <div class="mt-8 border-t border-gray-200 pt-8">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Quick Links</h4>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                          <Link href="/reports" class="text-sm text-indigo-600 hover:text-indigo-500">Generate Reports</Link>
                                <Link href="/appsitting" class="text-sm text-indigo-600 hover:text-indigo-500">System Settings</Link>
                                <Link href="/help" class="text-sm text-indigo-600 hover:text-indigo-500">Help & Support</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css'; 


export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link
    },
    props: {
        userName: String,
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

    methods: {
        viewAllTickets() {
            this.$inertia.visit('/alltickitadmin');
        }
    }
}
</script>