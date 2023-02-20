<template>
    <div>
        <div class="master-detail-caption">Contatori associati</div>        
        <DxDataGrid           
            :data-source="numeratoriAssociati" 
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
            <DxColumn data-field="anno" caption="Anno ( Lasciare vuoto se il contatore è progressivo )" />
            <DxColumn data-field="valore" />                               
            <DxEditing
                mode="row"            
                :allow-updating="true"
                :allow-adding="true"
                :allow-deleting="true"
            />                                                      
            
        </DxDataGrid>
    </div>
</template>

<script setup>
    import { DxDataGrid, DxColumn , DxEditing , DxSelection } from 'devextreme-vue/data-grid';
    import { DxSelectBox } from 'devextreme-vue/select-box';
    import DxButton from 'devextreme-vue/button';
    import CustomStore from 'devextreme/data/custom_store';

    const props = defineProps({
        templateData: Object
    })

    const numeratoriAssociati = { 
        store: new CustomStore({
                key: 'id',
                load: () => axios.get(`api/sphere/numeratore-det/${props.templateData.data.id}`).then(response => response.data).catch(err => { throw new Error('Errore caricamento'); }),
                insert: (values) => { console.log(values); axios.post(`api/sphere/numeratore-det/${props.templateData.data.id}` , values).then(response => response.data).catch(err => { throw new Error('Errore caricamento'); }) },        
                update: (key , values) => axios.put(`api/sphere/numeratore-det/${key}` , values),
                remove: (key) => axios.delete(`api/sphere/numeratore-det/${key}`),
                errorHandler: (error) => {
                    console.log(error.message);
                }                        
            }),
        reshapeOnPush: true
    }
</script>