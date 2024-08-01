<template>
    <div class="p-8 bg-white">
        <QuotesHeader />
        <div>
            <QuoteContainer :items="quotes" />
        </div>
        <div class="flex justify-center items-end h-screen">
            2023- © Ricochet Software
        </div>
    </div>
</template>

<script setup>
import QuoteContainer from "@/Components/QuoteContainer.vue";
import QuotesHeader from "@/Components/QuotesHeader.vue";
defineProps({
    quotes: Array
})

</script>
