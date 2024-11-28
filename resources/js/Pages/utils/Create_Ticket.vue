<script>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3'

export default {
  name: 'CreateTicket',
  components: {
    AuthenticatedLayout,
  },
  data() {
    return {
      // Form fields
      form: {
        title: '',
        description: '',
        category: '',
        priority: '',
        department: '',
        attachment: null, // For file uploads
      },
      // List of categories for auto-suggestions
      allCategories: ['Hardware', 'Software', 'Network', 'Other'],
      filteredCategories: [],
      errors: {},
    };
  },
  methods: {
    handleCategoryInput() {
      const keyword = this.form.category.toLowerCase();
      this.filteredCategories = this.allCategories.filter((cat) =>
        cat.toLowerCase().includes(keyword)
      );
    },
    validateForm() {
      this.errors = {};

      if (!this.form.title) this.errors.title = 'Title is required.';
      if (!this.form.description) this.errors.description = 'Description is required.';
      if (!this.form.category) this.errors.category = 'Category is required.';
      if (!this.form.priority) this.errors.priority = 'Priority is required.';
      if (!this.form.department) this.errors.department = 'Department is required.';

      return Object.keys(this.errors).length === 0;
    },
    handleFileUpload(event) {
      const file = event.target.files[0];
      if (file && (file.type === 'application/pdf' || file.type.startsWith('image/'))) {
        this.form.attachment = file;
      } else {
        this.errors.attachment = 'Please upload a valid PDF or image file.';
        event.target.value = ''; // Clear the invalid file
      }
    },
    submitForm() {
      if (!this.validateForm()) {
        console.log('Form validation failed:', this.errors);
        return;
      }


      const formData = new FormData();
      Object.keys(this.form).forEach((key) => {
        formData.append(key, this.form[key]);
      });

      router.post(`/tickets`, formData);

      console.log('Form submitted successfully:', formData);

      // Reset form
      this.form = {
        title: '',
        description: '',
        category: '',
        priority: '',
        department: '',
        attachment: null,
      };
    },
  },
};
</script>

<template>
  <AuthenticatedLayout>
    <div class="min-h-screen bg-gray-100">
      <div class="container mx-auto py-10">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-3xl mx-auto">
          <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">
            Create a New Ticket
          </h1>

          <!-- Form -->
          <form @submit.prevent="submitForm">
            <!-- Title -->
            <div class="mb-4">
              <label class="block text-gray-700 font-medium mb-2" for="title">Title</label>
              <input
                type="text"
                id="title"
                v-model="form.title"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter ticket title"
              />
              <p v-if="errors.title" class="text-red-500 text-sm mt-1">{{ errors.title }}</p>
            </div>

            <!-- Description -->
            <div class="mb-4">
              <label class="block text-gray-700 font-medium mb-2" for="description">Description</label>
              <textarea
                id="description"
                v-model="form.description"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter ticket description"
                rows="4"
              ></textarea>
              <p v-if="errors.description" class="text-red-500 text-sm mt-1">{{ errors.description }}</p>
            </div>

            <!-- Category -->
            <div class="mb-4 relative">
              <label class="block text-gray-700 font-medium mb-2" for="category">Category</label>
              <input
                type="text"
                id="category"
                v-model="form.category"
                @input="handleCategoryInput"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter or select a category"
              />
              <p v-if="errors.category" class="text-red-500 text-sm mt-1">{{ errors.category }}</p>
              <!-- Auto-suggestions -->
              <ul
                v-if="filteredCategories.length"
                class="absolute bg-white border rounded-lg shadow-lg mt-1 w-full z-10"
              >
                <li
                  v-for="(category, index) in filteredCategories"
                  :key="index"
                  @click="form.category = category; filteredCategories = []"
                  class="px-4 py-2 cursor-pointer hover:bg-blue-500 hover:text-white"
                >
                  {{ category }}
                </li>
              </ul>
            </div>

            <!-- Priority -->
            <div class="mb-4">
              <label class="block text-gray-700 font-medium mb-2" for="priority">Priority</label>
              <select
                id="priority"
                v-model="form.priority"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              >
                <option value="" disabled>Select priority</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
              </select>
              <p v-if="errors.priority" class="text-red-500 text-sm mt-1">{{ errors.priority }}</p>
            </div>

            <!-- Department -->
            <div class="mb-4">
              <label class="block text-gray-700 font-medium mb-2" for="department">Department</label>
              <input
                type="text"
                id="department"
                v-model="form.department"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter department name"
              />
              <p v-if="errors.department" class="text-red-500 text-sm mt-1">{{ errors.department }}</p>
            </div>

            <!-- Attachment -->
            <div class="mb-4">
              <label class="block text-gray-700 font-medium mb-2" for="attachment">Attachment</label>
              <input
                type="file"
                id="attachment"
                @change="handleFileUpload"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
              <p v-if="errors.attachment" class="text-red-500 text-sm mt-1">{{ errors.attachment }}</p>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
              <button
                type="submit"
                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
              >
                Submit Ticket
              </button>
            </div>
          </form>

          <!-- Back to Dashboard -->
          <div class="mt-6 text-center">
            <Link href="/" class="text-blue-500 hover:underline">
              Back to Dashboard
            </Link>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>