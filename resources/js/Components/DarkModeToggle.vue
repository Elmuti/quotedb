<template>
    <div class="relative">
        <button @click="toggleDark()"
                class="absolute top-4 right-4 inline-flex items-center rounded bg-white dark:bg-gray-900 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 focus:z-10">
            {{ isDark ? "Toggle light" : "Toggle dark" }}
        </button>
    </div>
</template>

<script setup>
import { useDark, useToggle } from "@vueuse/core";
const isDark = useDark();
const toggleDark = useToggle(isDark);

defineProps({
    auth: Object
})
</script>
