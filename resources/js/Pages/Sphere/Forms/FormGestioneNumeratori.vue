<template>
    <div class="h-full overflow-y-auto" >
        
        <div class="p-6 bg-white rounded-md">                
            <p class="text-md font-medium text-gray-800">Numeratori</p>
            <DxDataGrid 
                :data-source="numeratoriDataSource" 
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
                <DxColumn data-field="descrizione" />
                <DxColumn data-field="tipo" />
                <DxColumn data-field="suffisso" />
                <DxColumn data-field="automatico" />
                <DxColumn data-field="struttura_id" />
                
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
                    <DettagliNumeratoreTemplate
                        :template-data="data"
                    />
                </template>
            </DxDataGrid>
        </div>
    </div>
</template>
<script setup>
    import {
        DxDataGrid,
        DxColumn,        
        DxSelection,      
        DxEditing,        
        DxMasterDetail
    } from 'devextreme-vue/data-grid';
    import DettagliNumeratoreTemplate from '@forms/Components/DettagliNumeratoreTemplate.vue'
    

    import CustomStore from 'devextreme/data/custom_store';

    const numeratoriDataSource = new CustomStore({
        key: 'id',
        load: () => axios.get(`api/sphere/numeratore`).then(response => response.data).catch(err => { throw new Error('Errore caricamento'); }),
        insert: (values) => axios.post(`api/sphere/numeratore` , values).then(response => response.data).catch(err => { throw new Error('Errore caricamento'); }),
        //update: (key, values) => axios.put(`api/sphere/medsport/listino/${key}` , values),
        //remove: (key) => axios.delete(`api/sphere/medsport/listino/${key}`),
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