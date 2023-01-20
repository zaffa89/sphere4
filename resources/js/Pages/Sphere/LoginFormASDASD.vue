<script setup>
import { XCircleIcon, LockClosedIcon , ExclamationCircleIcon } from '@heroicons/vue/20/solid';
import { router } from '@inertiajs/vue3';
</script>

<template>
  <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gray-200">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <img
        class="mx-auto h-12 w-auto"
        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
        alt="Your Company"
      />
      <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Autenticazione</h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <div class="space-y-6">
          <div>
            <label class="block text-sm font-medium text-gray-700">Nome utente</label>
            <div class="relative mt-1 rounded-md shadow-sm">
              <input
                id="username"
                name="username"
                v-model="form.username"
                type="text"
                placeholder="Nome utente"
                :class="[
                  errorFor('username')
                    ? 'border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 pr-10'
                    : 'border-gray-300 text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500'
                ]"
                class="block w-full rounded-md focus:outline-none sm:text-sm"
              />
              <div
                v-if="errorFor('username')"
                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
              >
                <ExclamationCircleIcon
                  class="h-5 w-5 text-red-500"
                  aria-hidden="true"
                />
              </div>
            </div>
            <p
              v-if="errorFor('username')"
              class="mt-2 text-sm text-red-600"
              v-html="errorFor('username')"
            >
            </p>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <div class="relative mt-1 rounded-md shadow-sm">
              <input
                v-model="form.password"
                type="password"
                placeholder="Password"
                :class="[
                  errorFor('password')
                    ? 'border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 pr-10'
                    : 'border-gray-300 text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500'
                ]"
                class="block w-full rounded-md focus:outline-none sm:text-sm"
              />
              <div
                v-if="errorFor('password')"
                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
              >
                <ExclamationCircleIcon
                  class="h-5 w-5 text-red-500"
                  aria-hidden="true"
                />
              </div>
            </div>
            <p
              v-if="errorFor('password')"
              class="mt-2 text-sm text-red-600"
              v-html="errorFor('password')"
            >
            </p>
          </div>

          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input
                id="remember-me"
                name="remember-me"
                type="checkbox"
                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
              />
              <label
                for="remember-me"
                class="ml-2 block text-sm text-gray-900"
              >Remember me</label>
            </div>

            <div class="text-sm">
              <a
                href="#"
                class="font-medium text-indigo-600 hover:text-indigo-500"
              >Forgot your
                password?</a>
            </div>
          </div>
          <div
            v-if="$page.props.errors.message"
            class="rounded-md bg-red-50 p-4"
          >
            <div class="flex">
              <div class="flex-shrink-0">
                <XCircleIcon
                  class="h-5 w-5 text-red-400"
                  aria-hidden="true"
                />
              </div>
              <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Errore durante l'autenticazione</h3>
                <div class="mt-2 text-sm text-red-700">
                  <ul
                    role="list"
                    class="list-disc space-y-1 pl-5"
                  >
                    <li>{{ $page.props.errors.message }}</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <button
            type="submit"
            :disabled="processing"
            class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            @click="submit"
          >
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
              <svg
                v-if="processing"
                class="-ml-1 mr-2 animate-spin h-6 w-6 inline"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
              >
                <circle
                  class="opacity-25"
                  cx="12"
                  cy="12"
                  r="10"
                  stroke="currentColor"
                  stroke-width="4"
                ></circle>
                <path
                  class="opacity-75"
                  fill="currentColor"
                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                >
                </path>
              </svg>
              <LockClosedIcon
                v-else
                class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                aria-hidden="true"
              />
            </span>
            Entra
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
    data() {
        return {
            form: {
                username: localStorage.getItem('last_username') ? localStorage.getItem('last_username') : '',
                password: 'password',
            },
            errors: null,
            processing: false,
            message: null,
        };
    },
    created() {
       
    }, 
    methods: {
        submit() {
            this.processing = true;
            localStorage.setItem('last_username' , this.form.username)
            router.post('/sphere/login' , this.form , { headers: { 'Authorization' : this.$page.props.token }});
            this.processing = false;
        },
        errorFor(field){        //metodo che assegna il messaggio di errore al campo 'field'.
            return null !== this.$page.props.errors && this.$page.props.errors[field]
                ? this.$page.props.errors[field] 
                : null;
        }
    },
};
</script>