

<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout >
    <section class="flex justify-center py-8">
      <main class="w-full max-w-4xl">
        <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 mb-6 animate-gradient-x">
    Welcome {{ userName }} 
  </h1>        
        <h2 class="text-xl font-bold text-gray-800 mb-6">Your Tickets</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <article v-for="ticket in tickets" :key="ticket.id" class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="flex items-start p-4">
              <div class="flex-shrink-0">
                <img v-if="ticket.attachment" :src="`/storage/${ticket.attachment}`" class="w-20 h-20 rounded-lg object-cover" :alt="ticket.title" />
                <div v-else class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                  <svg class="w-8 h-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
                </div>
              </div>
              <div class="ml-4 flex-1">
                <h3 class="text-lg font-bold text-gray-800 mb-2">{{ ticket.title }}</h3>
                <p class="text-gray-600 line-clamp-2 mb-2">{{ ticket.description }}</p>
                <div class="flex justify-between text-gray-500 text-sm mb-2">
                  <span>Category: {{ ticket.category }}</span>
                  <span>Priority: {{ ticket.priority }}</span>
                </div>
                <div class="flex justify-between">
                  <button 
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition-colors duration-300" 
                    @click="viewTicketStatus(ticket)"
                  >
                    View Ticket Status
                  </button>
                </div>
              </div>
            </div>
          </article>
        </div>
      </main>
    </section>
  </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

export default {
  components: {
    AuthenticatedLayout,
    Head
  },
  props: {
    userName: String,
    tickets: Array,
    // notifications: {
    //   type: Array,
    //   default:  []
    // }
  },
  methods: {
    editTicket(ticket) {
      this.$inertia.visit(`/edittickets/${ticket.id}`);
    },
    viewTicketStatus(ticket) {
      this.$inertia.visit(`/viewtickets/${ticket.id}`);
    }
  }
}
</script>