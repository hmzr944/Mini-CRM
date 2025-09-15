<template>
  <div :class="darkMode ? 'dark bg-gray-900 text-white' : 'bg-gray-100 text-gray-900'" class="flex h-screen">
    <!-- Sidebar -->
    <aside
      :class="['bg-white dark:bg-gray-800 shadow-lg flex flex-col justify-between',
               sidebarOpen ? 'w-64' : 'w-20']"
      class="transition-all duration-300">
      
      <!-- Logo & Toggle -->
      <div class="p-4 flex items-center justify-between">
        <span v-if="sidebarOpen" class="text-xl font-bold">CRM</span>
        <button @click="toggleSidebar" class="p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
               stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16m-7 6h7"/>
          </svg>
        </button>
      </div>

      <!-- Navigation -->
      <nav class="flex flex-col gap-4 p-4">
        <a href="/dashboard" class="flex items-center gap-3 hover:text-blue-600 transition">
          <i class="fas fa-home"></i>
          <span v-if="sidebarOpen">Dashboard</span>
        </a>
        <a href="/clients" class="flex items-center gap-3 hover:text-blue-600 transition">
          <i class="fas fa-users"></i>
          <span v-if="sidebarOpen">Clients</span>
        </a>
        <a href="#" class="flex items-center gap-3 hover:text-blue-600 transition">
          <i class="fas fa-chart-line"></i>
          <span v-if="sidebarOpen">Rapports</span>
        </a>
        <a href="#" class="flex items-center gap-3 hover:text-blue-600 transition">
          <i class="fas fa-cog"></i>
          <span v-if="sidebarOpen">Paramètres</span>
        </a>
      </nav>

      <!-- Footer with Dark Mode -->
      <div class="p-4 border-t border-gray-200 dark:border-gray-700">
        <button @click="toggleDarkMode"
                class="flex items-center gap-3 w-full hover:text-blue-600">
          <i class="fas" :class="darkMode ? 'fa-moon' : 'fa-sun'"></i>
          <span v-if="sidebarOpen">{{ darkMode ? 'Mode sombre' : 'Mode clair' }}</span>
        </button>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-6">
      <!-- Header Slot -->
      <header class="mb-6">
        <slot name="header"></slot>
      </header>
      <!-- Page Content -->
      <slot></slot>
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const sidebarOpen = ref(true);
const darkMode = ref(false);

function toggleSidebar() {
  sidebarOpen.value = !sidebarOpen.value;
}

function toggleDarkMode() {
  darkMode.value = !darkMode.value;
}
</script>

<style>
@import "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css";

body {
  font-family: 'Inter', sans-serif;
}
</style>
