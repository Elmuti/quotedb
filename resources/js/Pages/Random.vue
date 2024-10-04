<template>
    <div class="p-8 bg-white dark:bg-gray-800">
        <DarkModeToggle />
        <div class="text-center text-gray-900 dark:text-gray-200">
            "{{ quote.quote }}" -{{ quote.author }}
        </div>
        <div class="text-center scale-95 text-gray-600 dark:text-gray-200">
            Added by Elmu Kelmu
        </div>
        <div class="flex justify-center items-end h-screen">
            2023- © Ricochet Software
        </div>
    </div>
</template>

<script setup>
import QuoteContainer from "@/Components/QuoteContainer.vue";
import QuotesHeader from "@/Components/QuotesHeader.vue";
import {ref} from "vue";
import MainHeader from "@/Components/MainHeader.vue";
import DarkModeToggle from "@/Components/DarkModeToggle.vue";
const props = defineProps({
    quote: Array
})
const quoteInputValue = ref('');
let parsedQuotesRef = ref(props.quote);

</script>
