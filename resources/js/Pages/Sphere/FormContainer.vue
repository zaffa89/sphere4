<template>
    <div class="h-full">
        <ElectronLayout v-if="electronClient">
            <template #navigazione>
                <nav class="-mb-px sm:flex hidden space-x-8" aria-label="Tabs" v-if="electronClient">
                    <button @click="activateForm(tab)" v-for="(tab, tabIdx) in activeTabs" :key="tab" :class="[tab.component == currentTab.component ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm']" :aria-current="tab.current ? 'page' : undefined">
                        <component :is="tab.icon" :class="[tab.component == currentTab.component ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500', '-ml-0.5 mr-2 h-5 w-5']" aria-hidden="true" />
                        <span>{{ tab.name }}</span>
                    </button>
                </nav>
                <!--
                <nav class="-mb-px sm:flex space-x-8 hidden" aria-label="Tabs" v-else>
                    <button @click="activateForm(tab)" v-for="(tab, tabIdx) in browserTabs" :key="tab" :class="[tab.component == currentTab?.component ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm']" :aria-current="tab.current ? 'page' : undefined">
                        <component :is="tab.icon" :class="[tab.component == currentTab?.component ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500', '-ml-0.5 mr-2 h-5 w-5']" aria-hidden="true" />
                        <span>{{ tab.name }}</span>
                    </button>
                </nav>
                -->
            </template>
            <template #bottoneChiusuraForm>
                <button class="mr-4 border hover:bg-gray-200 bg-gray-100" v-if="currentTab">
                <XMarkIcon
                    class="text-black h-7 w-7"
                    @click="destroyForm(currentTab.component)"
                />
                </button>
            </template>
            <component
                :is="tab.component"
                v-for="tab in activeTabs"
                v-show="tab.component === currentTab.component"
                :key="'active-component-' + tab.component"
                @notify="addNotification"
            >            
            </component>
            <FormHome v-if="activeTabs.length === 0" />
            <!-- notifiche -->
            <div
                aria-live="assertive"
                class="z-50 pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-end sm:p-6"
            >
                <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
                <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->
                <transition
                    v-for="notification in notifications"
                    :key="notification"
                    enter-active-class="transform ease-out duration-300 transition"
                    enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                    enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                    leave-active-class="transition ease-in duration-100"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <GeneralNotification
                    :data="notification"
                    :timeout="3"
                    @dismiss="dismissNotification"
                    />
                </transition>
                </div>
            </div>
        </ElectronLayout>
        <BrowserLayout v-if="!electronClient">
            <template #navigazione>
                <nav class="flex-1 space-y-1 bg-white px-2" aria-label="Sidebar">
                    <template v-for="item in navigation" :key="item.name">
                        <div v-if="!item.children">
                            <button @click="activateForm(item)"
                                :class="[item.name === currentTab?.name ? 'bg-gray-200 text-gray-900' : 'bg-white text-gray-600 hover:bg-gray-50 hover:text-gray-900', 'group flex w-full items-center rounded-md py-2 pl-2 text-sm font-medium']">
                                <component :is="item.icon"
                                    :class="[item.current ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500', 'mr-3 h-6 w-6 flex-shrink-0']"
                                    aria-hidden="true" />
                                {{ item.name }}
                        </button>
                        </div>
                        <Disclosure as="div" v-else class="space-y-1" v-slot="{ open }">
                            <DisclosureButton
                                :class="[item.current ? 'bg-gray-100 text-gray-900' : 'bg-white text-gray-600 hover:bg-gray-50 hover:text-gray-900', 'group flex w-full items-center rounded-md py-2 pl-2 pr-1 text-left text-sm font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500']">
                                <component :is="item.icon"
                                    class="mr-3 h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                    aria-hidden="true" />
                                <span class="flex-1">{{ item.name }}</span>
                                <svg :class="[open ? 'rotate-90 text-gray-400' : 'text-gray-300', 'ml-3 h-5 w-5 flex-shrink-0 transform transition-colors duration-150 ease-in-out group-hover:text-gray-400']"
                                    viewBox="0 0 20 20" aria-hidden="true">
                                    <path d="M6 6L14 10L6 14V6Z" fill="currentColor" />
                                </svg>
                            </DisclosureButton>
                            <DisclosurePanel class="space-y-1">
                                <button v-for="subItem in item.children" :key="subItem.name" as="button"
                                    @click="activateForm(subItem)"
                                    :class="[subItem.name === currentTab?.name ? 'bg-gray-200 text-gray-900' : 'bg-white text-gray-600 hover:bg-gray-50 hover:text-gray-900' , 'group flex w-full items-center rounded-md py-2 pl-11 pr-2 text-sm font-medium']">
                                    {{ subItem.name }}
                                </button>
                            </DisclosurePanel>
                        </Disclosure>
                    </template>
                </nav>
            </template>
            <component
                :is="tab.component"
                v-for="tab in activeTabs"
                v-show="tab.name == currentTab.name"
                :key="'active-component-' + tab.name"
                @notify="addNotification"
            >            
            </component>
        </BrowserLayout>
    </div>
