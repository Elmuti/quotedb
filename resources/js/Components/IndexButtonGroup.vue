<template>
  <span class="isolate inline-flex rounded-md shadow-sm">
    <Link href="/quotes" class="relative inline-flex items-center rounded bg-white dark:bg-gray-900 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 focus:z-10">View Database</Link>
    <Link href="/login" v-if="showLogin" class="relative inline-flex items-center rounded bg-white dark:bg-gray-900 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 focus:z-10">Log in</Link>
    <Link href="/logout" v-if="!showLogin" class="relative inline-flex items-center rounded bg-white dark:bg-gray-900 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 focus:z-10">Log out</Link>
  </span>
</template>

<script setup>
    import { Link } from "@inertiajs/vue3";
    defineProps({
        showLogin: Boolean
    })
</script>


