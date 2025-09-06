<script setup>
import { Link } from "@inertiajs/vue3";
// Disable automatic attribute inheritance
defineOptions({
    inheritAttrs: false
})
</script>

<template>
    <Link v-bind="$attrs" class="relative inline-flex items-center rounded bg-white dark:bg-gray-900 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 focus:z-10">
        <slot/>
    </Link>
</template>

<style scoped>

</style>
