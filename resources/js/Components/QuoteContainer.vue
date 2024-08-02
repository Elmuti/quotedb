<template>
  <ul v-if="items.length > 0" role="list" class="divide-y divide-gray-200">
    <li v-for="item in items" :key="item.id" class="py-4">
      <div class="text-center">
        "{{ item.quote }}" -{{ item.author }}, {{ item.date }}
      </div>
        <div class="text-center scale-95 text-gray-600">
            Added by Elmu Kelmu
        </div>
    </li>
  </ul>
  <div v-else-if="items.length <= 0" class="text-center">
    No quotes found.
  </div>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
    items: Array
})
</script>
