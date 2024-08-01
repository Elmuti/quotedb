<template>
    <div class="p-8 bg-white">
        <LoginHeader />
        <form style="text-align:center" @submit.prevent="submit">
            <div class="flex justify-center">
                <div class="max-w-md">
                    <div class="flex flex-col space-y-4">
                        <div class="relative">
                            <input v-model="form.email" type="text" class="block w-full px-3 py-2 text-sm text-gray-900 placeholder-gray-500 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Email">
                            <div v-if="form.errors.email"  class="text-red-600">
                                {{form.errors.email}}
                            </div>
                        </div>
                        <div class="relative">
                            <input v-model="form.password" type="password" class="block w-full px-3 py-2 text-sm text-gray-900 placeholder-gray-500 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Password">
                            <div v-if="form.errors.password"  class="text-red-600">
                                {{form.errors.password}}
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="relative inline-flex items-center bg-white px-3 py-2 mt-4 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">Log in</button>
                </div>
            </div>
        </form>
        <div class="absolute inset-x-0 bottom-0 text-center">
            2023- © Ricochet Software
        </div>
    </div>
</template>

<script setup>
import LoginHeader from "@/Components/LoginHeader.vue";
import {useForm} from "@inertiajs/vue3";

const form = useForm({
    email:"",
    password:""
});

function submit() {
    form.post("/login");
}


</script>
