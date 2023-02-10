<template>
    <div class="h-full overflow-y-auto" >
        <div class="fixed top-20 bg-white rounded border">
            <div class="border-b px-2 py-2 text-center">Medicina dello sport</div>
            <nav class="space-y-1 w-60 mb-5">
                <button v-for="item in medsportNav" :key="item.tab" @click="changeTab(item.tab)" :class="[currentTab === item.tab ? 'bg-teal-50 border-teal-500 text-teal-700 hover:bg-teal-50 hover:text-teal-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900', 'w-full group border-l-4 px-3 py-2 flex items-center text-sm font-medium']">
                    <component :is="item.icon" :class="[currentTab === item.tab ? 'text-teal-500 group-hover:text-teal-500' : 'text-gray-400 group-hover:text-gray-500', 'flex-shrink-0 -ml-1 mr-3 h-6 w-6']" aria-hidden="true" />
                    <span class="truncate">{{ item.name }}</span>
                </button>
            </nav>
            <div class="border-b px-2 py-2 text-center">Ambulatoriale</div>
            <nav class="space-y-1 w-60">
                <button v-for="item in ambulatorialeNav" :key="item.tab" @click="changeTab(item.tab)" :class="[currentTab === item.tab ? 'bg-teal-50 border-teal-500 text-teal-700 hover:bg-teal-50 hover:text-teal-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900', 'w-full group border-l-4 px-3 py-2 flex items-center text-sm font-medium']">
                    <component :is="item.icon" :class="[currentTab === item.tab ? 'text-teal-500 group-hover:text-teal-500' : 'text-gray-400 group-hover:text-gray-500', 'flex-shrink-0 -ml-1 mr-3 h-6 w-6']" aria-hidden="true" />
                    <span class="truncate">{{ item.name }}</span>
                </button>
            </nav>
        </div>
        <div class="ml-64 p-6 bg-white rounded-md">
            <div v-if="currentTab === 'ms-listino'">             
                <p class="text-md font-medium text-gray-800">Listino Medicina dello Sport</p>
                <DxDataGrid 
                    :data-source="listiniMedsportDataSource" 
                    :show-borders="true"
                    :allow-column-reordering="true" 
                    :allow-column-resizing="true" 
                    :column-auto-width="false"
                    :column-min-width="50" 
                    column-resizing-mode="widget" 
                    :row-alternation-enabled="false" 
                    :show-row-lines="true"
                    :hover-state-enabled="true"                  
                    width="100%"
                >
                    <DxSelection mode="single" />                                  
                    <DxColumn data-field="id" />
                    <DxColumn data-field="codice" />
                    <DxColumn data-field="nome" />
                    <DxColumn data-field="tipo_visita" />
                    <DxColumn data-field="prezzo" />
                    <DxColumn data-field="durata" />
                    <DxColumn data-field="agonistica" />
                    <DxColumn data-field="tracciato" />
                    <DxColumn data-field="rtp" />
                    <DxColumn data-field="tipo_scheda" />

                    <DxScrolling mode="infinite" />
                    <DxEditing
                        mode="form"                       
                        :allow-updating="true"
                        :allow-adding="true"
                        :allow-deleting="true"
                    />
                    <DxMasterDetail
                        :enabled="true"
                        template="masterDetailTemplate"
                        />
                    <template #masterDetailTemplate="{ data }">
                        <PrestazioniListinoMedsportTemplate
                            :template-data="data"
                        />
                    </template>
                </DxDataGrid>                
            </div>
            <div v-if="currentTab === 'ms-prestazioni'">
                <p class="text-md font-medium text-gray-800">Prestazioni Medicina dello Sport</p>
                <DxDataGrid ref="grigliaPrestazioniMedsport" 
                    :data-source="prestazioniMedsportDataSource"                
                    :allow-column-reordering="true" 
                    :allow-column-resizing="true" 
                    :column-auto-width="true"
                    :column-min-width="50" 
                    column-resizing-mode="widget" 
                    :row-alternation-enabled="true" 
                    :show-row-lines="true"
                    :hover-state-enabled="true"  
                    :show-borders="true"                    
                    width="100%"
                >
                    <DxSelection mode="single" />                                  
                    <DxColumn data-field="id" :allow-editing="false" />
                    <DxColumn data-field="codice" />
                    <DxColumn data-field="nome" />                               
                    <DxColumn data-field="rimborso_asl" caption="Rimborso ASL" />
                    <DxColumn data-field="istat" :allow-editing="false"  />
                    <DxColumn data-field="branca" :allow-editing="false"  />
                    <DxColumn data-field="codice_siss" :allow-editing="false"  />

                    <DxScrolling mode="infinite" />
                    <DxEditing
                        mode="form"
                        :allow-updating="true"
                        :allow-adding="true"
                        :allow-deleting="true"
                    />
                </DxDataGrid>
            </div>
            <div v-if="currentTab === 'ambu-listino'">
                <p class="text-md font-medium text-gray-800">Listino Ambulatoriale</p>
                <DxDataGrid 
                    :data-source="listiniAmbulatorialiDataSource" 
                    :show-borders="true"
                    :allow-column-reordering="true" 
                    :allow-column-resizing="true" 
                    :column-auto-width="false"
                    :column-min-width="50" 
                    column-resizing-mode="widget" 
                    :row-alternation-enabled="false" 
                    :show-row-lines="true"
                    :hover-state-enabled="true"
                    width="100%"                 
                >
                    <DxSelection mode="single" />                                  
                    <DxColumn data-field="id" />
                    <DxColumn data-field="codice" />
                    <DxColumn data-field="nome" />            
                    <DxColumn data-field="prezzo" />
                    <DxColumn data-field="durata" />
                    <DxColumn data-field="referto_ambulatoriale" />
                    <DxColumn data-field="referto_cardiologia" />
                    <DxColumn data-field="referto_fisioterapia" />
                   
                    <DxScrolling mode="infinite" />
                    <DxEditing
                        mode="form"                       
                        :allow-updating="true"
                        :allow-adding="true"
                        :allow-deleting="true"
                    />
                    <DxMasterDetail
                        :enabled="true"
                        template="masterDetailTemplate"
                        />
                    <template #masterDetailTemplate="{ data }">
                        <PrestazioniListinoAmbulatorialeTemplate
                            :template-data="data"
                        />
                    </template>
                </DxDataGrid>
            </div>
            <div v-if="currentTab === 'ambu-prestazioni'">
                <p class="text-md font-medium text-gray-800">Prestazioni Ambulatoriali</p>
                <DxDataGrid
                    :data-source="prestazioniAmbulatorialiDataSource"
                    :allow-column-reordering="true"
                    :allow-column-resizing="true"
                    :column-auto-width="true"
                    :column-min-width="50" 
                    column-resizing-mode="widget" 
                    :row-alternation-enabled="true" 
                    :show-row-lines="true"
                    :hover-state-enabled="true"  
                    :show-borders="true"                    
                    width="100%"
                >
                    <DxSelection mode="single" />                                  
                    <DxColumn data-field="id" :allow-editing="false" />
                    <DxColumn data-field="codice" />
                    <DxColumn data-field="nome" />
                    <DxColumn data-field="durata" :allow-editing="false"  />                             
                    <DxColumn data-field="prezzo" />                    

                    <DxScrolling mode="infinite" />
                    <DxEditing
                        mode="form"
                        :allow-updating="true"
                        :allow-adding="true"
                        :allow-deleting="true"
                    />
                </DxDataGrid>
            </div>
        </div>
    </div>
