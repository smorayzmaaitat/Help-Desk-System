<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { BsChatLeftDotsFill } from 'vue-icons-plus/bs'

export default {

  components: {
    BsChatLeftDotsFill,

    AuthenticatedLayout,
  },
  
  props: {
    tickets: {
      type: Array,
      required: true
    },
    staffList: {
      type: Array,
      required: true,
      default: () => []
    }
    ,
  comments: {
    type: Array,
    default:  []
  }

  },


data()
{
  return {
    selected_staff: null,
    localComments: [...this.comments] ,// Create a local reactive copy of comments
    ticket: this.tickets[0] ,
    newComment: "",
  }
},
 
created() {
  window.Echo.private('comments')
    .listen('CommentAdded', (e) => {
      console.log('Event received:', e);

      // Check if the comment belongs to the current ticket
      const currentTicketId = this.tickets[0]?.id;
      console.log('-------------', e.ticket_id," ", currentTicketId);
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
    assignStaff(ticket) {
      const staffAssignment = {
        ticket_id: ticket.id,
        staff_id: this.selected_staff,
      };
      this.$inertia.post('/tickets/assign-staff', staffAssignment);
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


}
</script>

<template>
  <AuthenticatedLayout>
    <div class="bg-white rounded-lg shadow-md p-6 max-w-4xl mx-auto">
      <h1 class="text-2xl font-bold mb-4">Ticket Status</h1>
      <div class="space-y-4">
        <div v-for="ticket in tickets" :key="ticket.id" class="bg-gray-100 rounded-lg p-4">
          <div class="flex justify-between items-center">
            <div>
              <div>Title: <span class="font-medium">{{ ticket.title || 'N/A' }}</span></div>
              <div>Description: <span class="font-medium">{{ ticket.description || 'N/A' }}</span></div>
            </div>
            <div class="space-y-2">
              <div>Category: <span class="font-medium">{{ ticket.category || 'N/A' }}</span></div>
              <div>Priority: <span class="font-medium">{{ ticket.priority || 'N/A' }}</span></div>
              <div>Department: <span class="font-medium">{{ ticket.department || 'N/A' }}</span></div>
              <div>

                                  <div v-if="ticket.attachment">
                    <img v-if="ticket.attachment" :src="`/storage/${ticket.attachment}`" alt="Attachment" class="max-w-[150px] max-h-[150px] rounded">
                    <a :href="`/storage/${ticket.attachment}`" download class="mt-2 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                      Download Attachment
                    </a>
                  </div>
                  
                <div v-else>Attachment: N/A</div>
              </div>
            </div>
          </div>
          <div class="flex justify-between items-center mt-4">
              <div class="text-sm bg-gray-50 p-3 rounded-md shadow-sm space-y-1">
              <div>Created At: <span class="font-medium">{{ formatDateTime(ticket.created_at) }}</span></div>
              <div>Updated At: <span class="font-medium">{{ formatDateTime(ticket.updated_at) }}</span></div>
              <div>Checked By: <span class="font-medium">{{ ticket.checked_by || 'N/A' }}</span></div>
              <div>Resolved By: <span class="font-medium">{{ ticket.resolved_by || 'N/A' }}</span></div>
              <div>Resolved At: <span class="font-medium">{{ formatDateTime(ticket.resolved_at) }}</span></div>
              <div>Staff Note: <span class="font-medium">{{ ticket.staff_notes || 'N/A' }}</span></div>
              <div>Staff Solutions: <span class="font-medium">{{ ticket.staff_solutions || 'N/A' }}</span></div>
              <div>User Feedback: <span class="font-medium">{{ ticket.feedback || 'N/A' }}</span></div>
          </div>
          </div>
        </div>

                            <!-- New Comments Section -->
         
                            <div class="mt-4">
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
    <div class=" bg-gray-100">      
      <p class="text-gray-800 mt-1">{{ comment.content }}</p>
    </div>

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
    </div>
  </AuthenticatedLayout>
</template>

