<template>
  <div class="bg-white dark:bg-gray-800 px-6 24 sm:py-32 lg:px-8">
    <div class="mx-auto max-w-2xl text-center">
      <h2 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-gray-200 sm:text-3xl">Elmu Quote Database</h2>
      <p class="mt-6 text-lg leading-8 text-gray-600"></p>
        <div style="text-align:center">
      <span class="isolate inline-flex rounded-md shadow-sm">
        <input ref="searchBar" @input="updateInput" type="text" class="block w-full px-3 py-2 bg-white dark:bg-gray-900 text-sm text-gray-900 dark:text-gray-100 placeholder-gray-500 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Search..">
      </span>
        </div>
    </div>
  </div>
</template>
<script setup>
import {ref} from "vue";
// Define emits
const emit = defineEmits(['input-change']);
const searchBar = ref(null);
// Emit an event when the input changes
const updateInput = (event) => {
    const inputValue = event.target.value;
    // Emit an event to the parent with the input value
    emit('input-change', inputValue);
}
</script>
