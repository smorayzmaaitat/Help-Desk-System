<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

export default {
  components: {
    AuthenticatedLayout,
    Head,
    Link,
  },
  props: {
    userName: String,
    tickets: Array,
    selectedRole: {
    type: String,
    default: "open", 
  }
  },

  data() {
    return {
        selectedRoleLocal: this.selectedRole || "open", 
    };
  },


  watch: {
    selectedRoleLocal(newRole) {
      // Make a request to fetch data based on the selected role
      this.$inertia.visit(`/alltickitadmin`, {
        method: 'get',
        data: { role: newRole },
        only: ['tickets'],
        preserveState: true,
      });
    },
  },


  methods: {
    editTicket(ticket) {
      this.$inertia.visit(`/edittickets/${ticket.id}`);
    },
    viewTicketStatus(ticket) {
      this.$inertia.visit(`/viewtickets/${ticket.id}`);
    },
    deleteTicket(ticket) {
      this.$inertia.post(`/deleteticket/${ticket.id}`);
    }
  },
};


</script>

<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <section class="flex justify-center py-8">
      <main class="w-full max-w-4xl">
        <select
          id="role"
          class="mt-1 block  rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
          v-model="selectedRoleLocal"
        >
          <option value="open">Open</option>
          <option value="in progress">in progress</option>
          <option value="resolved">Resolved</option>
          <option value="closed">closed</option>
        </select>
        <p class="mt-4 text-sm text-gray-600">Selected Status: {{ selectedRoleLocal }}</p>
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
                  <span>Status: {{ ticket.status }}</span>
                </div>
                <div class="flex justify-between">
                  <!-- <button class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300" @click="editTicket(ticket)">
                    Edit Ticket
                  </button> -->
                  <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition-colors duration-300" @click="viewTicketStatus(ticket)">

                    View Ticket Status
                  </button>
                  <button 
  @click="deleteTicket(ticket)"
  class="text-red-500 hover:text-red-700 hover:bg-red-50 p-2 rounded-full transition-all duration-300 group"
>
  <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
  </svg>
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
