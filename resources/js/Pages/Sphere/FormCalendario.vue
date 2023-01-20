<template>
  <div>
    <div class="h-14 bg-gray-100 z-50 flex items-center px-3">
      <div
        class="flex space-x-4"
        aria-label="Tabs"
      >
        <button
          v-for="struttura in strutture"
          :key="struttura.id"
          :class="[struttura.id === strutturaSelezionataId ? 'bg-gray-200 text-gray-800' : 'text-gray-600 hover:text-gray-800', 'px-3 py-2 font-medium text-sm rounded-md']"
          @click="selezionaStruttura(struttura.id)"
        >
          {{ struttura.nome }}
        </button>
      </div>
    </div>
    <div class="flex w-full bg-gray-100 h-14 border-y items-center justify-between px-3">
      <div>
        <button
          :disabled="caricamentoCalendario"
          type="button"
          class="mr-3 inline-flex items-center rounded border border-gray-300 bg-white p-2 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
          @click="caricaCalendario"
        >
          <ArrowPathIcon
            class="h-5 w-5"
            :class="[caricamentoCalendario ? 'animate-spin' : '']"
            aria-hidden="true"
          /> Aggiorna
        </button>
        <button
          :disabled="caricamentoCalendario"
          type="button"
          class="mr-3 inline-flex items-center rounded border border-gray-300 bg-white p-2 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
          @click="toggleSidebar()"
        >
          <EyeIcon
            v-if="!sidebarOpen"
            class="h-5 w-5"
            aria-hidden="true"
          />
          <EyeSlashIcon
            v-if="sidebarOpen"
            class="h-5 w-5"
            aria-hidden="true"
          />
        </button>
      </div>

      <div>
        <button
          type="button"
          class="w-full border rounded inline-flex items-center  bg-white p-2 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
          @click="openModalImpostazioni = true"
        >
          <CogIcon
            class="h-5 w-5"
            aria-hidden="true"
          />
          Impostazioni
        </button>
      </div>
    </div>
    <div
      v-if="prenotazioni.length > 0"
      id="calendario"
      class="flex"
    >
      <div
        class="lg:inset-y-0 lg:flex lg:w-80 lg:flex-col hidden"
        :class="{ 'lg:hidden': !sidebarOpen }"
      >
        <div class="flex flex-grow flex-col overflow-y-auto border-r border-gray-200 bg-white pt-5 pb-4 px-4">
          <div class="flex-none">
            <div class="flex flex-col items-left">
              <h1 class="text-xl font-semibold text-gray-900">Calendario prenotazioni</h1>
              <p class="mt-2 text-sm text-gray-700">Maschera di ricerca.</p>
            </div>
            <div class="mt-5 flex flex-grow flex-col">
              <DxCalendar v-model:value="currentDate"></DxCalendar>
            </div>
          </div>
        </div>
      </div>

      <div class="flex flex-1 flex-col overflow-x-auto">
        <DxScheduler
          v-if="strutturaSelezionataId"
          id="scheduler"
          ref="schedulerRef"
          v-model:current-view="currentView"
          :data-source="prenotazioni"
          :current-date="currentDate"
          :adaptivity-enabled="true"
          :shade-until-current-time="true"
          :start-day-hour="parseInt(oraInizioCalendario)"
          :end-day-hour="parseInt(oraFineCalendario)"
          :cross-scrolling-enabled="true"
          text-expr="text"
          start-date-expr="data_inizio"
          end-date-expr="data_fine"
          :groups="groups"
          :on-appointment-dbl-click="doppioClickAppuntamento"
          :on-appointment-deleting="deletePrenotazione"
          :on-appointment-updating="spostaPrenotazione"
          :on-appointment-context-menu="onAppointmentContextMenu"
          :on-cell-context-menu="onCellContextMenu"
          :on-option-changed="onOptionChanged"
          :on-appointment-form-opening="cancelEvent"
          :on-appointment-tooltip-showing="cancelEvent"
          :show-current-time-indicator="false"
          :data-cell-template="dataCellTemplate"
          appointment-template="AppointmentTemplateSlot"
          :on-appointment-rendered="coloraAppuntamento"
          :time-cell-template="timeCellTemplate"
        >
          <!-- Configuration goes here -->
          <!-- template appuntamento -->
          <template #AppointmentTemplateSlot="{ data }">
            <div class="flex flex-col">
              <div class="w-full px-1">
                <!--
                        <span class="text-xs">
                            {{ timeFormat(data.targetedAppointmentData.data_inizio) }} - {{ timeFormat(data.targetedAppointmentData.data_fine) }}                        
                        </span>
                    -->
                <span>                       
                  {{ data.targetedAppointmentData.text }}                        
                </span>
              </div>
              <div
                v-if="data.targetedAppointmentData.note"
                class="truncate"
              >
                {{ data.targetedAppointmentData.note }}
              </div>
            </div>
          </template>
          <!-- views -->
          <DxView
            :cell-duration="durataCella"
            :interval-count="1"
            
            type="day"
            name="Giorno"
          />
          <DxView
            :cell-duration="durataCella"
            :interval-count="1"
            type="week"
            name="Settimana"
          />

          <DxView
            type="month"
            name="Mese"
            :data-cell-template="monthCellTemplate"
          />

          <!-- resources = Ambulatori -->
          <DxResource
            :allow-multiple="false"
            :data-source="ambulatoriStruttura"
            field-expr="ambulatorio_id"
            label="Ambulatorio"
            display-expr="nome"
          />
        </DxScheduler>
      </div>
    </div>

    <DxContextMenu
      :items="contextMenuItems"
      :width="200"
      :target="menuTarget"
      :on-item-click="onContextMenuItemClick"
    >
    </DxContextMenu>

    <ModalPrenotazioneMedsport
      v-if="modalData?.sezione_visita == 'M'"
      :appointment-data="modalData"
      :impostazioni="impostazioni"
      @close="chiudiAppuntamento"
      @store="addPrenotazione"
      @update="updatePrenotazione"
    />

    <ModalPrenotazioneMedsportSocieta
      v-if="modalData?.sezione_visita == 'SM'"
      :appointment-data="modalData"
      :impostazioni="impostazioni"
      @close="chiudiAppuntamento"
      @store="addPrenotazione"
      @update="updatePrenotazione"
    />

    <ModalPrenotazioneAmbulatoriale
      v-if="modalData?.sezione_visita == 'A'"
      :appointment-data="modalData"
      :impostazioni="impostazioni"
      @close="chiudiAppuntamento"
      @store="addPrenotazione"
      @update="updatePrenotazione"
    />

    <ModalNotaCalendario
      v-if="modalData?.sezione_visita == 'N'"
      :appointment-data="modalData"
      @close="chiudiAppuntamento"
      @store="addPrenotazione"
      @update="updatePrenotazione"
    />

    <ModalAssenzaCalendario
      v-if="modalData?.sezione_visita == 'X'"
      :appointment-data="modalData"
      @close="chiudiAppuntamento"
      @store="addPrenotazione"
      @update="updatePrenotazione"
    />

    <ModalImpostazioniCalendario
      v-if="openModalImpostazioni"
      v-model:durata-cella="durataCella"
      v-model:oraInizioCalendario="oraInizioCalendario"
      v-model:oraFineCalendario="oraFineCalendario"
      @close="openModalImpostazioni = false"
    />

    <ModalConfermaEliminazione
      v-if="prenotazioneDaEliminare"
      @close="prenotazioneDaEliminare = null"
      @delete="confermaEliminazionePrenotazione"
    />
  </div>
