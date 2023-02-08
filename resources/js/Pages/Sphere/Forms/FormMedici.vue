<template>
  <div>
    <DxDataGrid
      id="griglia"
      ref="griglia"
      :data-source="medici"
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
      @row-removing="deleteMedico"
    >
      <DxSelection mode="single" />
      <DxColumnChooser :enabled="true" />
      <DxColumn data-field="id" />
      <DxColumn
        data-field="ragione_sociale"
        caption="Ragione Sociale"
      />
      <DxColumn
        data-field="codice_fiscale"
        caption="Codice fiscale"
      />
      <DxColumn
        data-field="sphere_user_id"
        caption="Utente Sphere associato"
      />
      <DxColumn
        data-field="struttura"
        caption="Struttura"
      />

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
    
    <ModalMedico
      v-if="modal_medico_id"
      :medico-id="modal_medico_id"
      @close="modal_medico_id = null"
      @store="medicoSalvato"
      @update="medicoModificato"
    />
  </div>
</template>

<script setup>
import ModalMedico from '../Modals/ModalMedico.vue';
import {
    DxDataGrid,
    DxColumn,
    DxColumnChooser,
    DxSelection,
    DxScrolling,
    DxPaging,
} from 'devextreme-vue/data-grid';
import { locale } from 'devextreme/localization';

import { MagnifyingGlassIcon } from '@heroicons/vue/24/solid';

import { dateFormat, dateAndTimeFormat } from '../../../utilities/dateUtilities';
</script>

<script>
export default {
    emits: ['notify'],
    data() {
        return {
            //flags
            fetching: false,
            modal_medico_id: null,
            ricerca: null,
            errors: null,


            //data
            medici: [],
        };
    },
    computed: {
        disabledElement() {
            return this.fetching;
        },
    },
    async created() {
        locale('it-IT');
        await axios.get('api/sphere/medico').then(response => { this.medici = response.data; });
    },
    methods: {
        timezoneFixer(data) {
            return dateAndTimeFormat(data.value);
        },
        medicoSalvato(medico) {
            this.medici.push(medico);
            this.$refs.griglia.instance.refresh();
            this.$emit('notify', 'success', 'Medico salvato con successo');
            this.modal_medico_id = null;
        },
        async medicoModificato(medico) {
            await axios.get('medico').then(response => { this.medici = response.data; });
            this.$emit('notify', 'success', 'Medico modificato con successo');
            this.modal_medico_id = null;
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
                    onItemClick: () => { this.apriMedico(e.row.data.id); },
                },
                {
                    visible: e.rowIndex > -1,
                    text: 'Elimina',
                    icon: 'trash',
                    onItemClick: () => { this.confermaEliminaMedico(e.rowIndex); },
                },
                {
                    text: 'Nuovo',
                    icon: 'plus',
                    onItemClick: () => { this.nuovoMedico(); },
                },
            ];
        },
        aggiornaRiga(id) {

        },
        onRowDblClick(e) {
            this.apriMedico(e.data.id);
        },
        confermaEliminaMedico(rowIndex) {
            this.$refs.griglia.instance.option({ 'editing.texts.confirmDeleteMessage': 'Sei sicuro di voler eliminare il medico selezionato?' });
            this.$refs.griglia.instance.deleteRow(rowIndex);
        },
        deleteMedico(e) {
            e.cancel = axios.delete(`api/sphere/medico/${e.data.id}`)
                .then(response => {
                    this.$emit('notify', 'success', 'Medico eliminato');
                    return false;
                })
                .catch(err => {
                    this.$emit('notify', 'error', 'Errore', 'Eliminazione fallita');
                    return true;
                });
        },
        nuovoMedico() {
            this.modal_medico_id = 'new';
        },
        apriMedico(id) {
            this.modal_medico_id = id;
        },
        async ricercaMedico() {
            this.fetching = true;
            await axios.post('api/sphere/ricerca-medico', { ricerca: this.ricerca }).then(response => {
                this.medici = response.data;
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