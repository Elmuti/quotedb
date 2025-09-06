<template>
  <div v-if="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-md relative">
      <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" @click="close">&times;</button>
      <h2 class="text-white font-bold text-lg text-center">Manage API Keys</h2>
      <div class="mb-4 flex gap-2">
        <input v-model="newTokenName" type="text" placeholder="API Key Name" class="flex-1 px-2 py-1 border rounded" />
        <button @click="createToken" class="relative inline-flex items-center rounded bg-white dark:bg-gray-900 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 focus:z-10">Create</button>
      </div>
      <div v-if="createdToken" class="mb-4 p-2 bg-green-100 text-green-800 rounded">
        <div class="font-semibold">API Key:</div>
        <div class="break-all select-all">{{ createdToken }}</div>
        <div class="text-xs text-red-600 mt-1">This is the only time you will see this API key. Please copy it now.</div>
      </div>
      <div>
        <div v-if="tokens.length === 0" class="text-gray-500 text-center">No API keys found.</div>
        <ul>
          <li v-for="token in tokens" :key="token.id" class="flex items-center justify-between py-2 border-b">
            <span>{{ token.name }}</span>
            <button @click="deleteToken(token.id)" class="text-red-600 hover:underline">Delete</button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue';
import axios from 'axios';

const props = defineProps({
  open: Boolean,
});
const emit = defineEmits(['close']);

const tokens = ref([]);
const newTokenName = ref('');
const createdToken = ref('');

function close() {
  emit('close');
  createdToken.value = '';
  newTokenName.value = '';
}

async function fetchTokens() {
  try {
    const response = await axios.get('/api/tokens');
    tokens.value = response.data;
  } catch (e) {
    tokens.value = [];
    alert('Failed to fetch tokens.');
  }
}

async function createToken() {
  if (!newTokenName.value) return;
  try {
    const response = await axios.post('/api/tokens/create', { token_name: newTokenName.value });
        createdToken.value = response.data.token;
    await fetchTokens();
    newTokenName.value = '';
  } catch (e) {
    alert('Failed to create token.');
  }
}

async function deleteToken(id) {
  // Placeholder: Replace with actual API call to delete token
  await axios.delete(`/api/tokens/${id}`);
  await fetchTokens();
}

watch(() => props.open, (val) => {
  if (val) fetchTokens();
});

onMounted(() => {
  if (props.open) fetchTokens();
});
</script>
