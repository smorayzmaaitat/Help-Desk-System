<template>
  <AuthenticatedLayout>
    <div class="container mx-auto px-6 py-8">
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md h-[800px] flex flex-col">
        <!-- Chat Header -->
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
          <div class="flex items-center space-x-3">
            <div class="p-2 rounded-full bg-blue-100 dark:bg-blue-900">
              <BsPersonFill class="text-blue-600 dark:text-blue-400" />
            </div>
            <div>
              <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                {{ receiver.name }}
              </h2>
              <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ receiver.email }}
              </p>
            </div>
          </div>
        </div>

        <!-- Chat Messages -->
        <div class="flex-1 overflow-y-auto p-6 space-y-4" ref="messageContainer">
          <template v-for="message in messages" :key="message.id">
            <div :class="[
              'flex',
              message.sender_id === $page.props.auth.user.id ? 'justify-end' : 'justify-start'
            ]">
              <div :class="[
                'max-w-[70%] rounded-lg px-4 py-2',
                message.sender_id === $page.props.auth.user.id
                  ? 'bg-blue-500 text-white'
                  : 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-200'
              ]">
                <p>{{ message.content }}</p>
                <span class="text-xs opacity-75 mt-1 block">
                  {{ formatTime(message.created_at) }}
                </span>
              </div>
            </div>
          </template>
        </div>

        <!-- Message Input -->
        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
          <form @submit.prevent="sendMessage" class="flex space-x-4">
            <input
              v-model="newMessage"
              type="text"
              placeholder="Type your message..."
              class="flex-1 px-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 
                     dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            />
            <button
              type="submit"
              class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 
                     transition-colors flex items-center space-x-2"
              :disabled="!newMessage.trim()"
            >
              <BsSend />
              <span>Send</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import { router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { BsPersonFill, BsSend } from 'vue-icons-plus/bs';

export default {
  components: {
    AuthenticatedLayout,
    BsPersonFill,
    BsSend,
  },

  props: {
    receiver: {
      type: Object,
      required: true
    },
    messages: {
      type: Array,
      default:  []
    }
  },

  data() {
    return {
      newMessage: '',
    }
  },

  methods: {
    sendMessage() {
      if (!this.newMessage.trim()) return;

      this.$inertia.post('/messages_send', {
        receiver_id: this.receiver.id,
        content: this.newMessage
      }, {
        onSuccess: () => {
          this.newMessage = '';
        }
      });
    },



    formatTime(timestamp) {
      return new Date(timestamp).toLocaleTimeString([], {
        hour: '2-digit', 
        minute: '2-digit'
      });
    }
  },

  mounted() {


    // WebSocket listener
    window.Echo.private('chat')
      .listen('MessageSent', (e) => {
        console.log("--------------------<<<",e.sender_id);
        if (
          (e.sender_id === this.receiver.id && 
           e.receiver_id === this.$page.props.auth.user.id) ||
          (e.sender_id === this.$page.props.auth.user.id && 
           e.receiver_id === this.receiver.id)
        ) {
          this.$page.props.messages.push(e);
        }
      });
  },


}
</script>