</template>

<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
//import 'devextreme/dist/css/dx.light.css';
import { locale } from 'devextreme/localization';

import { DxScheduler, DxView, DxResource } from 'devextreme-vue/scheduler';
import DxContextMenu from 'devextreme-vue/context-menu';
import DxCalendar from 'devextreme-vue/calendar';

import { CogIcon, ArrowPathIcon, EyeIcon, EyeSlashIcon } from '@heroicons/vue/24/outline';

import ModalPrenotazioneMedsport from './Modals/ModalPrenotazioneMedsport.vue';
import ModalPrenotazioneAmbulatoriale from './Modals/ModalPrenotazioneAmbulatoriale.vue';
import ModalPrenotazioneMedsportSocieta from './Modals/ModalPrenotazioneMedsportSocieta.vue';

import ModalNotaCalendario from './Modals/ModalNotaCalendario.vue';
import ModalAssenzaCalendario from './Modals/ModalAssenzaCalendario.vue';

import ModalImpostazioniCalendario from './Modals/ModalImpostazioniCalendario.vue';
import ModalConfermaEliminazione from './Modals/ModalConfermaEliminazione.vue';

import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { ChevronDownIcon } from '@heroicons/vue/20/solid';

import Pusher from 'pusher-js';

import { nextTick } from 'vue';
import { timeFormat } from '../../utilities/dateUtilities';
import dayjs from 'dayjs';


