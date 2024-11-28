<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-50 to-gray-100 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-md space-y-6">
      <!-- Logo/Icon Section -->
      <div class="text-center">
        <div class="bg-blue-500 w-16 h-16 rounded-full mx-auto flex items-center justify-center">
          <svg 
            class="w-8 h-8 text-white" 
            fill="none" 
            stroke="currentColor" 
            viewBox="0 0 24 24"
          >
            <path 
              stroke-linecap="round" 
              stroke-linejoin="round" 
              stroke-width="2" 
              d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"
            />
          </svg>
        </div>
        <h1 class="mt-4 text-3xl font-bold text-gray-900">Help Desk Portal</h1>
        <p class="mt-2 text-gray-600">Sign in or create a new account</p>
      </div>

      <!-- Buttons Section -->
      <div class="space-y-4">
        <button
          @click="login"
          class="w-full flex items-center justify-center px-8 py-3 text-base font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md transition duration-150 ease-in-out transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        >
          <svg 
            class="w-5 h-5 mr-2" 
            fill="none" 
            stroke="currentColor" 
            viewBox="0 0 24 24"
          >
            <path 
              stroke-linecap="round" 
              stroke-linejoin="round" 
              stroke-width="2" 
              d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
            />
          </svg>
          Login to Your Account
        </button>
        
        <button
          @click="register"
          class="w-full flex items-center justify-center px-8 py-3 text-base font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-md border border-blue-200 transition duration-150 ease-in-out transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        >
          <svg 
            class="w-5 h-5 mr-2" 
            fill="none" 
            stroke="currentColor" 
            viewBox="0 0 24 24"
          >
            <path 
              stroke-linecap="round" 
              stroke-linejoin="round" 
              stroke-width="2" 
              d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"
            />
          </svg>
          Create New Account
        </button>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  name: 'AuthPage',
  data() {
    return {
      isLoading: false
    }
  },
  methods: {
    async login() {
      try {
        this.isLoading = true
        // Add loading state handling if needed
        window.location.href = '/login'
      } catch (error) {
        console.error('Login navigation error:', error)
      } finally {
        this.isLoading = false
      }
    },
    async register() {
      try {
        this.isLoading = true
        // Add loading state handling if needed
        window.location.href = '/register'
      } catch (error) {
        console.error('Register navigation error:', error)
      } finally {
        this.isLoading = false
      }
    }
  }
}
</script>