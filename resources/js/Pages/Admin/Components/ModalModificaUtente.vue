<template>
    <TransitionRoot as="template" :show="true">
        <Dialog as="div" class="relative z-10" @close="$emit('chiudiModal')">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed z-10 inset-0 overflow-y-auto">
                <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel class="relative bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-2xl sm:w-full sm:p-6">
                            <div v-if="utente">
                                <div class="grid grid-cols-3 gap-2">
                                    <div>
                                        username
                                    </div>
                                    <div>
                                        password
                                    </div>
                                    <div>
                                        conferma password
                                    </div>
                                </div>
                                <div class="overflow-hidden bg-white shadow sm:rounded-md">
                                    <ul role="list" class="divide-y divide-gray-200">
                                        <li v-for="position in positions" :key="position.id">
                                            <div class="block hover:bg-gray-50">
                                                <div class="px-4 py-4 sm:px-6">
                                                    <div class="flex items-center justify-between">
                                                    <p class="truncate text-sm font-medium text-indigo-600">{{ position.title }}</p>
                                                    <div class="ml-2 flex flex-shrink-0">
                                                        <p class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">{{ position.type }}</p>
                                                    </div>
                                                    </div>
                                                    <div class="mt-2 sm:flex sm:justify-between">
                                                    <div class="sm:flex">
                                                        <p class="flex items-center text-sm text-gray-500">
                                                        <UsersIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                                                        {{ position.department }}
                                                        </p>
                                                        <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                                                        <MapPinIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                                                        {{ position.location }}
                                                        </p>
                                                    </div>
                                                    <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                                        <CalendarIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                                                        <p>
                                                        Closing on
                                                        {{ ' ' }}
                                                        <time :datetime="position.closeDate">{{ position.closeDateFull }}</time>
                                                        </p>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
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
import { PlusIcon } from '@heroicons/vue/24/outline'
import { CalendarIcon, MapPinIcon, UsersIcon } from '@heroicons/vue/20/solid'
const positions = [
  {
    id: 1,
    title: 'Back End Developer',
    type: 'Full-time',
    location: 'Remote',
    department: 'Engineering',
    closeDate: '2020-01-07',
    closeDateFull: 'January 7, 2020',
  },
  {
    id: 2,
    title: 'Front End Developer',
    type: 'Full-time',
    location: 'Remote',
    department: 'Engineering',
    closeDate: '2020-01-07',
    closeDateFull: 'January 7, 2020',
  },
  {
    id: 3,
    title: 'User Interface Designer',
    type: 'Full-time',
    location: 'Remote',
    department: 'Design',
    closeDate: '2020-01-14',
    closeDateFull: 'January 14, 2020',
  },
]

</script>

<script>
    export default {
        props: ['open' , 'id' , 'medici' , 'ruoli'],
        emits: ['chiudiModal' , 'utenteModificato'],
        data()
        {
            return {
                utente: null
            }
        },
        methods: {
            async update()
            {
                await axios.put(`/api/sphere/user/${this.id}` , this.utente)
                    .then(response => {
                        this.$emit('utenteModificato')
                    })
                    .catch(err => {

                    });
            }
        },
        async created() {
            await axios.get(`/api/sphere/user/${this.id}`).then(response => {
                this.utente = response.data
            }).catch(err => {})
        }
    }
</script>