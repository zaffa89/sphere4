<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import { Switch } from '@headlessui/vue'
import { ref , watch } from 'vue'
import { SunIcon , MoonIcon } from '@heroicons/vue/24/outline'

defineProps({
    canResetPassword: Boolean,
    status: String
});

const darkMode = ref(localStorage.theme == 'dark');

watch(darkMode , (newValue) => {
    if(newValue) {
        localStorage.setItem('theme' , 'dark')
        document.documentElement.classList.add('dark')
    } 
    else {
        localStorage.setItem('theme' , 'light')
        document.documentElement.classList.remove('dark')
    }
})

const form = useForm({
    username: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Accesso" />
    <div class="absolute top-8 left-1/2 -translate-x-1/2 overflow-hidden z-10">
        <svg viewBox="0 0 558 558" width="100%" height="558" fill="none" aria-hidden="true" class="animate-spin-slower">
            <defs>
                <linearGradient id=":R3b9m:" x1="79" y1="16" x2="105" y2="237" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#13B5C8"></stop>
                    <stop offset="1" stop-color="#13B5C8" stop-opacity="0"></stop>
                </linearGradient>
            </defs>
            <path opacity=".2" d="M1 279C1 125.465 125.465 1 279 1s278 124.465 278 278-124.465 278-278 278S1 432.535 1 279Z" stroke="#13B5C8"></path>
            <path d="M1 279C1 125.465 125.465 1 279 1" stroke="url(#:R3b9m:)" stroke-linecap="round"></path>
        </svg>
    </div>
    <div class="min-h-full flex flex-col py-12 sm:px-6 lg:px-8">        
        <div class="sm:mx-auto sm:w-full sm:max-w-md z-20">
            <img class="mx-auto h-16 w-auto" src="/storage/header_logo.png" />
             <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-white">Accesso Sphere - Cloud</h2>                 
        </div>        
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md z-20">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <JetValidationErrors class="mb-4" />

                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                    {{ status }}
                </div>
                <div class="flex justify-end mb-4">
                    <SunIcon class="h-5 w-5"  />
                    <Switch v-model="darkMode" class="group mx-2 relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">                        
                        <span aria-hidden="true" class="pointer-events-none absolute h-full w-full rounded-md bg-white" />
                        <span aria-hidden="true" :class="[darkMode ? 'bg-gray-800' : 'bg-gray-200', 'pointer-events-none absolute mx-auto h-4 w-9 rounded-full transition-colors duration-200 ease-in-out']" />
                        <span aria-hidden="true" :class="[darkMode ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none absolute left-0 inline-block h-5 w-5 transform rounded-full border border-gray-200 bg-white shadow ring-0 transition-transform duration-200 ease-in-out']" />
                    </Switch>
                    <MoonIcon class="h-5 w-5" />
                </div>
                <form class="space-y-6" @submit.prevent="submit">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700"> Nome utente </label>
                        <div class="mt-1">
                            <input v-model="form.username" id="username" name="username" type="text" autocomplete="username" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        </div>                        
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700"> Password </label>
                        <div class="mt-1">
                            <input v-model="form.password" id="password" name="password" type="password" autocomplete="current-password" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input v-model="form.remember" id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
                            <label for="remember-me" class="ml-2 block text-sm text-gray-900"> Ricordami </label>
                        </div>

                        <div class="text-sm" v-if="canResetPassword">
                            <a href="#" class="font-medium text-gray-700 hover:text-indigo-500"> Password dimenticata? </a>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-cyan-500 hover:bg-cyan-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">Entra</button>
                    </div>
                </form>                
            </div>
        </div>        
    </div>
</template>