</script>

<script>
//per context menu
const appointmentClassName = '.dx-scheduler-appointment';
const cellClassName = '.dx-scheduler-date-table-cell';

export default {
    //layout: AppLayout,
    data() {
        return {
            componente: null,
            //dati calendario e prenotazioni
            strutturaSelezionataId: null,
            groups: ['ambulatorio_id'],
            prenotazioni: [],
            ambulatori: [],
            strutture: [],

            //form prenotazione
            prenotazioneAperta: null,

            //context menu
            menuTarget: appointmentClassName,
            contextMenuItems: [],
            selectedCellData: [],

            orari_di_oggi: [],
            //impostazioni
            impostazioni: [], // da spostare in global
            currentDate: dayjs().format('YYYY-MM-DD'),
            currentView: 'day',

            durataCella: 15,
            oraInizioCalendario: 8,
            oraFineCalendario: 22,
            prenotaFuoriOrario: false,                     

            //flags
            openModalImpostazioni: false,
            prenotazioneDaEliminare: null,
            caricamentoCalendario: false,

            modalData: null,   

            broadcast: false,
            sidebarOpen: true
        };
    },
    computed: {
        /* 
        scheduler() {
            return this.$refs.schedulerRef.instance
        },
        */
        strutturaSelezionata() {
            return this.strutture.find(s => s.id === this.strutturaSelezionataId);
        },
        ambulatoriStruttura() {
            return this.strutture.find(s => s.id === this.strutturaSelezionataId).ambulatori;
        },
        isDayView() {
            return this.currentView === 'day';
        },
    },
    created() {
        locale('it-IT');
        this.caricaCalendario();
        //this.selezionaStruttura(1)

        var pusher = new Pusher('a90f0bb38b5492dcc9d1', { cluster: 'eu' });
        var channel = pusher.subscribe('calendario');

        channel.bind('prenotazione.store', (data) => {
            if (data.client_uuid !== localStorage.getItem('client_uuid')) {
                this.broadcast = true;
                this.$refs.schedulerRef.instance.addAppointment(data.prenotazione);
                this.$emit('notify', 'success', 'Prenotazione creata', 'è stata aggiunta la prenotazione con ID:' + data.prenotazione.id);
            }
        });

        channel.bind('prenotazione.update', (data) => {

            if (data.client_uuid !== localStorage.getItem('client_uuid')) {
                this.broadcast = true;
                this.$refs.schedulerRef.instance.updateAppointment(this.prenotazioni[this.prenotazioni.findIndex(element => element.id === data.prenotazione.id)], data.prenotazione);
                this.$emit('notify', 'success', 'Prenotazione modificata', 'è stata modificata la prenotazione con ID:' + data.prenotazione.id);
            }
        });

        channel.bind('prenotazione.delete', (data) => {
         
            if (data.client_uuid !== localStorage.getItem('client_uuid')) {
                this.broadcast = true;
                this.$refs.schedulerRef.instance.deleteAppointment(this.prenotazioni[this.prenotazioni.findIndex(element => element.id === data.prenotazione.id)]);
                this.$emit('notify', 'error', 'Prenotazione eliminata', 'è stata eliminata la prenotazione con ID:' + data.prenotazione.id);
            }
        });


    },
    methods: {
        async toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
            await nextTick();
            this.$refs.schedulerRef.instance.repaint();
        },
        coloraAppuntamento(e) {
            e.appointmentElement.style.backgroundColor = e.appointmentData.colore;
        },
        async caricaCalendario() {
            this.caricamentoCalendario = true;

            await axios.get('api/sphere/calendario/carica').then(response => {
                this.prenotazioni = response.data.prenotazioni;
                this.strutture = response.data.strutture;

                this.impostazioni = response.data.impostazioni;
                this.selezionaStruttura(1);
                this.orari_di_oggi = this.strutturaSelezionata.orari_medici.filter(orario => dayjs(orario.data_inizio).isSame(dayjs() , 'day'));
            }).catch(err => { });

            this.caricamentoCalendario = false;
        },
        monthCellTemplate(cellData) {
            return '<div class="text-black p-1">' + cellData.text + '</div>';
        },
        timeCellTemplate(cellData) {
            return dayjs(cellData.date).minute() === 0 
                ? '<div class="font-medium">' + dayjs(cellData.date).format('HH:mm') + '</div>'
                : '<div>' + dayjs(cellData.date).format('mm') + '</div>';
        },
        /*
        appointmentTemplate(data) {            
            return '<div class="flex flex-col"><div class="appointmentContainer flex flex-row items-center"><span class="text-xs">' + dayjs(data.targetedAppointmentData.data_inizio).format('HH:mm') + ' - ' + dayjs(data.targetedAppointmentData.data_fine).format('HH:mm') + '</span><span>&nbsp;| ' + data.targetedAppointmentData.text + '</span></div><div class="truncate">'+ data.targetedAppointmentData.note +'</div></div>';
        },
        */
        dataCellTemplate(data) {
            return this.orari_di_oggi.find(orario => { return dayjs(data.startDate).isBetween(orario.data_inizio, dayjs(orario.data_fine).subtract(1, 'minute'), 'm', '[]') && orario.ambulatorio_id == data.groups.ambulatorio_id; })
                ? '<div class="h-full bg-blue-500/30"></div>'
                : '';
        },
        calendarCellTemplate(data) {
            return this.strutturaSelezionata.orari_medici.find(orario => { return dayjs(orario.data_inizio).isSame(data.date, 'day'); })
                ? '<span class="text-blue-500">' + data.text + '</span>'
                : '<span>' + data.text + '</span>';
        },
        cancelEvent(e) {
            e.cancel = true;
        },
        selezionaStruttura(id) {
            this.strutturaSelezionataId = id;
        },        
        apriAppuntamento(data)
        {
            this.modalData = data;
        },
        doppioClickAppuntamento(e) {
            this.apriAppuntamento(e.appointmentData);
        },
        chiudiAppuntamento() {
            this.modalData = null;
        },

        updatePrenotazione(e) {
            this.broadcast = true;
            this.$refs.schedulerRef.instance.updateAppointment(this.prenotazioni[this.prenotazioni.findIndex(element => element.id === e.id)], e);
            this.modalData = null;
        
        },
        spostaPrenotazione(e) {
            if (e.newData.accettata === 'S') { e.cancel = true; }
            else {
                if (this.broadcast) { this.broadcast = false; }
                else {
                    e.newData.data_inizio = dayjs(e.newData.data_inizio).format('YYYY-MM-DD HH:mm:ss');
                    e.newData.data_fine = dayjs(e.newData.data_fine).format('YYYY-MM-DD HH:mm:ss');
                    const medico_id = this.strutturaSelezionata.orari_medici.find(orario => { return dayjs(e.newData.data_inizio).isBetween(orario.data_inizio, orario.data_fine, null, '[]') && orario.ambulatorio_id == e.newData.ambulatorio_id; })?.medico_id ?? parseInt(this.impostazioni.medico_default_fuori_orario) ?? null;

                    e.cancel = axios.put(`api/sphere/calendario/sposta-prenotazione/${e.newData.id}`, { ...e.newData, medico_id }).then(() => { return false; }).catch(() => { return true; });
                }
            }
        },
        showPopupDelete(appointmentData) {
            this.prenotazioneDaEliminare = appointmentData;
        },
        confermaEliminazionePrenotazione() {
            this.broadcast = false;
            this.$refs.schedulerRef.instance.deleteAppointment(this.prenotazioneDaEliminare);
        },
        deletePrenotazione(e) {
            if (!this.broadcast) {
                return e.cancel = axios.delete(`api/sphere/prenotazione/${e.appointmentData.id}`).then(() => {
                    this.prenotazioneDaEliminare = null;
                    return false;

                }).catch(() => {
                    this.prenotazioneDaEliminare = null;
                    return true;
                });
            }
        },
        addPrenotazione(data) {       
            this.$refs.schedulerRef.instance.addAppointment(data);
            this.modalData = null;
        },
        onAppointmentContextMenu({ appointmentData, targetedAppointmentData }) {
            this.menuTarget = appointmentClassName;
            this.disabled = false;
            this.contextMenuItems = [
                {
                    text: 'Apri prenotazione',
                    onItemClick: () => this.apriAppuntamento(appointmentData),
                },
                {
                    text: 'Elimina prenotazione',
                    onItemClick: () => this.showPopupDelete(appointmentData),   //aggiungere popup                  
                },
            ];
        },
        onCellContextMenu({ cellData }) {
            this.menuTarget = cellClassName;
            this.disabled = false;

            const data_inizio = dayjs(this.isSelectedCell(cellData) ? this.selectedCellData[0].startDate : cellData.startDate).format('YYYY-MM-DD HH:mm:ss');
            const data_fine = dayjs(this.isSelectedCell(cellData) ? this.selectedCellData[this.selectedCellData.length - 1].endDate : cellData.endDate).format('YYYY-MM-DD HH:mm:ss');
            const ambulatorio_id = this.isSelectedCell(cellData) ? this.selectedCellData[0].groups.ambulatorio_id : cellData.groups.ambulatorio_id;
            const medico_id = this.strutturaSelezionata.orari_medici.find(orario => { return dayjs(data_inizio).isBetween(orario.data_inizio, orario.data_fine, null, '[]') && orario.ambulatorio_id == ambulatorio_id; })?.medico_id ?? parseInt(this.impostazioni.medico_default_fuori_orario) ?? null;
            const struttura_id = this.strutturaSelezionataId;

            this.contextMenuItems = [
                { text: 'Nuova Prenotazione', beginGroup: true, disabled: true },
                {
                    text: 'Medsport',
                    visible: this.impostazioni.medsport,
                    onItemClick: () => {
                        this.apriAppuntamento(
                            {
                                sezione_visita: 'M',
                                data_inizio,
                                data_fine,
                                ambulatorio_id,
                                medico_id,
                                struttura_id,                                                    
                            },
                        );
                    },
                },
                {
                    text: 'Medsport - Società Sportiva',
                    visible: this.impostazioni.medsport,
                    onItemClick: () => {
                        this.apriAppuntamento(
                            {
                                sezione_visita: 'SM',
                                data_inizio,
                                data_fine,
                                ambulatorio_id,
                                medico_id,
                                struttura_id,                     
                            },
                        );
                    },
                },
                {
                    text: 'Ambulatoriale',
                    visible: this.impostazioni.ambulatoriale,
                    onItemClick: () => {
                        this.apriAppuntamento(
                            {
                                sezione_visita: 'A',
                                data_inizio,
                                data_fine,
                                ambulatorio_id,
                                medico_id,
                                struttura_id,                
                            },
                        );
                    },
                },
                { 
                    text: 'Altro', 
                    beginGroup: true, 
                    disabled: true, 
                },
                {
                    text: 'Nota',
                    disabled: false,
                    onItemClick: () => {
                        this.apriAppuntamento(
                            {                 
                                sezione_visita: 'N',
                                data_inizio,
                                data_fine,
                                ambulatorio_id,
                                struttura_id,
                            },
                        );
                    },
                },
                {
                    text: 'Assenza',
                    disabled: false,
                    onItemClick: () => {
                        this.apriAppuntamento(
                            {
                                sezione_visita: 'X',
                                data_inizio,
                                data_fine,
                                ambulatorio_id,
                                struttura_id,           
                            },
                        );
                    },
                },
            ];
        },
        onContextMenuItemClick(e) {
            e.itemData.onItemClick(e);
        },
        isSelectedCell(cellData) {
            return this.selectedCellData.length ?
                this.selectedCellData.filter((cell) => {
                    return cell.startDate == cellData.startDate && cellData.groups.ambulatorio_id === cell.groups.ambulatorio_id;
                }).length > 0 : false;
        },
        onOptionChanged({ name, value }) {
            if (name === 'selectedCellData') {
                this.selectedCellData = value;
            }

            if (name === 'currentDate') {
                this.currentDate = value;

                this.orari_di_oggi = this.strutturaSelezionata.orari_medici.filter(orario => dayjs(orario.data_inizio).isSame(dayjs(value) , 'day'));
            }
        },
    },
};

</script>