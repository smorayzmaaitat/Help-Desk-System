<template>
    <AuthenticatedLayout>
      <section class="flex justify-center py-8 bg-gray-50">
        <main class="w-full max-w-lg">
          <div class="bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Ticket</h1>
            
            <form @submit.prevent="submitForm" class="space-y-6">
              <!-- Title -->
              <div class="space-y-2">
                <label class="block text-gray-700 font-medium">Title<span class="text-red-500">*</span></label>
                <input
                  type="text"
                  v-model="form.title"
                  class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                  placeholder="Enter ticket title"
                  required
                />
              </div>
  
              <!-- Department (New Required Field) -->
              <div class="space-y-2">
                <label class="block text-gray-700 font-medium">Department<span class="text-red-500">*</span></label>
                <select
                  v-model="form.department"
                  class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                  required
                >
                  <option value="">Select Department</option>
                  <option value="IT">IT</option>
                  <option value="HR">HR</option>
                  <option value="Finance">Finance</option>
                  <option value="Marketing">Marketing</option>
                  <option value="Operations">Operations</option>
                </select>
              </div>
  
              <!-- Description -->
              <div class="space-y-2">
                <label class="block text-gray-700 font-medium">Description<span class="text-red-500">*</span></label>
                <textarea
                  v-model="form.description"
                  class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                  rows="4"
                  placeholder="Provide detailed description"
                  required
                ></textarea>
              </div>
  
              <!-- Category -->
              <div class="space-y-2">
                <label class="block text-gray-700 font-medium">Category<span class="text-red-500">*</span></label>
                <select
                  v-model="form.category"
                  class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                  required
                >
                  <option value="">Select Category</option>
                  <option value="Bug">Bug</option>
                  <option value="Feature">Feature Request</option>
                  <option value="Support">Support</option>
                  <option value="Maintenance">Maintenance</option>
                </select>
              </div>
  
              <!-- Priority -->
              <div class="space-y-2">
                <label class="block text-gray-700 font-medium">Priority<span class="text-red-500">*</span></label>
                <select
                  v-model="form.priority"
                  class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                  required
                >
                  <option value="">Select Priority</option>
                  <option value="Low">Low</option>
                  <option value="Medium">Medium</option>
                  <option value="High">High</option>
                  <option value="Critical">Critical</option>
                </select>
              </div>
  
              <!-- Attachment -->
              <div class="space-y-2">
                <label class="block text-gray-700 font-medium">Attachment</label>
                <div class="flex items-center justify-center w-full">
                  <label class="w-full flex flex-col items-center px-4 py-6 bg-white rounded-lg border-2 border-dashed border-gray-300 cursor-pointer hover:bg-gray-50">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="mt-2 text-sm text-gray-500">Click to upload or drag and drop</span>
                    <input type="file" @change="handleAttachment" class="hidden" />
                  </label>
                </div>
                <span v-if="form.attachment" class="text-sm text-gray-500">
                  Selected file: {{ form.attachment.name }}
                </span>
              </div>
  
              <!-- Submit Button -->
              <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors duration-300 focus:ring-4 focus:ring-blue-300"
              >
                Update Ticket
              </button>
            </form>
          </div>
        </main>
      </section>
    </AuthenticatedLayout>
  </template>
  
  <script>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { useForm } from '@inertiajs/vue3';
  import { router } from '@inertiajs/vue3'
  
  export default {
    components: {
      AuthenticatedLayout,
    },
    props: {
      ticket: {
        type: Object,
        required: true,
      },
    },
    data() {
      return {
        form: {
          title: this.ticket.title || '',
          description: this.ticket.description || '',
          category: this.ticket.category || '',
          priority: this.ticket.priority || '',
          department: this.ticket.department || '',
          attachment: null,
        },
      };
    },
    methods: {
      handleAttachment(event) {
        this.form.attachment = event.target.files[0];
      },
      submitForm() {
        const formData = new FormData();
        formData.append('title', this.form.title);
        formData.append('description', this.form.description);
        formData.append('category', this.form.category);
        formData.append('priority', this.form.priority);
        formData.append('department', this.form.department);
  
        if (this.form.attachment) {
          formData.append('attachment', this.form.attachment);
        }
  
        router.post(`/updteckets/${this.ticket.id}`, formData, {
          onSuccess: () => {
            // You can add success notification here
          },
          onError: () => {
            // You can add error handling here
          }
        });
      },
    },
  };
  </script>
  
  <style scoped>
  /* Add any custom styles here */
  </style>