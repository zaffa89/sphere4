<template>
  <div>
    <DxDataGrid
      id="griglia"
      ref="griglia"
      :data-source="societaSportive"
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
      @row-removing="deleteSocieta"
    >
      <DxSelection mode="single" />
      <DxColumnChooser :enabled="true" />
      <DxColumn data-field="id" />
      <DxColumn
        data-field="ragione_sociale"
        caption="Ragione sociale"
      />
      <DxColumn data-field="indirizzo" />
      <DxColumn data-field="civico" />
      <DxColumn
        data-field="localita.nome"
        caption="Località"
      />
      <DxColumn
        data-field="localita.sigla_provincia"
        caption="Provincia"
      />
      <DxColumn
        data-field="partita_iva"
        caption="P. IVA"
      />
      <DxColumn
        data-field="codice_fiscale"
        caption="Codice Fiscale"
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
        @click="ricercaSocieta"
      >
        <MagnifyingGlassIcon
          class="-ml-1 mr-2 h-5 w-5"
          :class="{ 'animate-bounce': fetching }"
          aria-hidden="true"
        />
        Cerca
      </button>
    </div>
    <ModalSocietaSportiva
      v-if="modal_societa_id"
      :societa-id="modal_societa_id"
      @close="modal_societa_id = null"
      @store="societaSalvata"
      @update="societaModificata"
    />
  </div>
</template>

<script setup>
import ModalSocietaSportiva from './Modals/ModalSocietaSportiva.vue';
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
</script>

<script>
export default {
    emits: ['notify'],
    data() {
        return {
            //flags
            fetching: false,
            modal_societa_id: null,
            ricerca: null,
            errors: null,

            //data
            societaSportive: [],
        };
    },
    computed: {
        disabledElement() {
            return this.fetching;
        },
    },
    async created() {
        locale('it-IT');
        await axios.get('api/sphere/societa-sportiva').then(response => { this.societaSportive = response.data; });
    },
    methods: {
        timezoneFixer(data) {
            return dateAndTimeFormat(data.value);
        },
        societaSalvata(societa) {
            this.societaSportive.push(societa);
            this.$refs.griglia.instance.refresh();
            this.$emit('notify', 'success', 'Società salvata con successo');
            this.modal_societa_id = null;
        },
        async societaModificata(societa) {
            await axios.get('api/sphere/societa-sportiva').then(response => { this.societaSportive = response.data; });
            this.$emit('notify', 'success', 'Società modificata con successo');
            this.modal_societa_id = null;
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
                    onItemClick: () => { this.apriSocieta(e.row.data.id); },
                },
                {
                    visible: e.rowIndex > -1,
                    text: 'Elimina',
                    icon: 'trash',
                    onItemClick: () => { this.confermaEliminaSocieta(e.rowIndex); },
                },
                {
                    text: 'Nuovo',
                    icon: 'plus',
                    onItemClick: () => { this.nuovaSocieta(); },
                },
            ];
        },
        aggiornaRiga(id) {

        },
        onRowDblClick(e) {
            this.apriSocieta(e.data.id);
        },
        confermaEliminaSocieta(rowIndex) {
            this.$refs.griglia.instance.option({ 'editing.texts.confirmDeleteMessage': 'Sei sicuro di voler eliminare la società selezionata?' });
            this.$refs.griglia.instance.deleteRow(rowIndex);
        },
        deleteSocieta(e) {
            e.cancel = axios.delete(`api/sphere/societa-sportiva/${e.data.id}`)
                .then(response => {
                    this.$emit('notify', 'success', 'Società eliminata');
                    return false;
                })
                .catch(err => {
                    this.$emit('notify', 'error', 'Errore', 'Eliminazione fallita');
                    return true;
                });
        },
        nuovaSocieta() {
            this.modal_societa_id = 'new';
        },
        apriSocieta(id) {
            this.modal_societa_id = id;
        },
        async ricercaSocieta() {
            this.fetching = true;
            await axios.post('api/sphere/ricerca-societa', { ricerca: this.ricerca }).then(response => {
                this.societaSportive = response.data;
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