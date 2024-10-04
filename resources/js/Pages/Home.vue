<template>
    <div class="p-8 bg-white dark:bg-gray-800">
        <DarkModeToggle />
        <MainHeader />
        <div class = "bg-white dark:bg-gray-800" style="text-align:center">
            <IndexButtonGroup :show-login="auth.user === null" />
        </div>
        <div class="absolute inset-x-0 bottom-0 text-center bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200">
            2023- © Ricochet Software
        </div>
    </div>
</template>

<script setup>
import IndexButtonGroup from "@/Components/IndexButtonGroup.vue";
import MainHeader from "@/Components/MainHeader.vue";
import DarkModeToggle from "@/Components/DarkModeToggle.vue";
import {onMounted} from "vue";

defineProps({
    auth: Object
})

onMounted(() => {
    document.body.classList.add('bg-white');
    document.body.classList.add('dark:bg-gray-800');
});
</script>
