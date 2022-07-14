<template>
    <AppLayout :hideSidebar="true" :switchColumns="true">
        
        <template #side>
            <div class="rounded-lg bg-white overflow-hidden shadow">
                <!-- UTENTE REGISTRATO -->
                                
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Per chi vuoi prenotare?</h3>
                    <p class="mt-1 text-sm text-gray-500">Seleziona una o più anagrafiche utilizzate in precedenza, aggiungine una nuova se necessario.</p>
                </div>
                <div class="p-6 space-y-6" v-if="!$page.props.user">        
                    <!-- ANAGRAFICHE UTENTE -->
                    <div class="mt-5">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Anagrafiche utilizzate in precedenza</h3>
                        <p class="text-sm">seleziona una o più anagrafiche</p>
                        <ul role="list" class="mt-4 border-t border-b border-gray-200 divide-y divide-gray-200">
                            <li v-for="(anagrafica, index) in anagrafiche" :key="index" class="py-4 flex items-center justify-between space-x-3">
                                <div class="min-w-0 flex-1 flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 text-lg">{{ anagrafica.nome.substring(0,1) }}</div>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ anagrafica.nome }} {{ anagrafica.cognome }}</p>
                                        <p class="text-sm font-medium text-gray-500 truncate">{{ anagrafica.dataNascita }}</p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <button @click="selezionaAnagrafica( index )" type="button" class="inline-flex items-center py-2 px-3 border border-transparent rounded-full bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <PlusSmIcon class="-ml-1 mr-0.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                                        <span class="text-sm font-medium text-gray-900">
                                            Seleziona
                                        </span>
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- UTENTE OSPITE -->
                <div class="p-6 space-y-6" v-if="!$page.props.user">                    
                    
                </div>                
            </div>            
        </template>
        <template #main>
                <div class="rounded-lg bg-white overflow-hidden shadow">
                    <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Per chi vuoi prenotare?</h3>
                        <p class="mt-1 text-sm text-gray-500">Seleziona una o più anagrafiche utilizzate in precedenza, aggiungine una nuova se necessario.</p>
                    </div>
                    <div class="px-4 py-5 sm:px-6">
                        <RadioGroup v-model="anagraficaSelezionata">
                            <RadioGroupLabel class="text-base font-medium text-gray-900"> Seleziona anagrafica o crea nuova </RadioGroupLabel>

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
                                <button type="button" @click="anagraficaSelezionata = 0" :class="[anagraficaSelezionata === 0 ? 'border-indigo-500 ring-2 ring-indigo-500' : 'border-gray-300' , 'relative block w-full border shadow-sm rounded-lg p-12 text-center focus:outline-none']">                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
                                Continua come 
                            </button>
                        </div>
                        <div v-else>
                            Form
                        </div>
                        
                    </div>
                </div>
                
                <div class="rounded-lg bg-white overflow-hidden shadow">
                    
                </div>                        
            </template>
    </AppLayout>
</template>

<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue';
    
    import { RadioGroup, RadioGroupDescription, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue'
    import { CheckCircleIcon } from '@heroicons/vue/solid'
    
    import { BookmarkIcon , PlusSmIcon} from '@heroicons/vue/outline'

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