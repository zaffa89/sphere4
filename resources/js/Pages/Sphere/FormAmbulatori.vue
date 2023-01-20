<template>
  <div>
    <DxDataGrid
      id="griglia"
      ref="griglia"
      :data-source="ambulatori"
      key-expr="id"
      :allow-column-reordering="true"
      :allow-column-resizing="true"
      :column-auto-width="false"
      :column-min-width="50"
      column-resizing-mode="widget"
      :row-alternation-enabled="true"
      :show-row-lines="true"
      :hover-state-enabled="true"
      @contextMenuPreparing="openContextMenu"
      @row-prepared="onRowPrepared"
      @row-dbl-click="onRowDblClick"
      @row-removing="deleteAmbulatorio"
    >
      <DxSelection mode="single" />
      <DxColumnChooser :enabled="true" />
      <DxColumn data-field="id" />
      <DxColumn
        data-field="nome"
        caption="Nome ambulatorio"
      />
      <DxColumn
        data-field="struttura_id"
        caption="Struttura"
      />
      <DxColumn data-field="attivo" />


      <DxColumn
        data-field="created_at"
        :customize-text="timezoneFixer"
      />
      <DxColumn
        data-field="updated_at"
        :customize-text="timezoneFixer"
      />
      <!-- 
			<DxPaging
				:page-size="50"
				:page-index="0" />
			-->
      <DxScrolling mode="infinite" />
    </DxDataGrid>
    <!-- 
    <ModalAmbulatorio
      v-if="modal_ambulatorio_id"
      :ambulatorio-id="modal_ambulatorio_id"
      @close="modal_ambulatorio_id = null"
      @store="ambulatorioSalvato"
      @update="ambulatorioModificato"
    />
    -->
  </div>
</template>

<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import ModalAmbulatorio from './Modals/ModalAmbulatorio.vue';
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
</script>

<script>
export default {
    emits: ['notify'],
    //layout: AppLayout,
    data() {
        return {
            //flags
            fetching: false,
            modal_ambulatorio_id: null,
            ricerca: null,
            errors: null,

            //data
            ambulatori: [],
        };
    },
    computed: {
        disabledElement() {
            return this.fetching;
        },
    },
    async created() {
        locale('it-IT');
        await axios.get('api/sphere/ambulatorio').then(response => { this.ambulatori = response.data; });
    },
    methods: {
        timezoneFixer(data) {
            return dateAndTimeFormat(data.value);
        },
        ambulatorioSalvato(ambulatorio) {
            this.ambulatori.push(ambulatorio);
            this.$refs.griglia.instance.refresh();
            this.$emit('notify', 'success', 'Ambulatorio salvato con successo');
            this.modal_ambulatorio_id = null;
        },
        async ambulatorioModificato(ambulatorio) {
            await axios.get('api/sphere/ambulatorio').then(response => { this.ambulatori = response.data; });
            this.$emit('notify', 'success', 'Ambulatorio modificato con successo');
            this.modal_ambulatorio_id = null;
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
                    onItemClick: () => { this.apriAmbulatorio(e.row.data.id); },
                },
                {
                    visible: e.rowIndex > -1,
                    text: 'Elimina',
                    icon: 'trash',
                    onItemClick: () => { this.confermaEliminaAmbulatorio(e.rowIndex); },
                },
                {
                    text: 'Nuovo',
                    icon: 'plus',
                    onItemClick: () => { this.nuovoAmbulatorio(); },
                },
            ];
        },
        aggiornaRiga(id) {

        },
        onRowDblClick(e) {
            this.apriAmbulatorio(e.data.id);
        },
        confermaEliminaAmbulatorio(rowIndex) {
            this.$refs.griglia.instance.option({ 'editing.texts.confirmDeleteMessage': "Sei sicuro di voler eliminare l'ambulatorio selezionato?" });
            this.$refs.griglia.instance.deleteRow(rowIndex);
        },
        deleteAmbulatorio(e) {
            e.cancel = axios.delete(`api/sphere/ambulatorio/${e.data.id}`)
                .then(response => {
                    this.$emit('notify', 'success', 'Ambulatorio eliminato');
                    return false;
                })
                .catch(err => {
                    this.$emit('notify', 'error', 'Errore', 'Eliminazione fallita');
                    return true;
                });
        },
        nuovoAmbulatorio() {
            this.modal_ambulatorio_id = 'new';
        },
        apriAmbulatorio(id) {
            this.modal_ambulatorio_id = id;
        },
        async ricercaAmbulatorio() {
            this.fetching = true;
            await axios.post('api/sphere/ricerca-ambulatorio', { ricerca: this.ricerca }).then(response => {
                this.ambulatori = response.data;
            }).catch(err => {

            });
            this.fetching = false;
        },
    },

};
</script>
<style scoped>
/*imposta altezza fissa della griglia dinamicamente ( -64px della toolbar in alto -64px toolbar in basso) */

#griglia.dx-widget {
    height: calc(100vh - 149px) !important;
}
</style>