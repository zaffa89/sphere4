<template>
    <AppLayout :hideSidebar="true">
        <template #main>
            <AdminLayout>
                <div class="sm:flex sm:items-center mb-4">
                    <div class="sm:flex-auto">
                        <h1 class="text-xl font-semibold text-gray-900">Notifiche</h1>
                        <p class="mt-2 text-sm text-gray-700">Impostazioni notifiche via email e sms</p>
                    </div>                    
                </div>
                <div class="-mx-4 mt-8 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Notifiche via Email</th>                                
                                <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">Attivo</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Margine di invio</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                   
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr class="bg-gray-50">
                                <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6">
                                    Mail notifica avvenuta prenotazione
                                </td>
                                <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell font-bold">
                                    {{ $page.props.settings.mail_avvenuta_prenotazione_flag.value ? 'ATTIVO' : 'NON ATTIVO' }}
                                </td>
                                <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                    immediato
                                </td>                               
                                <td class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                        Modifica
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6">
                                    Mail promemoria appuntamento
                                </td>
                                <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell font-bold">
                                    {{ $page.props.settings.mail_promemoria_appuntamento_flag.value ? 'ATTIVO' : 'NON ATTIVO' }}
                                </td>
                                <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                    {{ $page.props.settings.mail_promemoria_appuntamento_margine.value }} ore
                                </td>                               
                                <td class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                        Modifica
                                    </a>
                                </td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6">
                                    Mail notifica scadenza certificato
                                </td>
                                <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell font-bold">
                                    {{ $page.props.settings.mail_scadenza_certificato_flag.value ? 'ATTIVO' : 'NON ATTIVO' }}
                                </td>
                                <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                    {{ $page.props.settings.mail_scadenza_certificato_margine.value }} giorni
                                </td>                               
                                <td class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                        Modifica
                                    </a>
                                </td>
                            </tr>                                                                                    
                        </tbody>
                    </table>
                </div>
                <div class="-mx-4 mt-8 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Notifiche via SMS</th>                                
                                    <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">Attivo</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Margine di invio</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr class="bg-gray-50">
                                    <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6">
                                        SMS di notifica avvenuta prenotazione
                                    </td>
                                    <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell font-bold">
                                        {{ $page.props.settings.sms_avvenuta_prenotazione_flag.value ? 'ATTIVO' : 'NON ATTIVO' }}
                                    </td>
                                    <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                        immediato
                                    </td>                               
                                    <td class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                            Modifica
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6">
                                        SMS promemoria appuntamento
                                    </td>
                                    <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell font-bold">
                                        {{ $page.props.settings.sms_promemoria_appuntamento_flag.value ? 'ATTIVO' : 'NON ATTIVO' }}
                                    </td>
                                    <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                        {{ $page.props.settings.sms_promemoria_appuntamento_margine.value }} ore
                                    </td>                               
                                    <td class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                            Modifica
                                        </a>
                                    </td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6">
                                        SMS notifica scadenza certificato
                                    </td>
                                    <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell font-bold">
                                        {{ $page.props.settings.sms_scadenza_certificato_flag.value ? 'ATTIVO' : 'NON ATTIVO' }}
                                    </td>
                                    <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                        {{ $page.props.settings.sms_scadenza_certificato_margine.value }} giorni
                                    </td>                               
                                    <td class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                            Modifica
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                    </table>
                </div>
                
                
            </AdminLayout>   
        </template>
    </AppLayout>
</template>

<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue';
    import AdminLayout from '../../Layouts/AdminLayout.vue';
</script>

<script>
export default {
    
}
</script>