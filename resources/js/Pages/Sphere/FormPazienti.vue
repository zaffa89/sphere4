<template>
    <div>
        <DxDataGrid id="griglia" ref="griglia" :data-source="pazienti" key-expr="id"
            :allow-column-reordering="true" :allow-column-resizing="true" :column-auto-width="false"
            :column-min-width="50" column-resizing-mode="widget" :row-alternation-enabled="true" :show-row-lines="true"
            :hover-state-enabled="true" @contextMenuPreparing="openContextMenu" @row-prepared="onRowPrepared"
            @row-dbl-click="onRowDblClick" @row-removing="deletePaziente">
            <DxSelection mode="single" />
            <DxColumnChooser :enabled="true" />
            <DxColumn data-field="id" />
            <DxColumn data-field="codice" />
            <DxColumn data-field="ragione_sociale" />
            <DxColumn data-field="codice_fiscale" />
            <DxColumn data-field="sesso" />
            <DxColumn data-field="data_nascita" caption="Data di nascita" />
            <DxColumn data-field="localita_residenza.nome" caption="Località di residenza" />
            <DxColumn data-field="localita_residenza.sigla_provincia" caption="Provincia di residenza" />
            <DxColumn data-field="indirizzo" caption="Indirizzo" />
            <DxColumn data-field="civico" caption="Numero civico" />
            <DxColumn data-field="localita_nascita.nome" caption="Località di nascita" />
            <DxColumn data-field="localita_nascita.sigla_provincia" caption="Provincia di nascita" />

            <DxColumn data-field="created_at" />
            <DxColumn data-field="updated_at" :customize-text="timezoneFixer" />
            <!-- 
    <DxPaging
    :page-size="50"
    :page-index="0" />
    -->
            <DxScrolling mode="infinite" />
        </DxDataGrid>        
        
        <ModalPaziente
            v-if="modal_paziente_id"
            :paziente-id="modal_paziente_id"
            @close="modal_paziente_id = null"
            @store="pazienteSalvato"
            @update="pazienteModificato"
        />
  
    </div>
</template>

<script setup>
import ModalPaziente from './Modals/ModalPaziente.vue';
import {
    DxDataGrid,
    DxColumn,
    DxColumnChooser,
    DxSelection,
    DxScrolling,
    DxPaging,
} from 'devextreme-vue/data-grid';
import { locale } from 'devextreme/localization';

import { DxTextBox } from 'devextreme-vue/text-box';
import { MagnifyingGlassIcon } from '@heroicons/vue/24/solid';

import { dateFormat, dateAndTimeFormat } from '../../utilities/dateUtilities';
import AppLayout from '../../Layouts/AppLayout.vue';

</script>

<script>
export default {
    emits: ['notify'],
    //layout: AppLayout,
    remember: {
        data: ['pazienti']
    },
    data() {
        return {
            //flags
            fetching: false,
            modal_paziente_id: null,
            ricerca: null,
            errors: null,
            pazienti: []
            //data
            //pazienti: this.$page.props.pazienti
        };
    },
    computed: {
        disabledElement() {
            return this.fetching;
        },
    },
    async created() {
        locale('it-IT');
        await axios.get('api/sphere/paziente').then(response => { this.pazienti = response.data; });
    },
    methods: {
        timezoneFixer(data) {
            return dateAndTimeFormat(data.value);
        },
        pazienteSalvato(paziente) {
            this.pazienti.push(paziente);
            this.$refs.griglia.instance.refresh();
            this.$emit('notify', 'success', 'Paziente salvato con successo');
            this.modal_paziente_id = null;
        },
        async pazienteModificato(paziente) {
            await axios.get('api/sphere/paziente').then(response => { this.pazienti = response.data; });
            this.$emit('notify', 'success', 'Paziente modificato con successo');
            this.modal_paziente_id = null;
        },
        errorFor(field) {
            return null !== this.errors && this.errors[field]
                ? true
                : false;
        },
        onRowPrepared(e) {
            e.rowElement.className += ' hover:bg-gray-300';
        },
        openContextMenu(e) {

            if (e.row) this.$refs.griglia.instance.selectRows([e.row.key]);

            e.items = [
                {
                    visible: e.rowIndex > -1,
                    text: 'Apri',
                    icon: 'showpanel',
                    onItemClick: () => { this.apriPaziente(e.row.data.id); },
                },
                {
                    visible: e.rowIndex > -1,
                    text: 'Elimina',
                    icon: 'trash',
                    onItemClick: () => { this.confermaEliminaPaziente(e.rowIndex); },
                },
                {
                    text: 'Nuovo',
                    icon: 'plus',
                    onItemClick: () => { this.nuovoPaziente(); },
                },
            ];
        },
        aggiornaRiga(id) {

        },
        onRowDblClick(e) {
            this.apriPaziente(e.data.id);
        },
        confermaEliminaPaziente(rowIndex) {
            this.$refs.griglia.instance.option({ 'editing.texts.confirmDeleteMessage': 'Sei sicuro di voler eliminare il paziente selezionato?' });
            this.$refs.griglia.instance.deleteRow(rowIndex);
        },
        deletePaziente(e) {
            e.cancel = axios.delete(`api/sphere/paziente/${e.data.id}`)
                .then(response => {
                    this.$emit('notify', 'success', 'Paziente eliminato');
                    return false;
                })
                .catch(err => {
                    this.$emit('notify', 'error', 'Errore', 'Eliminazione fallita');
                    return true;
                });
        },
        nuovoPaziente() {
            this.modal_paziente_id = 'new';
        },
        apriPaziente(id) {
            this.modal_paziente_id = id;
        },
        async ricercaPaziente() {
            this.fetching = true;
            await axios.post('api/sphere/ricerca-paziente', { ricerca: this.ricerca }).then(response => {
                this.pazienti = response.data;
            }).catch(err => {

            });
            this.fetching = false;
        },
    },
};
</script>
<style scoped>
/*imposta altezza fissa della griglia dinamicamente ( 216px altezza header + footer ) */

#griglia.dx-widget {
    height: calc(100vh - 216px) !important;
}
</style>