<template>
    <TransitionRoot as="template" :show="open">
        <Dialog as="div" class="relative z-10" @close="$emit('chiudiModal')">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed z-10 inset-0 overflow-y-auto">
                <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel class="relative bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-sm sm:w-full sm:p-6">
                            <div>
                                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                                    <PlusIcon class="h-6 w-6 text-green-600" aria-hidden="true" />
                                </div>
                                <div class="mt-3 sm:mt-5">
                                    <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900 text-center"> 
                                        Nuovo utente sphere
                                    </DialogTitle>
                                    <div class="mt-2 flex flex-col gap-5">
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700">Indirizzo Email</label>
                                            <div class="mt-1">
                                                <input v-model="utente.email" type="email" name="email" id="email" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="you@example.com" />
                                            </div>
                                            <p class="mt-2 text-sm text-gray-500">Lasciare vuoto per generare un indirizzo random temporaneo</p>
                                        </div>
                                        <div>
                                            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                            <div class="mt-1">
                                                <input v-model="utente.username" type="text" name="username" id="username" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="you@example.com" />
                                            </div>                                            
                                        </div>
                                        <div>
                                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                            <div class="mt-1">
                                                <input v-model="utente.password" type="password" name="password" id="password" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="you@example.com" />
                                            </div>
                                            <p class="mt-2 text-sm text-gray-500">Default: 'password'</p>
                                        </div>
                                        <div>
                                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Conferma password</label>
                                            <div class="mt-1">
                                                <input v-model="utente.password_confirmation" type="password" name="password_confirmation" id="password_confirmation" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="you@example.com" />
                                            </div>
                                            <p class="mt-2 text-sm text-gray-500">Default: 'password'</p>
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-2">
                                            <div class="relative flex items-start">
                                                <div class="flex items-center h-5">
                                                    <input v-model="utente.admin" id="admin" name="admin" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="admin" class="font-medium text-gray-700">Admin</label>
                                                    <p class="text-gray-500"></p>
                                                </div>
                                            </div>
                                            <div class="relative flex items-start">
                                                <div class="flex items-center h-5">
                                                    <input v-model="utente.attivo" id="attivo" name="attivo" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="attivo" class="font-medium text-gray-700">Attivo</label>
                                                    <p class="text-gray-500"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label for="medico" class="block text-sm font-medium text-gray-700">Medico</label>
                                            <select v-model="utente.medico_id" id="medico" name="medico" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                                <option v-for="medico in medici" :key="medico.id" :value="medico.id"> {{ medico.nome }} </option>                                                
                                            </select>
                                            <p class="mt-2 text-sm text-gray-500">Sono elencati solo i medici non assegnati ad alcun utente sphere</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 sm:mt-6">
                                <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm" 
                                        @click="creaUtente()">
                                        Crea utente
                                    </button>
                                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm" 
                                        @click="$emit('chiudiModal')">
                                        Chiudi
                                    </button>
                                </div>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { ref } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { PlusIcon } from '@heroicons/vue/outline'

</script>

<script>
    export default {
        props: ['open' , 'medici'],
        emits: ['chiudiModal' , 'utenteCreato'],
        data()
        {
            return {
                utente: {
                    email : null,
                    password : 'password',
                    password_confirmation: 'password',
                    username : 'baluba'+Math.floor(Math.random() * 100),
                    admin : false,
                    attivo: true,
                    medico_id: null
                }
            }
        },
        methods: {
            async creaUtente()
            {
                await axios.post('/api/sphere/user/create' , this.utente)
                    .then(response => {
                        this.$emit('utenteCreato')
                    })
                    .catch(err => {

                    });
            }
        },
        unmounted()
        {
            this.utente = {
                email: null,
                password: null,
                password_confirmation: null,
                username: null,
                admin: false,
                attivo: true
            }
        }
    }
</script>