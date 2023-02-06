<template>
  <TransitionRoot
    as="template"
    :show="open"
  >
    <Dialog
      as="div"
      class="relative z-50"
    >
      <TransitionChild
        as="template"
        enter="ease-out duration-300"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="ease-in duration-200"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
      </TransitionChild>

      <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <TransitionChild
            as="template"
            enter="ease-out duration-300"
            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            enter-to="opacity-100 translate-y-0 sm:scale-100"
            leave="ease-in duration-200"
            leave-from="opacity-100 translate-y-0 sm:scale-100"
            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          >
            <DialogPanel
              class="relative transform rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl sm:p-6"
            >
              <div
                v-if="fetching"
                class="flex justify-center items-center"
              >
                <svg
                  class="animate-spin h-5 w-5 text-gray-900"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <circle
                    class="opacity-25"
                    cx="12"
                    cy="12"
                    r="10"
                    stroke="currentColor"
                    stroke-width="4"
                  ></circle>
                  <path
                    class="opacity-75"
                    fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                  >
                  </path>
                </svg>
              </div>
              <div v-else>
                <DialogTitle
                  as="h3"
                  class="text-lg font-medium leading-6 text-gray-900 text-center"
                >
                  {{ prenotazione.id ? 'Modifica prenotazione medsport (Società sportiva)' : 'Nuova prenotazione medsport (Società sportiva)' }}
                </DialogTitle>
                <div class="flex flex-col gap-3">
                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <!-- data e ora visita -->
                    <div class="flex flex-col gap-1">
                      <div class="relative">
                        <div
                          class="absolute inset-0 flex items-center"
                          aria-hidden="true"
                        >
                          <div class="w-full border-t border-gray-300" />
                        </div>
                        <div class="relative flex justify-center">
                          <span class="bg-white px-2 text-sm text-gray-500">Data e ora
                            prenotazione</span>
                        </div>
                      </div>
                      <DxDateBox
                        v-model:value="prenotazione.data_inizio"
                        :min="now"
                        type="datetime"
                        :is-valid="!errorFor('data_inizio')"
                        label="Data e ora della visita"
                        :disabled="disabledElement"
                      />
                      <DxNumberBox
                        v-model:value="prenotazione.durata"
                        placeholder="Durata visita in minuti"
                        :show-spin-buttons="true"
                        :is-valid="!errorFor('durata')"
                        label="Durata della visita"
                        :disabled="disabledElement"
                      />
                      <DxSelectBox
                        v-model:value="prenotazione.ambulatorio_id"
                        :data-source="ambulatoriPrenotabili"
                        value-expr="id"
                        display-expr="nome"
                        label="Ambulatorio"
                        label-mode="static"
                        placeholder="---"
                        no-data-text="Nessun ambulatorio selezionabile"
                        :disabled="ambulatoriPrenotabili.length === 0 || disabledElement"
                        :drop-down-options="{ maxHeight: '200px' }"
                        :item-template="ambulatorioItemTemplate"
                        :is-valid="!errorFor('ambulatorio_id')"
                      />
                      <DxSelectBox
                        v-model:value="prenotazione.medico_id"
                        :data-source="mediciPrenotabili"
                        value-expr="id"
                        display-expr="ragione_sociale"
                        label="Medico"
                        label-mode="static"
                        placeholder="---"
                        no-data-text="Nessun medico selezionabile"
                        :disabled="mediciPrenotabili.length === 0 || disabledElement"
                        :drop-down-options="{ maxHeight: '200px' }"
                        :item-template="medicoItemTemplate"
                        :is-valid="!errorFor('medico_id')"
                      />
                      <p
                        v-if="!orarioInOrarioMedico && impostazioni.avviso_presenza_orario_medico"
                        class="text-red-500 text-sm"
                      >
                        Medico non disponibile nell'ambulatorio/orario selezionato
                      </p>
                      <!-- atleti e sport -->
                      <div class="relative">
                        <div
                          class="absolute inset-0 flex items-center"
                          aria-hidden="true"
                        >
                          <div class="w-full border-t border-gray-300" />
                        </div>
                        <div class="relative flex justify-center">
                          <span class="bg-white px-2 text-sm text-gray-500">Paziente /
                            Atleta</span>
                        </div>
                      </div>
                      <div class="flex items-center gap-3">
                        <DxButton
                          id="saveButton"
                          width="100%"
                          text="Nuova società"
                          icon="plus"
                          type="normal"
                          styling-mode="contained"
                          :disabled="false"
                          @click="apriModalNuovaSocieta"
                        />
                        <DxButton
                          id="saveButton"
                          width="100%"
                          height="100%"
                          text="Apri società"
                          icon="activefolder"
                          type="normal"
                          styling-mode="contained"
                          :disabled="!prenotazione.societa_id"
                          @click="apriModalModificaSocieta"
                        />
                      </div>

                      <DxSelectBox
                        v-model:value="prenotazione.societa_id"
                        :data-source="societaDataSource"
                        value-expr="id"
                        display-expr="ragione_sociale"
                        :search-enabled="true"
                        :search-timeout="500"
                        label="Società sportiva"
                        label-mode="static"
                        no-data-text="Nessuna società trovata"
                        :disabled="disabledElement"
                        :drop-down-options="{ maxHeight: '200px' }"
                        :on-selection-changed="selezionaSocieta"
                        :is-valid="!errorFor('societa_id')"
                        :open-on-field-click="false"
                        :min-search-length="2"
                      />

                      <DxNumberBox
                        v-model:value="prenotazione.numero_paz"
                        placeholder="1"
                        :show-spin-buttons="true"
                        :is-valid="!errorFor('numero_paz')"
                        label="Numero di atleti"
                        :disabled="disabledElement"
                      />

                      <!-- listino , sport e società -->
                      <div class="relative">
                        <div
                          class="absolute inset-0 flex items-center"
                          aria-hidden="true"
                        >
                          <div class="w-full border-t border-gray-300" />
                        </div>
                        <div class="relative flex justify-center">
                          <span class="bg-white px-2 text-sm text-gray-500">Listino e
                            sport</span>
                        </div>
                      </div>
                      <!-- listino e sport per medicina sportiva -->
                      <DxSelectBox
                        v-model:value="prenotazione.visita.sport_id"
                        label="Sport praticato"
                        :data-source="elenco_sport"
                        value-expr="id"
                        display-expr="nome"
                        :search-enabled="true"
                        :item-template="sportItemTemplate"
                        :is-valid="!errorFor('visita.sport_id')"
                        :disabled="disabledElement"
                        no-data-text="Nessuno sport trovato"
                      />

                      <DxSelectBox
                        v-model:value="prenotazione.visita.listino_id"
                        label="Listino"
                        :data-source="listiniFiltratiPerSport"
                        value-expr="id"
                        display-expr="nome"
                        :item-template="listinoItemTemplate"
                        :is-valid="!errorFor('visita.listino_id')"
                        :disabled="disabledElement"
                        no-data-text="Nessun listino trovato"
                      />
                    </div>

                    <div class="flex flex-col gap-1">
                      <div class="relative">
                        <div
                          class="absolute inset-0 flex items-center"
                          aria-hidden="true"
                        >
                          <div class="w-full border-t border-gray-300" />
                        </div>
                        <div class="relative flex justify-center">
                          <span class="bg-white px-2 text-sm text-gray-500">Qualcosa</span>
                        </div>
                      </div>
                      <!-- dettagli societa -->
                      <div class="relative">
                        <div
                          class="absolute inset-0 flex items-center"
                          aria-hidden="true"
                        >
                          <div class="w-full border-t border-gray-300" />
                        </div>
                        <div class="relative flex justify-center">
                          <span class="bg-white px-2 text-sm text-gray-500">Dettagli Società
                            sportiva</span>
                        </div>
                      </div>
                      <div
                        v-if="!prenotazione.societa_sportiva"
                        class="flex justify-center items-center h-full"
                      >
                        Nessuna società selezionata
                      </div>
                      <div v-else>
                        <div class="flex justify-between  pt-1">
                          <span class="text-sm text-gray-500">Ragione sociale: </span>
                          <span class="text-sm font-medium text-gray-900 capitalize">{{ prenotazione.societa_sportiva.ragione_sociale }}</span>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="relative">
                    <div
                      class="absolute inset-0 flex items-center"
                      aria-hidden="true"
                    >
                      <div class="w-full border-t border-gray-300" />
                    </div>
                    <div class="relative flex justify-center">
                      <span class="bg-white px-2 text-sm text-gray-500">Altro</span>
                    </div>
                  </div>

                  <div class="grid grid-cols-1 pt-4">
                    <DxTextArea
                      v-model:value="prenotazione.note"
                      placeholder="Note prenotazione"
                      :spellcheck="false"
                    />
                  </div>
                </div>

                <div class="mt-5 sm:mt-6 flex flex-col sm:flex-row sm:justify-around gap-4">
                  <DxButton
                    width="100%"
                    text="Chiudi"
                    type="danger"
                    icon="close"
                    styling-mode="contained"
                    :disabled="saving"
                    @click="$emit('close')"
                  />
                  <DxButton
                    id="saveButton"
                    width="100%"
                    :text="saving ? 'Salvataggio...' : disabledElement ? 'Prenotazione già accettata' : 'Salva prenotazione'"
                    icon="save"
                    type="success"
                    styling-mode="contained"
                    :disabled="disabledElement || saving"
                    @click="salvaPrenotazione()"
                  />
                </div>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
      <button class="opacity-0 absolute bottom-0"></button>
      <!-- previene warning per mancanza di focus , magari sostituire i bottoni di Devexpress con quelli base -->
      <AlertErrors
        v-if="errors"
        :errors="errors"
      />
      <ModalSocietaSportiva
        v-if="modal_societa_id"
        :societa-id="modal_societa_id"
        @close="modal_societa_id = null"
        @store="societaSalvata"
        @update="societaModificata"
      />
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { dateFormat, dateAndTimeFormat } from '../../../utilities/dateUtilities';

