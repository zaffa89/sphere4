<template>
  <div>
    <DxDataGrid
      id="griglia"
      ref="griglia"
      :data-source="sport"
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
      @row-removing="deleteSport"
    >
      <DxSearchPanel
        :visible="true"
        :width="240"
        placeholder="Cerca..."
      />
      <DxSelection mode="single" />
      <DxColumnChooser :enabled="true" />
      <DxColumn data-field="id" />
      <DxColumn
        data-field="nome"
        caption="Nome sport"
      />
      <DxColumn data-field="tipo_visita" />
      <DxColumn data-field="mesi_scadenza" />
      <DxColumn data-field="eta_minima_maschi" />
      <DxColumn data-field="eta_massima_maschi" />
      <DxColumn data-field="eta_minima_tem_maschi" />

      <DxColumn data-field="eta_minima_femmine" />
      <DxColumn data-field="eta_massima_femmine" />
      <DxColumn data-field="eta_minima_tem_femmine" />

      <DxColumn data-field="anno_di_riferimento" />
      <DxColumn data-field="inizio_anno_riferimento" />
      <DxColumn data-field="fine_anno_riferimento" />

      <DxColumn data-field="disabili" />




      <DxColumn
        data-field="created_at"
        :customize-text="timezoneFixer"
      />
      <DxColumn
        data-field="updated_at"
        :customize-text="timezoneFixer"
      />


      <DxPaging :page-size="20" />
      <DxPager
        :visible="true"
        :allowed-page-sizes="[10, 20, 100, 'all']"
        display-mode="full"
        :show-page-size-selector="true"
        :show-info="true"
        :show-navigation-buttons="true"
      />

      <DxScrolling row-rendering-mode="virtual" />
      <!--
			<DxScrolling mode="infinite" />
    -->
    </DxDataGrid>

    <ModalSport
      v-if="modal_sport_id"
      :sport-id="modal_sport_id"
      @close="modal_sport_id = null"
      @store="sportSalvato"
      @update="sportModificato"
    />
  </div>
</template>
  
<script setup>
import ModalSport from './Modals/ModalSport.vue';
import {
    DxDataGrid,
    DxColumn,
    DxColumnChooser,
    DxSelection,
    DxScrolling,
    DxPager,
    DxPaging,
    DxSearchPanel,
} from 'devextreme-vue/data-grid';

import { locale } from 'devextreme/localization';

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
            modal_sport_id: null,
            ricerca: null,
            errors: null,


            //data
            sport: [],
        };
    },
    computed: {
        disabledElement() {
            return this.fetching;
        },
    },
    async created() {
        locale('it-IT');
        await axios.get('api/sphere/sport').then(response => { this.sport = response.data; }).catch(err => { });
    },
    methods: {
        timezoneFixer(data) {
            return dateAndTimeFormat(data.value);
        },
        dateFixer(data) {
            return dateFormat(data.value);
        },
        sportSalvato(sport) {
            this.sport.push(sport);
            this.$refs.griglia.instance.refresh();
            this.$emit('notify', 'success', 'Sport salvato con successo');
            this.modal_sport_id = null;
        },
        async sportModificato() {
            await axios.get('api/sphere/sport').then(response => { this.sport = response.data; });
            this.$emit('notify', 'success', 'Sport modificato con successo');
            this.modal_sport_id = null;
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
                    onItemClick: () => { this.apriSport(e.row.data.id); },
                },
                {
                    visible: e.rowIndex > -1,
                    text: 'Elimina',
                    icon: 'trash',
                    onItemClick: () => { this.confermaEliminaSport(e.rowIndex); },
                },
                {
                    text: 'Nuovo',
                    icon: 'plus',
                    onItemClick: () => { this.nuovoSport(); },
                },
            ];
        },
        aggiornaRiga(id) {

        },
        onRowDblClick(e) {
            this.apriSport(e.data.id);
        },
        confermaEliminaSport(rowIndex) {
            this.$refs.griglia.instance.option({ 'editing.texts.confirmDeleteMessage': 'Sei sicuro di voler eliminare lo sport selezionato?' });
            this.$refs.griglia.instance.deleteRow(rowIndex);
        },
        deleteSport(e) {
            e.cancel = axios.delete(`api/sphere/sport/${e.data.id}`)
                .then(response => {
                    this.$emit('notify', 'success', 'Sport eliminato');
                    return false;
                })
                .catch(err => {
                    this.$emit('notify', 'error', 'Errore', 'Eliminazione fallita');
                    return true;
                });
        },
        nuovoSport() {
            this.modal_sport_id = 'new';
        },
        apriSport(id) {
            this.modal_sport_id = id;
        },
    },

};
</script>
<style scoped>
/*imposta altezza fissa della griglia dinamicamente ( -64px della toolbar in alto -64px toolbar in basso) */

#griglia.dx-widget {
    height: calc(100vh - 54px) !important;
}
</style>