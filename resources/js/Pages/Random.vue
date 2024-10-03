<template>
    <div class="p-8 bg-white">
        <div class="text-center">
            "{{ quote.quote }}" -{{ quote.author }}
        </div>
        <div class="text-center scale-95 text-gray-600">
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
const props = defineProps({
    quote: Array
})
const quoteInputValue = ref('');
let parsedQuotesRef = ref(props.quote);

</script>
