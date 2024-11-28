<template>
  <AuthenticatedLayout>
    <div class="bg-white rounded-lg shadow-md p-6 max-w-4xl mx-auto">
      <h1 class="text-2xl font-bold mb-4">Ticket Status</h1>
      <div class="space-y-4">
        <div v-for="ticket in tickets" :key="ticket.id" class="bg-gray-100 rounded-lg p-4">
          <div class="flex justify-between items-center">
            <div>
              <div class="font-bold">ID: {{ ticket.id || 'N/A' }}</div>
              <div>Title: {{ ticket.title || 'N/A' }}</div>
              <div>Description: {{ ticket.description || 'N/A' }}</div>
            </div>
            <div class="space-y-2">
              <div>Category: {{ ticket.category || 'N/A' }}</div>
              <div>Priority: {{ ticket.priority || 'N/A' }}</div>
              <div>Department: {{ ticket.department || 'N/A' }}</div>
              <div>
                <div v-if="ticket.attachment">
                  <img v-if="ticket.attachment" :src="`/storage/${ticket.attachment}`" alt="Attachment" class="max-w-[150px] max-h-[150px] rounded">
                </div>
                <div v-else>Attachment: N/A</div>
              </div>
            </div>
          </div>
          <div class="flex justify-between items-center mt-4">
            <div class="space-y-2">
              <div>Created At: {{ formatDateTime(ticket.created_at) }}</div>
              <div>Updated At: {{ formatDateTime(ticket.updated_at) }}</div>
              <div>Checked By: {{ ticket.checked_by || 'N/A' }}</div>
              <div>Resolved By: {{ ticket.resolved_by || 'N/A' }}</div>
              <div>Resolved At: {{ formatDateTime(ticket.resolved_at) }}</div>
              <div>Staff Note: {{ ticket.staff_notes || 'N/A' }}</div>
              <div>Staff Solutions: {{ ticket.staff_solutions || 'N/A' }}</div>
              <div>User Feedback: {{ ticket.feedback || 'N/A' }}</div>
            </div>
            <div class="space-y-2">
              <div>Status: {{ ticket.status || 'N/A' }}</div>
              <div>Time to Resolve: {{ ticket.time_to_resolve || 'N/A' }}</div>
              <div v-if="ticket.feedback == null">
                <input v-model="feedbackinput" type="text" class="border rounded px-2 py-1 w-full" />
                <button @click="sendFeedback(ticket)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mt-2 w-full">
                  Send Feedback
                </button>
              </div>
            </div>
          </div>
</div>
          <!-- New Comments Section -->
           
          <div class="relative flex items-center space-x-2 mb-1">
    <h2 class="text-lg font-semibold text-gray-800">Comments</h2>
    <BsChatLeftDotsFill size="18" class="text-blue-500"/>
    <span class="ml-2 text-sm text-gray-500 bg-gray-100 px-2 rounded-full">
      {{ localComments.length }}
    </span>
  </div>
  <div class="max-h-60 overflow-y-auto border rounded-lg p-2 bg-gray-50 shadow-inner">
    <div v-for="comment in localComments" :key="comment.id" class="border-b last:border-b-0 py-3 hover:bg-gray-100 transition-colors">
      <p><strong class="text-gray-700">{{ comment.user_name }}:</strong> <span class="text-gray-600">{{ comment.user_role }}</span></p>
      <p class="text-gray-800 mt-1">{{ comment.content }}</p>
      <p class="text-sm text-gray-500 mt-1">{{ ho(comment.created_at) }}</p>
    </div>
    <div v-if="localComments.length === 0" class="text-gray-500 text-center py-4">No comments yet</div>
  </div>
  <div class="mt-4 flex space-x-2">
    <input v-model="newComment" type="text" placeholder="Write a comment..." class="flex-grow border rounded px-3 py-2 focus:ring-2 focus:ring-blue-200 transition-all" />
    <button @click="addComment(ticket)" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition-colors">
      Send
    </button>
  </div>

        
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { SlActionRedo } from "vue-icons-plus/sl";
import { BsFillTicketPerforatedFill } from 'vue-icons-plus/bs'
import { BsChatLeftDotsFill } from 'vue-icons-plus/bs'


export default {
  components: {
    BsFillTicketPerforatedFill ,
    BsChatLeftDotsFill,
    AuthenticatedLayout,
  },
  props: {
    tickets: {
      type: Array,
      required: true
    },
    comments: {
      type: Array,
      default:  []
    }
  },
  data() {
    return {
      localComments: [...this.comments] ,// Create a local reactive copy of comments
      ticket: this.tickets[0] ,
      feedbackinput: null,
      newComment: "",
    };
  },
  created() {
    window.Echo.private('comments')
      .listen('CommentAdded', (e) => {
        console.log('Event received:', e);

        // Check if the comment belongs to the current ticket
        const currentTicketId = this.tickets[0]?.id; // Assuming first ticket in the list
        if (e.ticket_id === currentTicketId) {
          this.localComments.push({
            id: e.id,
            ticket_id: e.ticket_id,
            user_id: e.user_id,
            user_name: e.user_name,
            user_role: e.user_role,
            content: e.content,
            created_at: e.created_at,
          });
        }
      });
  },
  methods: {
    sendFeedback(ticket) {
      const feedback = {
        ticket_id: ticket.id,
        feedback: this.feedbackinput,
      };
      this.$inertia.post('/tickets/feedback', feedback);
    },
    addComment(ticket) {
      if (!this.newComment.trim()) {
        alert("Comment cannot be empty.");
        return;
      }
      const commentData = {
        ticket_id: ticket.id,
        content: this.newComment
      };
      this.$inertia.post('/addcomments', commentData, {
        onSuccess: () => {
          this.newComment = ""; 
        }
      });
    },
    formatDateTime(dateTime) {
      if (!dateTime) return 'N/A';
      const date = new Date(dateTime);
      return `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')} ${String(date.getHours()).padStart(2, '0')}:${String(date.getMinutes()).padStart(2, '0')}`;
    },
    ho(dateTime) {
      if (!dateTime) return 'N/A';
      const date = new Date(dateTime);
      return ` ${String(date.getHours()).padStart(2, '0')}:${String(date.getMinutes()).padStart(2, '0')}`;
    }
  }
};
</script>