</template>
<script setup>
    import {
        DxDataGrid,
        DxColumn,        
        DxSelection,
        DxScrolling,        
        DxEditing,        
        DxMasterDetail
    } from 'devextreme-vue/data-grid';
    import PrestazioniListinoMedsportTemplate from './Components/PrestazioniListinoMedsportTemplate.vue'
    import PrestazioniListinoAmbulatorialeTemplate from './Components/PrestazioniListinoAmbulatorialeTemplate.vue'

    import CustomStore from 'devextreme/data/custom_store';

    import { ListBulletIcon , AdjustmentsHorizontalIcon } from '@heroicons/vue/24/outline'

    const medsportNav = [
        { name: 'Listino' , icon: ListBulletIcon , tab: 'ms-listino' },
        { name: 'Prestazioni' , icon: AdjustmentsHorizontalIcon , tab: 'ms-prestazioni' },            
    ]

    const ambulatorialeNav = [       
        { name: 'Listino' , icon: ListBulletIcon , tab: 'ambu-listino' },
        { name: 'Prestazioni' , icon: AdjustmentsHorizontalIcon , tab: 'ambu-prestazioni' },
        
    ]

    const listiniMedsportDataSource = new CustomStore({
        key: 'id',
        load: () => axios.get(`api/sphere/medsport/listino`).then(response => response.data).catch(err => { throw new Error('Errore caricamento'); }),
        insert: (values) => axios.post(`api/sphere/medsport/listino` , values).then(response => response.data).catch(err => { throw new Error('Errore caricamento'); }),
        update: (key, values) => axios.put(`api/sphere/medsport/listino/${key}` , values),
        remove: (key) => axios.delete(`api/sphere/medsport/listino/${key}`),
        errorHandler: (error) => {
            console.log(error.message);
        },
    });

    const prestazioniMedsportDataSource = new CustomStore({
        key: 'id',
        load: () => axios.get(`api/sphere/medsport/prestazione`).then(response => response.data).catch(err => { throw new Error('Errore caricamento'); }),
        insert: (values) => axios.post(`api/sphere/medsport/prestazione` , values).then(response => response.data).catch(err => { throw new Error('Errore caricamento'); }),
        update: (key, values) => axios.put(`api/sphere/medsport/prestazione/${key}` , values),
        remove: (key) => axios.delete(`api/sphere/medsport/prestazione/${key}`),
        errorHandler: (error) => {
            console.log(error.message);
        },
    });

    const listiniAmbulatorialiDataSource = new CustomStore({
        key: 'id',
        load: () => axios.get(`api/sphere/ambulatoriale/listino`).then(response => response.data).catch(err => { throw new Error('Errore caricamento'); }),
        insert: (values) => axios.post(`api/sphere/ambulatoriale/listino` , values).then(response => response.data).catch(err => { throw new Error('Errore caricamento'); }),
        update: (key, values) => axios.put(`api/sphere/ambulatoriale/listino/${key}` , values),
        remove: (key) => axios.delete(`api/sphere/ambulatoriale/listino/${key}`),
        errorHandler: (error) => {
            console.log(error.message);
        },
    });

    const prestazioniAmbulatorialiDataSource = new CustomStore({
        key: 'id',
        load: () => axios.get(`api/sphere/ambulatoriale/prestazione`).then(response => response.data).catch(err => { throw new Error('Errore caricamento'); }),
        insert: (values) => axios.post(`api/sphere/ambulatoriale/prestazione` , values).then(response => response.data).catch(err => { throw new Error('Errore caricamento'); }),
        update: (key, values) => axios.put(`api/sphere/ambulatoriale/prestazione/${key}` , values),
        remove: (key) => axios.delete(`api/sphere/ambulatoriale/prestazione/${key}`),
        errorHandler: (error) => {
            console.log(error.message);
        },
    });
</script>

<script>
    export default {
        data() {
            return {
                currentTab: null                
            }
        },
        methods: {
            changeTab(tab) {
                this.currentTab = tab
            },                       
        },        
    }
</script>

<style scoped>
    #contenuto {
        height: calc(100vh - 149px) !important;
    }
</style>