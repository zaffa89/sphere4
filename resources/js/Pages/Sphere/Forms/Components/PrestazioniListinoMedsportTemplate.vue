<template>
    <div>
        <div class="master-detail-caption">Prestazioni associate</div>
        <div class="flex my-3">
            <div class="w-full md:w-1/2">
                <DxSelectBox                           
                    v-model="prestazione_selezionata"
                    :search-enabled="true"
                    :data-source="prestazioniMedsportDataSource"
                    search-mode="contains"
                    :search-expr="['codice' , 'nome']"
                    :search-timeout="100"
                    :show-data-before-search="true"
                    display-expr="nome"
                    placeholder="Seleziona una prestazione da associare a questa visita"
                    :item-template="selectPrestazioneItemTemplate"
                />
            </div>
            <div class="w-full md:w-1/2">
                <DxButton 
                    width="100%"                           
                    text="Aggiungi"
                    type="success"
                    icon="Aggiungi"
                    styling-mode="outlined"
                    :disabled="!prestazione_selezionata"
                    @click="addToStore"
                />
            </div>
            
        </div>
        <DxDataGrid           
            :data-source="prestazioniAssociate" 
            :show-borders="true"
            :allow-column-reordering="true" 
            :allow-column-resizing="true" 
            :column-auto-width="true"
            :column-min-width="50" 
            column-resizing-mode="widget" 
            :row-alternation-enabled="true" 
            :show-row-lines="true"
            :hover-state-enabled="true"          
            width="100%"            
        >
            <DxSelection mode="single" />                                  
            <DxColumn data-field="id" :allow-editing="false" />
            <DxColumn data-field="codice" />
            <DxColumn data-field="nome" />                               
            <DxColumn data-field="rimborso_asl" :allow-editing="false" caption="Rimborso ASL" />                    
            <DxEditing
                mode="row"                        
                :allow-deleting="true"
            />                                                      
            <DxSummary :recalculate-while-editing="true">
                <DxTotalItem
                    column="rimborso_asl"
                    summary-type="sum"
                    
                    display-format="Totale rimborso ASL € {0}"
                    show-in-column="rimborso_asl"
                />
            </DxSummary>
        </DxDataGrid>
    </div>
</template>

<script setup>
    import { ref } from 'vue'
    import { DxDataGrid, DxColumn , DxEditing , DxSelection , DxSummary , DxTotalItem } from 'devextreme-vue/data-grid';
    import { DxSelectBox } from 'devextreme-vue/select-box';
    import DxButton from 'devextreme-vue/button';
    import CustomStore from 'devextreme/data/custom_store';

    const props = defineProps({
        templateData: Object
    })

    const prestazione_selezionata = ref(null)

    const prestazioniMedsportDataSource = new CustomStore({
        key: 'id',
        load: () => axios.get(`api/sphere/medsport/prestazione`).then(response => response.data).catch(err => { throw new Error('Errore caricamento'); }),        
        errorHandler: (error) => {
            console.log(error.message);
        },        
    });

    const prestazioniAssociate = { 
        store: new CustomStore({
                key: 'id',
                load: () => axios.get(`api/sphere/medsport/prestazioni-listino/${props.templateData.data.id}`).then(response => response.data).catch(err => { throw new Error('Errore caricamento'); }),
                insert: (key) => axios.post(`api/sphere/medsport/prestazioni-listino/add/${props.templateData.data.id}/${key}`).then(response => response.data).catch(err => { throw new Error('Errore caricamento'); }),        
                remove: (key) => axios.delete(`api/sphere/medsport/prestazioni-listino/remove/${props.templateData.data.id}/${key}`),
                errorHandler: (error) => {
                    console.log(error.message);
                },
                onPush: (changes) => {            
                    axios.post(`api/sphere/medsport/prestazioni-listino/add/${props.templateData.data.id}/${changes[0].data.id}`).then(response => response.data).catch(err => { throw new Error('Errore caricamento'); })          
                }        
            }),
        reshapeOnPush: true
    }

    function addToStore()
    {
        if(prestazione_selezionata.value) {          
            prestazioniAssociate.store.push([{type: "insert" , data: prestazione_selezionata.value , index: -1}])            
            prestazione_selezionata.value = null
        }
    }
    
    function selectPrestazioneItemTemplate(data) {
        return data ? '<div class="flex gap-2"><span class="truncate capitalize w-1/5">' + data.codice + '</span> <span class="uppercase">' + data.nome + '</span></div>' : '<div />';
    }

   
    
</script>