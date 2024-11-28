<template>
  <AuthenticatedLayout>
    <div class="container mx-auto px-6 py-8">
      <div class="max-w-md mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <div class="flex items-center mb-6">
          <BsGearFill class="mr-3 text-blue-600 text-2xl" />
          <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">App Settings</h2>
        </div>

        <div class="space-y-6">
          <!-- App Name Input -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Application Name
            </label>
            <input
              v-model="appName"
              type="text"
              class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                     dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
              placeholder="Enter application name"
            />
          </div>

          <!-- Notifications Toggle -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Notifications
            </label>
            <div 
              @click="toggleNotifications"
              class="flex items-center justify-between p-4 rounded-lg border cursor-pointer
                     border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700"
            >
              <div class="flex items-center gap-3">
                <BsBellFill 
                  class="h-5 w-5"
                  :class="notifications ? 'text-blue-600' : 'text-gray-400'"
                />
                <span :class="notifications ? 'text-gray-900 dark:text-gray-100' : 'text-gray-500'">
                  {{ notifications ? 'Notifications Enabled' : 'Notifications Disabled' }}
                </span>
              </div>
              <div 
                class="w-11 h-6 rounded-full p-1 transition-colors duration-200"
                :class="notifications ? 'bg-blue-600' : 'bg-gray-200 dark:bg-gray-700'"
              >
                <div 
                  class="w-4 h-4 rounded-full bg-white transform transition-transform duration-200"
                  :class="notifications ? 'translate-x-5' : 'translate-x-0'"
                />
              </div>
            </div>
          </div>

          <!-- Theme Buttons -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Theme
            </label>
            <div class="grid grid-cols-2 gap-4">
              <button
                @click="setTheme('white')"
                :class="[
                  'p-4 rounded-lg border flex items-center gap-3 transition-all',
                  themeColor === 'white' 
                    ? 'border-blue-600 bg-blue-50 dark:bg-blue-900/20 text-blue-600' 
                    : 'border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700'
                ]"
              >
                <BsSunFill 
                  class="h-5 w-5"
                  :class="themeColor === 'white' ? 'text-blue-600' : 'text-gray-400'"
                />
                <span class="font-medium">Light</span>
              </button>
              <button
                @click="setTheme('black')"
                :class="[
                  'p-4 rounded-lg border flex items-center gap-3 transition-all',
                  themeColor === 'black' 
                    ? 'border-blue-600 bg-blue-50 dark:bg-blue-900/20 text-blue-600' 
                    : 'border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700'
                ]"
              >
                <BsMoonFill 
                  class="h-5 w-5"
                  :class="themeColor === 'black' ? 'text-blue-600' : 'text-gray-400'"
                />
                <span class="font-medium">Dark</span>
              </button>
            </div>
          </div>

          <!-- Save Button -->
          <button
            @click="saveSettings"
            class="w-full flex items-center justify-center gap-2 px-4 py-3 
                   bg-blue-600 hover:bg-blue-700 text-white rounded-md
                   transition-colors duration-200"
          >
            <BsSaveFill class="h-4 w-4" />
            Save Changes
          </button>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { 
  BsGearFill, 
  BsBellFill, 
  BsSunFill,
  BsMoonFill,
  BsSaveFill 
} from 'vue-icons-plus/bs';
import { useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';

export default {
  components: {
    AuthenticatedLayout,
    BsGearFill,
    BsBellFill,
    BsSunFill,
    BsMoonFill,
    BsSaveFill
  },

  props: {
    userName: String,
    tickets: Array,
    flash: {
      type: Object,
      default: () => ({})
    }
  },

  data() {
    return {
      appName: this.$page.props.appName || 'Help Desk System',
      notifications: true,
      themeColor: 'white'
    }
  },

  watch: {
    'flash.success': function(newMessage) {
      this.showToast(newMessage);
    }
  },

  mounted() {
    console.log("----------<", this.flash.success);
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

    toggleNotifications() {
      this.notifications = !this.notifications;
    },

    setTheme(theme) {
      this.themeColor = theme;
    },

    saveSettings() {
      this.$inertia.post('/update-app-settings', {
        name: this.appName,
        notifications: this.notifications,
        themeColor: this.themeColor
      });
    }
  },
}
</script>