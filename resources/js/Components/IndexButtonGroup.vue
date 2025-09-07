<template>
  <span class="isolate inline-flex rounded-md shadow-sm">
    <PrimaryLinkButton href="/quotes">View Database</PrimaryLinkButton>
    <PrimaryLinkButton href="/login" v-if="showLogin">Login</PrimaryLinkButton>
    <PrimaryLinkButton href="/logout" v-if="!showLogin">Logout</PrimaryLinkButton>
  </span>
</template>

<script setup>
    import { Link } from "@inertiajs/vue3";
    import PrimaryLinkButton from "@/Components/PrimaryLinkButton.vue";
    defineProps({
        showLogin: Boolean
    })
</script>


