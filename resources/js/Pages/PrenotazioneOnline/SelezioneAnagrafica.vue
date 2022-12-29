<template>
    <div>
        <div class="rounded-lg bg-white overflow-hidden shadow">
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Per chi vuoi prenotare?</h3>
                <p class="mt-1 text-sm text-gray-500">Seleziona una delle tue anagrafiche oppure aggiungine una nuova se necessario.</p>
            </div>
            <div class="px-4 py-5 sm:px-6">
                <RadioGroup v-model="anagraficaSelezionata">
                    <RadioGroupLabel class="text-base font-medium text-gray-900"> Seleziona la persona che effettuerà la visita</RadioGroupLabel>

                    <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-4">
                        <RadioGroupOption as="template" v-for="anagrafica in anagrafiche" :key="anagrafica.id" :value="anagrafica.id" v-slot="{ checked, active }">
                            <div :class="[checked ? 'border-transparent' : 'border-gray-300', active ? 'border-indigo-500 ring-2 ring-indigo-500' : '', 'relative bg-white border rounded-lg shadow-sm p-4 flex cursor-pointer focus:outline-none']">
                                <span class="flex-1 flex">
                                    <span class="flex flex-col">
                                        <RadioGroupLabel as="span" class="block text-sm font-medium text-gray-900">
                                            {{ anagrafica.nome }} {{ anagrafica.cognome }}
                                        </RadioGroupLabel>
                                        <RadioGroupDescription as="span" class="mt-1 flex items-center text-sm text-gray-500">
                                            {{ anagrafica.dataNascita }}
                                        </RadioGroupDescription>
                                        <RadioGroupDescription as="span" class="mt-6 text-sm font-medium text-gray-900">
                                            <span v-if="anagrafica.ultimoCertificato">Scadenza ultimo certificato: {{ anagrafica.ultimoCertificato }}</span>
                                        </RadioGroupDescription>
                                    </span>
                                </span>
                                <CheckCircleIcon :class="[!checked ? 'invisible' : '', 'h-5 w-5 text-indigo-600']" aria-hidden="true" />
                                <span :class="[active ? 'border' : 'border-2', checked ? 'border-indigo-500' : 'border-transparent', 'absolute -inset-px rounded-lg pointer-events-none']" aria-hidden="true" />
                            </div>
                        </RadioGroupOption>
                        <button type="button" @click="anagraficaSelezionata = 0" :class="[anagraficaSelezionata === 0 ? 'border-indigo-500 ring-2 ring-indigo-500' : 'border-gray-300' , 'relative block w-full border shadow-sm rounded-lg p-8 text-center focus:outline-none']">                                    
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            <span class="mt-2 block text-sm font-medium text-gray-900"> Crea nuova anagrafica </span>
                        </button>
                    </div>
                </RadioGroup>
            </div>
            
            <div class="px-4 py-5 sm:px-6">
                <div v-if="anagraficaSelezionata && anagraficaSelezionata !== 0">
                    <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Continua
                    </button>
                </div>
                <div v-else>
                    Form
                </div>
                
            </div>
        </div>
        
        <div class="rounded-lg bg-white overflow-hidden shadow">
            
        </div>                        
    </div>
</template>

<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue';
    import { ref } from 'vue'
    import { RadioGroup, RadioGroupDescription, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue'
    import { CheckCircleIcon } from '@heroicons/vue/20/solid'
    
    import { BookmarkIcon , PlusSmallIcon} from '@heroicons/vue/24/outline'

    import { usePrenotazioneUtenteStore } from '@/stores/PrenotazioneUtenteStore';

    const prenotazione = usePrenotazioneUtenteStore();

    const opzioniSesso = [
        {
            value: 'M',
            text: 'Maschio'
        },
        {
            value: 'F',
            text: 'Femmina'
        }
    ]

    const anagrafiche = [
        {
            id: 1,
            nome: 'Mario',
            cognome: 'Rossi',
            dataNascita: '17/03/1989',
            ultimoCertificato: '10/08/2021'
            
        },
        {
            id: 2,
            nome: 'Luigi',
            cognome: 'Verdi',
            dataNascita: '17/06/1991',
            ultimoCertificato: null
        }
    ]
</script>

<script>
export default {
    layout: AppLayout,
    data() {
        return {
            anagraficaSelezionata : null
        }
    },
    computed: {
        
    },
    methods: {
        continua()
        {

        }
    }
}
</script>