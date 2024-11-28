<template>
    <AuthenticatedLayout>
      <div class="container mx-auto px-6 py-8">
        <div class="rounded-lg shadow-md">
          <!-- Header Section -->
          <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
              <div class="flex items-center space-x-3">
                <BsPeopleFill class="text-blue-600 text-2xl" />
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">All Users</h2>
              </div>
              <div class="relative">
                <input
                  v-model="search"
                  type="text"
                  placeholder="Search users..."
                  class="pl-10 pr-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200
                         focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                />
                <BsSearch class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" />
              </div>
            </div>
          </div>
  
          <!-- Users Table -->
          <div class="p-6">
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead>
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                      Name
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                      Email
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                      Role
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                  <tr v-for="user in filteredUsers" :key="user.id" 
                      class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center space-x-3">
                        <div class="p-2 rounded-full bg-blue-100 dark:bg-blue-900">
                          <BsPersonFill class="text-blue-600 dark:text-blue-400" />
                        </div>
                        <span class="text-gray-900 dark:text-gray-200">{{ user.name }}</span>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-300">
                      {{ user.email }}
                      
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span :class="[
                        'px-3 py-1 rounded-full text-sm font-medium',
                        user.role === 'admin' 
                          ? 'bg-purple-100 text-purple-700 dark:bg-purple-900 dark:text-purple-300'
                          : 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300'
                      ]">
                        {{ user.role }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <button
                        @click="startChat(user)"
                        class="flex items-center space-x-2 px-4 py-2 text-sm text-blue-600 hover:text-blue-800
                               dark:text-blue-400 dark:hover:text-blue-300 transition-colors"
                      >
                        <BsChatFill class="text-sm" />
                        <span>Chat</span>
                      </button>
                      
                    </td>

                    <td class=" whitespace-nowrap">
                    <div v-if="userNotificationCounts[user.id]" class="inline-flex items-center">
                  <span class=" px-2 py-1 text-xs font-bold rounded-full 
                  text-white dark:bg-blue-500">
                      {{ userNotificationCounts[user.id] }}
                  </span>
  </div>
</td>
                    </tr>
                </tbody>
              </table>
            </div>
  
            <!-- Empty State -->
            <div v-if="filteredUsers.length === 0" 
                 class="text-center py-12">
              <BsSearchHeart class="mx-auto h-12 w-12 text-gray-400" />
              <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-200">No users found</h3>
              <p class="mt-2 text-gray-500 dark:text-gray-400">
                Try adjusting your search terms to find what you're looking for.
              </p>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>
  
  <script>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { 
    BsPeopleFill, 
    BsPersonFill, 
    BsSearch,
    BsChatFill,
    BsSearchHeart 
  } from 'vue-icons-plus/bs';
  import { useToast } from 'vue-toast-notification';
  import 'vue-toast-notification/dist/theme-bootstrap.css';
  
  export default {
    components: {
      AuthenticatedLayout,
      BsPeopleFill,
      BsPersonFill,
      BsSearch,
      BsChatFill,
      BsSearchHeart
    },
  
    props: {
      users: {
        type: Array,
        required: true
      },
      flash: {
        type: Object,
        default: () => ({})
      }
    },
  
    data() {
      return {
        search: '',
        userNotificationCounts:{}
      }
    },
    created() {

    this.$page.props?.notifications.forEach((notification) => {
        const userId = notification.sender_id;
        if (this.userNotificationCounts[userId]) {
            this.userNotificationCounts[userId] += 1;
        } else {
            this.userNotificationCounts[userId] = 1;
        }
    });

    console.log("User notification counts:", this.userNotificationCounts);
 
    window.Echo.private(`notifications.${this.$page.props.auth.user.id}`)
        .listen("NotificationEvent", (e) => {
            console.log("------------lololo",e)
            const userId = e.sender_id;
        if (this.userNotificationCounts[userId]) {
            this.userNotificationCounts[userId] += 1;
        } else {
            this.userNotificationCounts[userId] = 1;
        }
        });

  },

    computed: {
      filteredUsers() {
        const searchTerm = this.search.toLowerCase();
        return this.users.filter(user => 
          user.name.toLowerCase().includes(searchTerm) ||
          user.email.toLowerCase().includes(searchTerm) ||
          user.role.toLowerCase().includes(searchTerm)
        );
      }
    },
  
    watch: {
      'flash.success': function(newMessage) {
        this.showToast(newMessage);
      }
    },
  
    mounted() {
      this.showToast(this.flash.success);
    },
  
    methods: {
      showToast(message) {
        if (message) {
          const toast = useToast();
          toast.success(message, {
            position: 'top-right',
            duration: 3000,
          });
        }
      },
  
      startChat(user) {
        // Navigate to chat with the selected user
        this.$inertia.visit(`/chat/${user.id}`);
      }
    }
  }

  </script>