</template>

<script setup>
    import ElectronLayout from '../../Layouts/ElectronLayout.vue';
    import BrowserLayout from '../../Layouts/BrowserLayout.vue';

    import GeneralNotification from './Components/GeneralNotification.vue';
    
    import FormPazienti from '@forms/FormPazienti.vue';
    import FormAmbulatori from '@forms/FormAmbulatori.vue';
    import FormCalendario from '@forms/FormCalendario.vue';
    import FormMedici from '@forms/FormMedici.vue';
    import FormSocieta from '@forms/FormSocieta.vue';
    import FormAccettazioneMedsport from '@forms/FormAccettazioneMedsport.vue'
    import FormImpostazioniSport from '@forms/FormImpostazioniSport.vue'
    import FormGestionePrestazioni from '@forms/FormGestionePrestazioni.vue';
    import FormGestioneNumeratori from '@forms/FormGestioneNumeratori.vue';

    import FormBryntumCalendar from './Forms/FormBryntumCalendar.vue';
    
    import FormHome from '@forms/FormHome.vue';

    import {
        Bars3BottomLeftIcon,
        BellIcon,
        CalendarIcon,
        ChartBarIcon,
        FolderIcon,
        HomeIcon,
        InboxIcon,
        UsersIcon,
        XMarkIcon,
        Cog6ToothIcon
    } from '@heroicons/vue/24/outline'
    import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid'
    
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'

const navigation = [
    { name: 'Homepage', icon: HomeIcon, component: FormHome },
    {
        name: 'Agenda',
        icon: CalendarIcon,
      
        children: [
            { name: 'Calendario', component: FormBryntumCalendar },
            { name: 'Ricerca prenotazioni', component: null },
            { name: 'Altro', component: null }           
        ],
    },
    {
        name: 'Accettazione',
        icon: FolderIcon,
       
        children: [
            { name: 'Medsport', component: FormAccettazioneMedsport },
            { name: 'Ambulatoriale', component: null }            
        ],
    },    
    {
        name: 'Anagrafiche',
        icon: UsersIcon,
       
        children: [
            { name: 'Pazienti', component: FormPazienti },
            { name: 'Medici', component: FormMedici },
            { name: 'Ambulatori', component: FormAmbulatori },
            { name: 'Società sportive', component: FormSocieta },
            { name: 'Aziende', component: null },                        
        ],
    },
    {
        name: 'Contabilità',
        icon: InboxIcon,
        
        children: [
            { name: 'Chiusura cassa', component: null },
            { name: 'Precompilato 730', component: null },
            { name: 'Tracciati', component: null },            
        ],
    },
    {
        name: 'Reports',
        icon: ChartBarIcon,
       
        children: [
            { name: 'Overview', component: null },
            { name: 'Members', component: null },
            { name: 'Calendar', component: null },
            { name: 'Settings', component: null },
        ],
    },
    {
        name: 'Utility',
        icon: Cog6ToothIcon,
        children: [
            { name: 'Gestione prestazioni' , component: FormGestionePrestazioni },
            { name: 'Gestione numeratori' , component: FormGestioneNumeratori },
        ]
    }
]
</script>

<script>
    export default {
        emits: ['notify'],
        components: {
            FormPazienti,
            FormCalendario,
            FormAmbulatori,
            FormMedici,
            FormSocieta,
            FormAccettazioneMedsport,
            FormImpostazioniSport,
            FormGestionePrestazioni,
            FormGestioneNumeratori,
            FormHome,
            FormBryntumCalendar            
        },
        data() {
            return {
                dati_tessera : null,
                activeTabs: [],
                currentTab: null,
                notifications: [],
                electronClient: false
            };
        },
        mounted() {
            if(window.electron) {
                window.electron.creaMenu(this.convertiPermessi(this.$page.props.user.permessi))
                this.electronClient = true
            } 

            /* ASCOLTA EVENTI DAL MAIN */
            if(window.electron) window.electron.openForm((event, data) => { this.activateForm(data); });
            if(window.electron) {
                window.electron.notificationsFromMain((event , data) => {
                    console.log(data);
                    this.addNotification(data.type , data.title , data.text);
                });
            }
        },
        methods: {
            activateForm(data) {
                if (!this.activeTabs.find(t => t.name == data.name)) this.activeTabs.push(data);
                this.currentTab = data;
            },
            destroyForm(component) {
                this.activeTabs.splice(this.activeTabs.findIndex(t => t.component === component), 1);
                this.currentTab = this.activeTabs[this.activeTabs.length - 1];
            },
            addNotification(type, title, text) {
                this.notifications.push({
                    show: true,
                    type,
                    title,
                    text,
                });
            },
            dismissNotification(id) {
                this.notifications.splice(this.notifications.findIndex(n => n.id === id), 1);
            },
            convertiPermessi(permessi)
            {
                
                let obj = {}
                for(const [key , value] of Object.entries(permessi)) {
                    obj[key] = value
                }
                return obj;
            },            
        },
    };
</script>