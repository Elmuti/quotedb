<template>
    <div class="p-8 bg-white dark:bg-gray-800">
        <DarkModeToggle />
        <QuotesHeader @input-change="handleInputChange" />
        <div>
            <QuoteContainer :items="filteredQuotes" />
        </div>
        <div class="flex justify-center items-end h-screen text-gray-900 dark:text-gray-200">
            2023- © Ricochet Software
        </div>
    </div>
</template>

<script setup>
import QuoteContainer from "@/Components/QuoteContainer.vue";
import QuotesHeader from "@/Components/QuotesHeader.vue";
import { ref, computed } from "vue";
import DarkModeToggle from "@/Components/DarkModeToggle.vue";

const props = defineProps({
    quotes: Array
})
console.log("props: ", JSON.parse(JSON.stringify(props)));
const quoteInputValue = ref('');

const filteredQuotes = computed(() => {
    const searchText = quoteInputValue.value.toLowerCase();

    if (!searchText) {
        return props.quotes;
    }

    // Filter quotes that match either quote text or author
    const quoteMatches = props.quotes.filter(quote =>
        quote.quote.toLowerCase().includes(searchText)
    );

    const authorMatches = props.quotes.filter(quote =>
        quote.author.toLowerCase().includes(searchText)
    );

    // Combine results and remove duplicates
    const combined = [...quoteMatches, ...authorMatches];
    return combined.filter((quote, index, self) =>
        index === self.findIndex(q => q.id === quote.id ||
            (q.quote === quote.quote && q.author === quote.author))
    );
});

const handleInputChange = (inputValue) => {
    quoteInputValue.value = inputValue;
}
</script>
