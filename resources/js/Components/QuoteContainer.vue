<template>
  <ul v-if="items.length > 0" role="list" class="divide-y divide-gray-200">
    <li v-for="item in items" :key="item.id" class="py-4">
      <div class="text-center">
        "{{ item.quote }}" -{{ item.author }}, {{ item.date }}
      </div>
    </li>
  </ul>
  <div v-else-if="items.length <= 0" class="text-center">
    There are no quotes yet in the database.
  </div>
</template>

<script setup>
defineProps({
    items: Array
})
</script>
