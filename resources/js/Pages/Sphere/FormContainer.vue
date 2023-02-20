<template>
    <AppLayout>
        <template #navigazione>
            <nav class="-mb-px sm:flex hidden space-x-8" aria-label="Tabs" v-if="electronClient">
                <button @click="activateForm(tab)" v-for="(tab, tabIdx) in activeTabs" :key="tab" :class="[tab.component == currentTab.component ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm']" :aria-current="tab.current ? 'page' : undefined">
                    <component :is="tab.icon" :class="[tab.component == currentTab.component ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500', '-ml-0.5 mr-2 h-5 w-5']" aria-hidden="true" />
                    <span>{{ tab.name }}</span>
                </button>
            </nav>
            <nav class="-mb-px sm:flex space-x-8 hidden" aria-label="Tabs" v-else>
                <button @click="activateForm(tab)" v-for="(tab, tabIdx) in browserTabs" :key="tab" :class="[tab.component == currentTab?.component ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm']" :aria-current="tab.current ? 'page' : undefined">
                    <component :is="tab.icon" :class="[tab.component == currentTab?.component ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500', '-ml-0.5 mr-2 h-5 w-5']" aria-hidden="true" />
                    <span>{{ tab.name }}</span>
                </button>
            </nav>
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
            v-show="tab.component == currentTab.component"
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
    </AppLayout>    
</template>

<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue';

    import { BuildingOfficeIcon, CreditCardIcon, UserIcon, UsersIcon , XMarkIcon } from '@heroicons/vue/20/solid'
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

    import FormHome from '@forms/FormHome.vue';
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
            UserIcon
        },
        data() {
            return {
                dati_tessera : null,
                activeTabs: [],
                currentTab: null,
                notifications: [],
                electronClient: false,

                browserTabs: [
                    {
                        name: 'Home',
                        component: FormHome,
                        icon: null,
                    },
                    {
                        name: 'Calendario',
                        component: FormCalendario,
                        icon: null
                    },
                    {
                        name: 'Accettazioni MS',
                        component: FormAccettazioneMedsport,
                        icon: null
                    },
                    {
                        name: 'Pazienti',
                        component: FormPazienti,
                        icon: null
                    },
                    {
                        name: 'Gestione Prestazioni',
                        component: FormGestionePrestazioni,
                        icon: null
                    },
                    {
                        name: 'Numeratori',
                        component: FormGestioneNumeratori,
                        icon: null
                    }
                    
                    
                ]
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
                if (!this.activeTabs.find(t => t.component == data.component)) this.activeTabs.push(data);
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
            convertiPermessi(arrayPermessi)
            {
                let obj = {};
                arrayPermessi.forEach(p => {
                    obj[p.field] = true
                })
                return obj
            },            
        },
    };
</script>