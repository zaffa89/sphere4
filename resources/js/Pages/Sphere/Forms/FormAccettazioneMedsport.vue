<template>
  <div>
    <DxDataGrid
      id="griglia"
      ref="griglia"
      :data-source="visite"
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
      @row-removing="eliminaVisita"
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
        caption="Società sportiva"
        :customize-text="defaultSocietaText"
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
        data-field="listino.nome"
        caption="Listino"
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
    
    <ModalSchedaMedsport
      v-if="modal_visita_id"
      :visita-id="modal_visita_id"
      @close="modal_visita_id = null"      
      @update="visitaModificata"
    />
    
    <ModalPrenotazioneMedsport
      v-if="modal_nuova_visita?.sezione_visita == 'M'"
      :appointment-data="modal_nuova_visita"
      @close="modal_nuova_visita = {}"
      @store="aggiungiVisita"      
    />

    <ModalPrenotazioneMedsportSocieta
      v-if="modal_nuova_visita?.sezione_visita == 'SM'"
      :appointment-data="modal_nuova_visita"
      @close="modal_nuova_visita = {}"
      @store="aggiungiVisita"      
    />
  </div>
</template>
  
<script setup>
import ModalSchedaMedsport from '@modals/Accettazioni/ModalSchedaMedsport.vue';
import ModalPrenotazioneMedsport from '@modals/Calendario/ModalPrenotazioneMedsport.vue';
import ModalPrenotazioneMedsportSocieta from '@modals/Calendario/ModalPrenotazioneMedsportSocieta.vue';
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

import { dateFormat, dateAndTimeFormat } from '@utilities/dateUtilities';
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
            modal_nuova_visita: null,
            ricerca: null,
            errors: null,


            //data
            visite: [],

            data_inizio_ricerca: dayjs().format('YYYY-MM-DD'),
            data_fine_ricerca: dayjs().format('YYYY-MM-DD')
        };
    },
    computed: {
        disabledElement() {
            return this.fetching;
        },
    },
    async created() {
        locale('it-IT');
        this.caricaAccettazioni();
    },
    methods: {
        async caricaAccettazioni() {
            await axios.post('api/sphere/medsport/accettazione', {
                data_inizio: this.data_inizio_ricerca,
                data_fine: this.data_fine_ricerca,               
            }).then(response => { this.visite = response.data; });
        },
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
        visitaCreata(data) {
            this.visite.push(data);
            this.$refs.griglia.instance.refresh();
            this.$emit('notify', 'success', 'Visita creata con successo');
            this.modal_visita_id = null;
        },
        async visitaModificata(data) {
            //await axios.get('api/sphere/paziente').then(response => { this.pazienti = response.data; });
            this.$emit('notify', 'success', 'Visita modificata con successo');
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
                    onItemClick: () => { this.apriVisita(e.row.data.id); },
                },
                {
                    visible: e.rowIndex > -1,
                    text: 'Elimina',
                    icon: 'trash',
                    onItemClick: () => { this.confermaEliminazioneVisita(e.rowIndex); },
                },
                {
                    text: 'Nuova accettazione',
                    icon: 'plus',
                    onItemClick: () => { this.nuovaVisitaSingola(); },
                },
                {
                    text: 'Nuova accettazione per Società sportiva',
                    icon: 'plus',
                    onItemClick: () => { this.nuovaVisitaSocieta(); },
                },
            ];
        },
        aggiornaRiga(id) {

        },
        onRowDblClick(e) {
            this.apriVisita(e.data.id);
        },
        confermaEliminazioneVisita(rowIndex) {
            this.$refs.griglia.instance.option({ 'editing.texts.confirmDeleteMessage': 'Sei sicuro di voler eliminare questa visita?' });
            this.$refs.griglia.instance.deleteRow(rowIndex);
        },
        eliminaVisita(e) {
            e.cancel = axios.delete(`api/sphere/medsport/visita-medsport/${e.data.id}`)
                .then(response => {
                    this.$emit('notify', 'success', 'Visita eliminata');
                    return false;
                })
                .catch(err => {
                    this.$emit('notify', 'error', 'Errore', 'Eliminazione fallita');
                    return true;
                });
        },
        nuovaVisitaSingola() {
            this.modal_nuova_visita = {
                                sezione_visita : 'M',
                                data_inizio : dayjs().format('YYYY-MM-DD HH:mm'),
                                data_fine : dayjs().format('YYYY-MM-DD HH:mm'),
                                ambulatorio_id : null,
                                medico_id : null,
                                struttura_id : 1,
                                nascosta: true
                            };
        },
        nuovaVisitaSocieta() {
            this.modal_nuova_visita = {
                sezione_visita : 'SM',
                data_inizio : dayjs().format('YYYY-MM-DD HH:mm'),
                data_fine : dayjs().format('YYYY-MM-DD HH:mm'),
                ambulatorio_id : null,
                medico_id : null,
                struttura_id : 1,
                nascosta: true
            }
        },
        aggiungiVisita(data) {
            this.caricaAccettazioni()
            this.modal_nuova_visita = {}
        },
        apriVisita(id) {
            this.modal_visita_id = id;
        },
        async ricercaPaziente() {
            this.fetching = true;
            await axios.post('api/sphere/ricerca-paziente', { ricerca: this.ricerca }).then(response => {
                this.visite = response.data;
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