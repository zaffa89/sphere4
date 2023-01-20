<template>
  <div>
    <DxDataGrid
      id="griglia"
      ref="griglia"
      :data-source="pazienti"
      key-expr="id"
      :allow-column-reordering="true"
      :allow-column-resizing="true"
      :column-auto-width="true"
      :column-min-width="50"
      column-resizing-mode="widget"
      :row-alternation-enabled="true"
      :show-row-lines="true"
      :hover-state-enabled="true"
      @contextMenuPreparing="openContextMenu"
      @row-prepared="onRowPrepared"
      @row-dbl-click="onRowDblClick"
      @row-removing="deletePaziente"
    >
      <DxSelection mode="single" />
      <DxColumnChooser :enabled="true" />
      <DxColumn
        data-field="prenotazione.accettata"
        data-type="boolean"
        false-text="NO"
        true-text="SI"
      />
      <DxColumn
        data-field="prenotazione.data_prenotazione"
        caption="Data prenotazione"
        :customize-text="timezoneFixer"
      />
      <DxColumn
        data-field="prenotazione.data_inizio"
        caption="Data/ora visita"
        :customize-text="timezoneFixer"
      />
      <DxColumn
        data-field="societa_sportiva.ragione_sociale"
        caption="Atleta"
        :customize-text="defaultPazienteText"
      />
      <DxColumn
        data-field="paziente.ragione_sociale"
        caption="Atleta"
        :customize-text="defaultPazienteText"
      />
      <DxColumn
        data-field="paziente.data_nascita"
        name="data_nascita"
        caption="Data nascita"
        :customize-text="dateFixer"
      />
      <DxColumn
        name="eta"
        caption="Età"
        :calculate-cell-value="calculateAge"
      />

      <DxColumn
        data-field="prestazione.nome"
        caption="Prestazione"
      />
      <DxColumn
        data-field="sport.nome"
        caption="Sport"
      />
      <DxColumn caption="Idoneo" />
      <DxColumn caption="N° Certificato" />
      <DxColumn caption="N° Cartella" />
      <DxColumn
        data-field="medico.ragione_sociale"
        caption="Medico"
      />

      <!--
        <DxColumn data-field="created_at" :customize-text="timezoneFixer" />
        <DxColumn data-field="updated_at" :customize-text="timezoneFixer" />
        
        <DxPaging :page-size="50" :page-index="0" />
        -->
      <DxScrolling mode="infinite" />
    </DxDataGrid>
    <div class="flex gap-3 h-24 items-end bg-gray-200 border-t border-black px-4 py-4">
      <div>
        <label
          for="ricerca"
          class="block text-sm font-medium text-gray-700"
        >Ricerca per nominativo</label>
        <div class="mt-1">
          <input
            id="ricerca"
            v-model="ricerca"
            type="text"
            name="ricerca"
            :disabled="disabledElement"
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            placeholder="Cognome e/o Nome"
          />
        </div>
      </div>
      <button
        type="button"
        :disabled="disabledElement"
        class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        @click="ricercaPaziente"
      >
        <MagnifyingGlassIcon
          class="-ml-1 mr-2 h-5 w-5"
          :class="{ 'animate-bounce': fetching }"
          aria-hidden="true"
        />
        Cerca
      </button>
    </div>
    <ModalSchedaMedsport
      v-if="modal_visita_id"
      :visita-id="modal_visita_id"
      @close="modal_visita_id = null"
      @store="pazienteSalvato"
      @update="pazienteModificato"
    />
  </div>
</template>
  
<script setup>
import ModalSchedaMedsport from './Modals/ModalSchedaMedsport.vue';
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

import { dateFormat, dateAndTimeFormat } from '../../utilities/dateUtilities';
import dayjs from 'dayjs';
</script>
  
<script>
export default {
    emits: ['notify'],
    data() {
        return {
            //flags
            fetching: false,
            modal_visita_id: null,
            ricerca: null,
            errors: null,


            //data
            pazienti: [],
        };
    },
    computed: {
        disabledElement() {
            return this.fetching;
        },
    },
    async created() {
        locale('it-IT');
        await axios.post('api/sphere/carica-accettazione-medsport', {
            data_inizio: dayjs().format('YYYY-MM-DD'),
            data_fine: '2023-02-01', //dayjs().format('YYYY-MM-DD'),                
        }).then(response => { this.pazienti = response.data; });
    },
    methods: {
        timezoneFixer(data) {
            return dateAndTimeFormat(data.value);
        },
        dateFixer(data) {
            return data.value ? dateFormat(data.value) : '';
        },
        calculateAge(row) {
            return row.paziente ? dayjs().diff(dayjs(row.paziente.data_nascita), 'year') : '';
        },
        defaultSocietaText(data) {
            return data.value ?? 'NESSUNA';
        },
        defaultPazienteText(data) {
            return data.value ?? 'PAZIENTE MANCANTE';
        },
        pazienteSalvato(paziente) {
            this.pazienti.push(paziente);
            this.$refs.griglia.instance.refresh();
            this.$emit('notify', 'success', 'Paziente salvato con successo');
            this.modal_visita_id = null;
        },
        async pazienteModificato(paziente) {
            await axios.get('api/sphere/paziente').then(response => { this.pazienti = response.data; });
            this.$emit('notify', 'success', 'Paziente modificato con successo');
            this.modal_visita_id = null;
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
            this.modal_visita_id = 'new';
        },
        apriPaziente(id) {
            this.modal_visita_id = id;
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
/*imposta altezza fissa della griglia dinamicamente ( -64px della toolbar in alto -64px toolbar in basso) */

#griglia.dx-widget {
    height: calc(100vh - 149px) !important;
}
</style>