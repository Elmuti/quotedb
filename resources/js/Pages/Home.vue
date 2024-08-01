<template>
    <div class="p-8 bg-white">
        <MainHeader />
        <div style="text-align:center">
            <IndexButtonGroup :show-login="auth.user === null" />
        </div>
        <div class="absolute inset-x-0 bottom-0 text-center">
            2023- © Ricochet Software
        </div>
    </div>
</template>

<script setup>
import IndexButtonGroup from "@/Components/IndexButtonGroup.vue";
import MainHeader from "@/Components/MainHeader.vue";
defineProps({
    auth: Object
})
</script>
