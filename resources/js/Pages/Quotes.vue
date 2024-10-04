<template>
    <div class="p-8 bg-white dark:bg-gray-800">
        <DarkModeToggle />
        <QuotesHeader @input-change="handleInputChange" />
        <div>
            <QuoteContainer :items="parsedQuotesRef" />
        </div>
        <div class="flex justify-center items-end h-screen text-gray-900 dark:text-gray-200">
            2023- © Ricochet Software
        </div>
    </div>
</template>

<script setup>
import QuoteContainer from "@/Components/QuoteContainer.vue";
import QuotesHeader from "@/Components/QuotesHeader.vue";
import {ref} from "vue";
import DarkModeToggle from "@/Components/DarkModeToggle.vue";
const props = defineProps({
    quotes: Array
})
const quoteInputValue = ref('');
let parsedQuotesRef = ref(props.quotes);

const handleInputChange = (inputValue) => {
    quoteInputValue.value = inputValue;
    const searchText = quoteInputValue.value;
    if (searchText) {
        //quote search
        const qs = props.quotes.filter(quote => quote.quote.toLowerCase().includes(searchText.toLowerCase()));
        //author search
        const as = props.quotes.filter(quote => quote.author.toLowerCase().includes(searchText.toLowerCase()));
        parsedQuotesRef.value = qs.concat(as);
    } else {
        parsedQuotesRef.value = props.quotes;
    }
}
</script>
