<template>
    <AppLayout>
        <template #navigazione>
            <nav class="-mb-px flex space-x-8" aria-label="Tabs" v-if="electronClient">
                <button @click="activateForm(tab)" v-for="(tab, tabIdx) in activeTabs" :key="tab" :class="[tab.component == currentTab.component ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm']" :aria-current="tab.current ? 'page' : undefined">
                    <component :is="tab.icon" :class="[tab.component == currentTab.component ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500', '-ml-0.5 mr-2 h-5 w-5']" aria-hidden="true" />
                    <span>{{ tab.name }}</span>
                </button>
            </nav>
            <nav class="-mb-px flex space-x-8" aria-label="Tabs" v-else>
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
    </AppLayout>    
</template>

<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue';

    import { BuildingOfficeIcon, CreditCardIcon, UserIcon, UsersIcon , XMarkIcon } from '@heroicons/vue/20/solid'
    
    import FormPazienti from './FormPazienti.vue';
    import FormAmbulatori from './FormAmbulatori.vue';
    import FormCalendario from './FormCalendario.vue';
    import FormMedici from './FormMedici.vue';
    import FormSocieta from './FormSocieta.vue';
    import FormAccettazioneMedsport from './FormAccettazioneMedsport.vue'
    import FormImpostazioniSport from './FormImpostazioniSport.vue'
    import FormHome from './FormHome.vue';
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
                        name: 'Calendario',
                        component: FormCalendario,
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