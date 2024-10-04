<template>
    <div class="p-8 bg-white dark:bg-gray-800">
        <DarkModeToggle />
        <LoginHeader />
        <form class="bg-white dark:bg-gray-800" style="text-align:center" @submit.prevent="submit">
            <div class="flex justify-center bg-white dark:bg-gray-800">
                <div class="max-w-md bg-white dark:bg-gray-800">
                    <div class="flex flex-col space-y-4 bg-white dark:bg-gray-800">
                        <div class="relative">
                            <input v-model="form.email" type="text" class="block w-full px-3 py-2 text-sm bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-500 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Email">
                            <div v-if="form.errors.email"  class="text-red-600">
                                {{form.errors.email}}
                            </div>
                        </div>
                        <div class="relative">
                            <input v-model="form.password" type="password" class="block w-full px-3 py-2 text-sm bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-500 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Password">
                            <div v-if="form.errors.password"  class="text-red-600">
                                {{form.errors.password}}
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="relative inline-flex items-center px-3 py-2 mt-4 text-sm font-semibold bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">Log in</button>
                </div>
            </div>
        </form>
        <div class="absolute inset-x-0 bottom-0 text-center bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
            2023- © Ricochet Software
        </div>
    </div>
</template>

<script setup>
import LoginHeader from "@/Components/LoginHeader.vue";
import {useForm} from "@inertiajs/vue3";
import DarkModeToggle from "@/Components/DarkModeToggle.vue";
import {onMounted} from "vue";

const form = useForm({
    email:"",
    password:""
});

function submit() {
    form.post("/login");
}
onMounted(() => {
    document.body.classList.add('bg-white');
    document.body.classList.add('dark:bg-gray-800');
});
</script>
