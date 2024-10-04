<template>
  <ul v-if="items.length > 0" role="list" class="divide-y divide-gray-200 dark:divide-gray-600">
    <li v-for="item in items" :key="item.id" class="py-4">
      <div class="text-center text-gray-900 dark:text-gray-200">
        "{{ item.quote }}" -{{ item.author }}, {{ item.date }}
      </div>
        <div class="text-center scale-95 text-gray-600 dark:text-gray-500">
            Added by Elmu Kelmu
        </div>
    </li>
  </ul>
  <div v-else-if="items.length <= 0" class="text-center text-gray-600 dark:text-gray-500">
    No quotes found.
  </div>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
    items: Array
})
</script>
