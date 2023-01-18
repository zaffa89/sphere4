<template>
    <AdminLayout>                
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Utenti Sphere</h1>
                <p class="mt-2 text-sm text-gray-700">Gestione ruoli e permessi.</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button @click="modalNuovoUtenteOpen = true" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    Nuovo utente
                </button>
            </div>
        </div>
        <div class="-mx-4 mt-8 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Utente Sphere</th>
                        <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">Medico</th>
                        <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">Attivo</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Ruolo</th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                            
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    <tr v-for="utente in $page.props.utenti" :key="utente.id">
                        <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6">
                        {{ utente.sphere_user.username }}
                            <dl class="font-normal lg:hidden">                                            
                                <dd class="mt-1 truncate text-gray-700">{{ utente.sphere_user.medico ? utente.sphere_user.medico.ragione_sociale : '' }}</dd>                                           
                                <dd class="mt-1 truncate text-gray-500 sm:hidden">{{ utente.sphere_user.attivo }}</dd>
                            </dl>
                        </td>
                        <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">{{ utente.sphere_user.medico ? utente.sphere_user.medico.ragione_sociale : '' }}</td>
                        <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">{{ utente.sphere_user.attivo ? 'SI' : 'NO' }}</td>
                        <td class="px-3 py-4 text-sm text-gray-500">{{  utente.sphere_user.role?.name }}</td>
                        <td class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                            <button @click="apriModalModifica(utente.sphere_user.id)" class="text-indigo-600 hover:text-indigo-900">
                                Modifica
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>              
        <ModalNuovoUtente v-if="modalNuovoUtenteOpen" v-on:chiudi-modal="modalNuovoUtenteOpen = false" v-on:utente-creato="refresh" :medici="$page.props.medici_senza_utente" :ruoli="$page.props.ruoli" />
        <ModalModificaUtente v-if="modalModificaId" v-on:chiudi-modal="modalModificaId = null" v-on:utente-modificato="refresh" :id="modalModificaId" :medici="$page.props.medici_senza_utente" :ruoli="$page.props.ruoli" />
    </AdminLayout>
</template>

<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue';
    import AdminLayout from '../../Layouts/AdminLayout.vue';
    import ModalNuovoUtente from './Components/ModalNuovoUtente.vue';
    import ModalModificaUtente from './Components/ModalModificaUtente.vue';
    import { Inertia } from '@inertiajs/inertia';
</script>

<script>
export default {
    layout: AppLayout,
    data()
    {
        return {
            modalNuovoUtenteOpen : false,
            modalModificaId: null
        }
    },
    methods: {
        apriModalModifica(id)
        {
            this.modalModificaId = id
        },
        refresh() {
            this.modalNuovoUtenteOpen = false
            this.modalModificaId = null
            Inertia.reload()
        },
        utenteCreato()
        {
            this.modalNuovoUtenteOpen = false;
            Inertia.reload();
        }
    }
}
</script>