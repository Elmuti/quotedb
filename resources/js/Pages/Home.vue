<template>
    <div class="p-8 bg-white dark:bg-gray-800">
        <DarkModeToggle />
        <MainHeader />
        <div class = "bg-white dark:bg-gray-800" style="text-align:center">
            <IndexButtonGroup :show-login="auth.user === null" />
            <template v-if="canView">
                <button class="relative inline-flex items-center rounded bg-white dark:bg-gray-900 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 focus:z-10" @click="showTokenWindow = true">Manage API Keys</button>
            </template>
        </div>
        <TokenManagementWindow :open="showTokenWindow" @close="showTokenWindow = false" />
        <div class="absolute inset-x-0 bottom-0 text-center bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200">
            2023- © Ricochet Software
        </div>
    </div>
</template>

<script setup>
import IndexButtonGroup from "@/Components/IndexButtonGroup.vue";
import MainHeader from "@/Components/MainHeader.vue";
import DarkModeToggle from "@/Components/DarkModeToggle.vue";
import TokenManagementWindow from "@/Components/TokenManagementWindow.vue";
import { ref, onMounted } from "vue";

const props = defineProps({
    auth: Object,
    canView: Boolean
})
console.log("props: ", JSON.parse(JSON.stringify(props)));
const showTokenWindow = ref(false);

onMounted(() => {
    document.body.classList.add('bg-white');
    document.body.classList.add('dark:bg-gray-800');
});

function onManageApiKeys() {
    // Placeholder for API key management logic
    alert('API Key management coming soon!');
}
</script>