import ModalSocietaSportiva from './ModalSocietaSportiva.vue';

import DxButton from 'devextreme-vue/button';
import { DxSelectBox } from 'devextreme-vue/select-box';
import DxDateBox from 'devextreme-vue/date-box';
import DxNumberBox from 'devextreme-vue/number-box';
import DxRadioGroup from 'devextreme-vue/radio-group';
import { DxTextArea } from 'devextreme-vue/text-area';

import DataSource from 'devextreme/data/data_source';
import CustomStore from 'devextreme/data/custom_store';
import { is422 } from '../../../utilities/response';



const societaDataSource = new DataSource({
    store: new CustomStore({
        key: 'id',
        useDefaultSearch: false,
        load(loadOptions) {
            if (loadOptions.searchValue) {
                return axios.get(`api/sphere/ricerca-societa/${loadOptions.searchValue}`).then(response => response.data).catch(err => { throw new Error('Errore caricamento'); });
            }
        },
        byKey: (key) => {
            return axios.get(`api/sphere/societa-sportiva/${key}`).then(response => response.data).catch(err => { throw new Error('Errore caricamento località'); });
        },
        errorHandler: (error) => {
            console.log(error.message);
        },
    }),
});

</script>

<script>

export default {
    props: [
        'appointmentData',
        'impostazioni',
    ],
    emits: ['update', 'store', 'close'],
    data() {
        return {
            fetching: false,
            saving: false,
            errors: null,
            now: dayjs().format('YYYY-MM-DD HH:mm'),


            struttura: [],
            prenotazione: [],
            societa: null,
            listini: [],
            colori: [],
            elenco_sport: [],
            modal_societa_id: null,
        };
    },
    computed:
    {
        disabledElement() {
            return this.prenotazione.accettata || this.saving;
        },
        open() {
            return this.appointmentData !== null;
        },
        sezioneVisita() {
            return this.prenotazione.sezione_visita;
        },
        ambulatoriPrenotabili() {
            return this.struttura.ambulatori;
        },
        mediciPrenotabili() {
            let array = [];
            this.impostazioni.limita_medici_con_orario_medico
                ? this.struttura.orari_medici.forEach(orario => {
                    if (dayjs(this.prenotazione.data_inizio, 'YYYY-MM-DD').isSame(orario.data_inizio, 'day') && orario.ambulatorio_id == this.prenotazione.ambulatorio_id) {
                        array.push(this.medici.find(medico => medico.id == orario.medico_id));
                    }
                })
                : array = this.medici;

            let unique = [...new Set(array.map(item => item))];
            return unique;
        },
        listiniFiltratiPerSport() {
            let array = this.prenotazione.visita.sport_id && this.prenotazione.visita.sport_id != 0
                ? this.listini.filter(listino => { return listino.tipo_visita == this.elenco_sport.find(sport => { return sport.id === this.prenotazione.visita.sport_id; }).tipo_visita; })
                : this.listini;

            this.prenotazione.visita.listino_id = this.prenotazione.visita.sport_id ? array[0]?.id : null;
            return array;
        },
        orarioInOrarioMedico() {
            return this.struttura.orari_medici.find(orario => { return dayjs(this.prenotazione.data_inizio).isBetween(orario.data_inizio, orario.data_fine, null, '[]') && orario.ambulatorio_id == this.prenotazione.ambulatorio_id && orario.medico_id == this.prenotazione.medico_id; });
        },

    },
    watch: {
        'prenotazione.ambulatorio_id': {
            handler(newValue, oldValue) {
                if (oldValue && oldValue !== newValue) this.prenotazione.medico_id = null;
            },
        },
    },

    async created() {
        if (this.appointmentData.id) {
            this.fetching = true;
            await axios.get(`api/sphere/prenotazione/${this.appointmentData.id}/edit`)
                .then(response => {
                    this.prenotazione = response.data.prenotazione;
                    this.prenotazione.durata = dayjs(response.data.prenotazione.data_fine).diff(response.data.prenotazione.data_inizio, 'minute');
                    this.colori = response.data.colori;
                    this.elenco_sport = response.data.elenco_sport;
                    this.struttura = response.data.struttura;
                    this.listini = response.data.listini;
                    this.medici = response.data.medici;
                })
                .catch(
                    err => {
                        this.fetching = false;
                        this.$emit('close');
                    });
            this.fetching = false;
        }
        else {
            this.fetching = true;
            await axios.post('api/sphere/prenotazione/create', this.appointmentData)
                .then(response => {
                    this.prenotazione = response.data.prenotazione;
                    this.prenotazione.durata = dayjs(response.data.prenotazione.data_fine).diff(response.data.prenotazione.data_inizio, 'minute');
                    this.prenotazione.numero_paz = 1;
                    this.struttura = response.data.struttura;
                    this.listini = response.data.listini;
                    this.colori = response.data.colori;
                    this.elenco_sport = response.data.elenco_sport;
                    this.medici = response.data.medici;
                })
                .catch(
                    err => {
                        this.fetching = false;
                        this.$emit('close');
                    });
            this.fetching = false;
        }
    },
    methods: {        
        apriModalModificaSocieta() {
            this.modal_societa_id = this.prenotazione.societa_id;
        },
        apriModalNuovaSocieta() {
            this.modal_societa_id = 'new';
        },
        societaSalvata(societa) {
            this.prenotazione.societa_id = societa.id;
            this.prenotazione.societa_sportiva = societa;
            this.modal_societa_id = null;
        },
        societaModificata(societa) {
            this.prenotazione.societa_id = societa.id;
            this.prenotazione.societa_sportiva = societa;
            this.modal_societa_id = null;
        },
        selezionaSocieta(e) {
            this.prenotazione.societa_sportiva = e.selectedItem;
        },
        formatDataNascita(date) {
            return dayjs(date).format('DD/MM/YYYY');
        },
        errorFor(field) {
            return null !== this.errors && this.errors[field]
                ? true
                : false;
        },
        societaItemTemplate(data) {
            return '<div class="flex justify-between"><span class="truncate">' + data.ragione_sociale + '</span></div>';
        },
        ambulatorioItemTemplate(data) {
            return '<div class="flex justify-between"><span class="truncate">' + data.nome + '</span></div>';
        },
        medicoItemTemplate(data) {
            return '<div class="flex justify-between"><span class="truncate">' + data.ragione_sociale + '</span></div>';
        },
        sportItemTemplate(data) {
            return '<div class="flex justify-between"><span class="uppercase truncate">' + data.nome + '</span><span>' + data.tipo_visita + '</span></div>';
        },
        listinoItemTemplate(data) {
            return '<div class="flex justify-between"><span class="truncate">' + data.nome + '</span><span>' + data.codice + '</span></div>';
        },
        coloriTemplate(data) {
            return '<div class="flex capitalize font-bold text-[' + data.codice + ']">' + data.nome + '</div>';
        },

        
        salvaPrenotazione() {
            if (this.prenotazione.id) {
                this.update();
            }
            else {
                this.store();
            }
        },
        async update() {
            this.saving = true;
            this.errors = null;
            await axios.put(`api/sphere/prenotazione/${this.prenotazione.id}`, this.prenotazione)
                .then(response => {
                    this.$emit('update', response.data);
                }).catch(err => {
                    if (is422(err)) this.errors = err.response.data.errors;
                    this.saving = false;
                });
            this.saving = false;
        },
        async store() {
            this.errors = null;
            this.saving = true;
            await axios.post('api/sphere/prenotazione', this.prenotazione).then(response => {
                this.$emit('store', response.data);
            }).catch(err => {
                if (is422(err)) this.errors = err.response.data.errors;
                this.saving = false;
            });
            this.saving = false;
        },
        calcolaAnni(date) {
            const dn = dayjs(date);

            return dayjs().diff(dn, 'year');
        },
    },
};

</script>

