<template>
    <AuthenticatedLayout>
      <div class="container mx-auto px-4 py-6">
        <div class="flex items-center mb-6">
          <BsBellFill class="mr-3 text-blue-600 text-3xl" />
          <h1 class="text-2xl font-bold text-gray-800">Notifications</h1>
        </div>
 
        <div v-if="notifications.length === 0" class="text-center py-10">
          <BsInboxFill class="mx-auto text-6xl text-gray-300 mb-4" />
          <p class="text-gray-500">No notifications at the moment.</p>
        </div>
 
        <div v-else class="space-y-4">
          <div 
            v-for="notification in notifications"
            :key="notification.id"
            class="bg-white shadow-md rounded-lg p-4 border-l-4 border-blue-500 hover:shadow-lg transition-shadow duration-300 group"
          >
            <div class="flex justify-between items-center mb-2">
              <div class="flex items-center">
                <BsInfoCircleFill class="mr-2 text-blue-500" />
                <h2 class="text-lg font-semibold text-gray-800">{{ notification.title }}</h2>
              </div>
              <span class="text-sm text-gray-500">
                {{ formatDate(notification.created_at) }}
              </span>
            </div>
            <p class="text-gray-600">{{ notification.content }}</p>
            <div class="mt-2 text-sm text-gray-500 flex items-center">
              <BsPeopleFill class="mr-2 text-gray-400" />
              Sent by: {{extractSender(notification.content) }}
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
 </template>
 
 <script>
 import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
 import { BsBellFill, BsInboxFill, BsInfoCircleFill, BsPeopleFill } from 'vue-icons-plus/bs';
 
 export default {
   components: {
     AuthenticatedLayout,
     BsBellFill,
     BsInboxFill,
     BsInfoCircleFill,
     BsPeopleFill
   },
   props: {
     notifications: {
       type: Array,
       default: () => []
     }
   },
   methods: {
     extractSender(content) {
       const words = content.trim().split(' ');
       return words[1];
     },
     formatDate(dateString) {
       const date = new Date(dateString);
       return date.toLocaleDateString('en-US', {
         year: 'numeric',
         month: 'short',
         day: 'numeric',
         hour: '2-digit',
         minute: '2-digit'
       });
     }
   }
 }
 </script>