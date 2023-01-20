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
                  {{ paziente.id ? 'Anagrafica paziente: ' + paziente.ragione_sociale : 'Nuovo paziente' }}
                </DialogTitle>
                <div class="flex flex-col gap-1">
                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="flex flex-col gap-1">
                      <div class="relative">
                        <div
                          class="absolute inset-0 flex items-center"
                          aria-hidden="true"
                        >
                          <div class="w-full border-t border-gray-300" />
                        </div>
                        <div class="relative flex justify-center">
                          <span class="bg-white px-2 text-sm text-gray-500">Dati
                            anagrafici</span>
                        </div>
                      </div>
                      <DxTextBox
                        v-model:value="paziente.cognome"
                        label="Cognome"
                        label-mode="floating"
                        placeholder="Cognome"
                        :show-clear-button="true"
                        :is-valid="!errorFor('cognome')"
                        :disabled="disabledElement"
                      />
                      <DxTextBox
                        v-model:value="paziente.nome"
                        label="Nome"
                        label-mode="floating"
                        placeholder="Nome"
                        :show-clear-button="true"
                        :is-valid="!errorFor('nome')"
                        :disabled="disabledElement"
                      />
                      <div
                        class="flex justify-between border border-gray-300 rounded px-[9px] py-1 mt-1 items-center"
                      >
                        <span class="text-gray-400 font-light">Sesso</span>
                        <DxRadioGroup
                          v-model:value="paziente.sesso"
                          :items="['M', 'F']"
                          layout="horizontal"
                          :is-valid="!errorFor('sesso')"
                          :disabled="disabledElement"
                        />
                      </div>

                      <DxDateBox
                        v-model:value="paziente.data_nascita"
                        placeholder="gg/mm/aaaa"
                        :show-clear-button="true"
                        :use-mask-behavior="true"
                        :display-format="'dd/MM/yyyy'"
                        date-serialization-format="yyyy-MM-dd"
                        type="date"
                        :is-valid="!errorFor('data_nascita')"
                        label="Data di nascita"
                        :disabled="disabledElement"
                      />

                      <DxSelectBox
                        v-model:value="paziente.localita_nascita_id"
                        :data-source="localitaDataSource"
                        value-expr="id"
                        display-expr="nome"
                        :search-enabled="true"
                        :search-timeout="500"
                        :min-search-length="2"
                        :open-on-field-click="false"
                        label="Localita di nascita"
                        label-mode="static"
                        placeholder="Localita di nascita"
                        no-data-text="Nessuna località trovata"
                        :disabled="disabledElement"
                        :drop-down-options="{ maxHeight: '200px' }"
                        :item-template="localitaItemTemplate"
                        :on-selection-changed="selezionaLocalitaNascita"
                        :is-valid="!errorFor('localita_nascita_id') && !errorFor('codice_catastale')"
                      />

                      <DxTextBox
                        v-model:value="paziente.codice_fiscale"
                        label="Codice Fiscale"
                        label-mode="floating"
                        placeholder="Codice Fiscale"
                        :show-clear-button="true"
                        :is-valid="!errorFor('codice_fiscale')"
                        :disabled="disabledElement"
                      >
                        <DxTextBoxButton
                          :options="{ icon: 'check', type: 'normal', onClick: () => calcolaCodiceFiscale() }"
                          name="codice_fiscale"
                          location="after"
                        />
                      </DxTextBox>                      
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
                          <span class="bg-white px-2 text-sm text-gray-500">Residenza e
                            contatti</span>
                        </div>
                      </div>
                      <div class="flex gap-3">
                        <div class="flex-grow">
                          <DxTextBox
                            v-model:value="paziente.indirizzo"
                            label="Indirizzo"
                            label-mode="floating"
                            placeholder="Indirizzo"
                            :show-clear-button="true"
                            :is-valid="!errorFor('indirizzo')"
                            :disabled="disabledElement"
                          />
                        </div>
                        <div class="flex-shrink">
                          <DxTextBox
                            v-model:value="paziente.civico"
                            width="100px"
                            label="Civico"
                            label-mode="floating"
                            placeholder="Civico"
                            :show-clear-button="true"
                            :is-valid="!errorFor('civico')"
                            :disabled="disabledElement"
                          />
                        </div>
                      </div>

                      <DxSelectBox
                        v-model:value="paziente.localita_residenza_id"
                        :data-source="localitaDataSource"
                        value-expr="id"
                        display-expr="nome"
                        :search-enabled="true"
                        :search-timeout="500"
                        label="Localita di residenza"
                        label-mode="static"
                        placeholder="Localita di residenza"
                        no-data-text="Nessuna località trovata"
                        :disabled="disabledElement"
                        :drop-down-options="{ maxHeight: '200px' }"
                        :open-on-field-click="false"
                        :min-search-length="2"
                        :item-template="localitaItemTemplate"
                        :on-selection-changed="selezionaLocalitaResidenza"
                        :is-valid="!errorFor('localita_residenza_id')"
                      />
                      <DxTextBox
                        v-model:value="paziente.telefono"
                        label="Cellulare"
                        label-mode="floating"
                        placeholder="Cellulare"
                        :show-clear-button="true"
                        :is-valid="!errorFor('telefono')"
                        :disabled="disabledElement"
                      />
                      <DxTextBox
                        v-model:value="paziente.telefono_fisso"
                        label="Telefono fisso"
                        label-mode="floating"
                        placeholder="Telefono fisso"
                        :show-clear-button="true"
                        :is-valid="!errorFor('telefono_fisso')"
                        :disabled="disabledElement"
                      />
                      <DxTextBox
                        v-model:value="paziente.email"
                        label="Indirizzo email"
                        label-mode="floating"
                        placeholder="indirizzo email"
                        :show-clear-button="true"
                        :is-valid="!errorFor('email')"
                        :disabled="disabledElement"
                      />
                    </div>
                  </div>
                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="flex flex-col gap-1">
                      <div class="relative">
                        <div
                          class="absolute inset-0 flex items-center"
                          aria-hidden="true"
                        >
                          <div class="w-full border-t border-gray-300" />
                        </div>
                        <div class="relative flex justify-center">
                          <span class="bg-white px-2 text-sm text-gray-500">Documenti e altre
                            informazioni</span>
                        </div>
                      </div>
                      <DxSelectBox
                        v-model:value="paziente.documento"
                        :data-source="documenti"
                        value-expr="id"
                        display-expr="text"
                        label="Documento"
                        label-mode="floating"
                        placeholder="Documento"
                        :disabled="disabledElement"
                        :is-valid="!errorFor('documento')"
                      />
                      <DxTextBox
                        v-model:value="paziente.documento_numero"
                        label="Numero documento"
                        label-mode="floating"
                        placeholder="Numero documento"
                        :show-clear-button="true"
                        :is-valid="!errorFor('documento_numero')"
                        :disabled="disabledElement"
                      />
                      <DxDateBox
                        v-model:value="paziente.documento_data_rilascio"
                        placeholder="gg/mm/aaaa"
                        :show-clear-button="true"
                        :use-mask-behavior="true"
                        :display-format="'dd/MM/yyyy'"
                        date-serialization-format="yyyy-MM-dd"
                        type="date"
                        :is-valid="!errorFor('documento_data_rilascio')"
                        label="Data di rilascio"
                        :disabled="disabledElement"
                      />
                      <DxSelectBox
                        v-model:value="paziente.documento_localita_rilascio_id"
                        :data-source="localitaDataSource"
                        value-expr="id"
                        display-expr="nome"
                        :search-enabled="true"
                        :search-timeout="500"
                        :min-search-length="2"
                        label="Localita di rilascio"
                        label-mode="static"
                        placeholder="Localita di rilascio"
                        no-data-text="Nessuna località trovata"
                        :disabled="disabledElement"
                        :drop-down-options="{ maxHeight: '200px' }"
                        :open-on-field-click="false"
                        :item-template="localitaItemTemplate"
                        :on-selection-changed="selezionaLocalitaRilascioDocumento"
                        :is-valid="!errorFor('documento_localita_rilascio_id')"
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
                          <span class="bg-white px-2 text-sm text-gray-500">Note e
                            Consensi</span>
                        </div>
                      </div>
                      <DxTextArea
                        v-model:value="paziente.note"
                        placeholder="Note paziente"
                        :spellcheck="false"
                      />
                      <div class="flex justify-between">
                        <p class="text-gray-700">Atleta con disabilità</p>
                        <DxCheckBox v-model:value="paziente.disabile" />
                      </div>
                      <DxTextBox
                        v-model:value="paziente.gruppo_sanguigno"
                        label="Gruppo sanguigno"
                        label-mode="floating"
                        placeholder="Gruppo sanguigno"
                        :show-clear-button="true"
                        :is-valid="!errorFor('gruppo_sanguigno')"
                        :disabled="disabledElement"
                      />
                      <div class="flex justify-between">
                        <p class="text-gray-700">Consenso privacy</p>
                        <DxCheckBox v-model:value="paziente.consenso_privacy" />
                      </div>
                      <div class="flex justify-between">
                        <p class="text-gray-700">Consenso invio 730</p>
                        <DxCheckBox v-model:value="paziente.consenso_730" />
                      </div>
                      <div class="flex justify-between">
                        <p class="text-gray-700">Consenso invio SMS</p>
                        <DxCheckBox v-model:value="paziente.consenso_sms" />
                      </div>
                      <div class="flex justify-between">
                        <p class="text-gray-700">Consenso invio Email</p>
                        <DxCheckBox v-model:value="paziente.consenso_email" />
                      </div>
                    </div>
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
                    :text="saving ? 'Salvataggio...' : 'Salva modifiche'"
                    icon="save"
                    type="success"
                    styling-mode="contained"
                    :disabled="disabledElement || saving"
                    @click="salvaPaziente()"
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
      <AlertDoppiaAnagrafica
        v-if="paziente_doppio_trovato"
        :paziente="paziente_doppio_trovato"
      />      
    </Dialog>        
  </TransitionRoot>
</template>

<script setup>
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';

import { is422, is404 } from '../../../utilities/response';

import { locale } from 'devextreme/localization';

import DxButton from 'devextreme-vue/button';
import { DxSelectBox } from 'devextreme-vue/select-box';

import DxDateBox from 'devextreme-vue/date-box';
import { DxTextBox, DxButton as DxTextBoxButton } from 'devextreme-vue/text-box';
import DxRadioGroup from 'devextreme-vue/radio-group';
import { DxTextArea } from 'devextreme-vue/text-area';
import { DxCheckBox } from 'devextreme-vue/check-box';

import DataSource from 'devextreme/data/data_source';
import CustomStore from 'devextreme/data/custom_store';

const localitaDataSource = new DataSource({
    store: new CustomStore({
        key: 'id',
        useDefaultSearch: false,
        load(loadOptions) {
            if (loadOptions.searchValue) {
                return axios.get(`api/sphere/ricerca-localita/nome/${loadOptions.searchValue}`).then(response => response.data).catch(err => { throw new Error('Errore caricamento'); });
            }
        },
        byKey: (key) => {
            return axios.get(`api/sphere/localita/${key}`).then(response => response.data).catch(err => { throw new Error('Errore caricamento località'); });
        },
        errorHandler: (error) => {
            console.log(error.message);
        },
    }),
}); 
</script>

<script>
export default {
    props: ['pazienteId' , 'datiTessera'],
    emits: ['update', 'store', 'close'],
    data() {
        return {
            fetching: false,
            saving: false,
            calcolo_cf: false,
            errors: null,
            paziente_doppio_trovato: null,
            //valori di default anagrafica

            paziente: {},

            documenti: [
                {
                    id: 1,
                    text: 'Patente',
                },
                {
                    id: 2,
                    text: 'Passaporto',
                },
                {
                    id: 3,
                    text: "Carta d'identità",
                },
                {
                    id: 4,
                    text: 'Permesso di soggiorno',
                },
            ],
        };
    },
    computed:
    {
        disabledElement() {
            return this.fetching || this.saving || this.calcolo_cf;
        },
        open() {
            return this.pazienteId !== null;
        },
    },
    async created() {
        locale('it-IT');
        
        if (this.pazienteId === 'new') {
            console.log(this.datiTessera);
            this.fetching = true;
            await axios.get('api/sphere/paziente/create')
                .then(async response => {
                    this.paziente = response.data;
                    if(this.datiTessera) {
                        console.log(this.datiTessera);
                        this.paziente.nome = this.datiTessera.nome;
                        this.paziente.cognome = this.datiTessera.cognome;
                        this.paziente.data_nascita = this.datiTessera.data_nascita.substring(4,8)+'-'+this.datiTessera.data_nascita.substring(2,4)+'-'+this.datiTessera.data_nascita.substring(0,2);
                        this.paziente.sesso = this.datiTessera.sesso;
                        this.paziente.localita_nascita_id = await axios.get(`api/sphere/ricerca-localita/codice-catastale/${this.datiTessera.comune_nascita}`).then(response => response.data.id);
                        this.paziente.codice_fiscale = this.datiTessera.codice_fiscale;
                        
                    }
                }).catch(err => {
                    this.fetching = false;
                    console.log(err)
                    this.$emit('close');
                });
            this.fetching = false;
        }
        else {
            this.fetching = true;
            await axios.get(`api/sphere/paziente/${this.pazienteId}/edit`)
                .then(response => {
                    this.paziente = response.data;
                })
                .catch(err => {
                    this.fetching = false;
                    this.$emit('close');
                });
            this.fetching = false;
        }
    },
    methods: {
        errorFor(field) {
            return null !== this.errors && this.errors[field]
                ? true
                : false;
        },
        localitaItemTemplate(data) {
            return data ? '<div class="flex gap-2"><span class="truncate capitalize">' + data.nome + '</span> <span class="uppercase">(' + data.sigla_provincia + ')</span></div>' : '<div />';
        },
        selezionaLocalitaNascita(e) {
            this.paziente.localita_nascita = e.selectedItem;
        },
        selezionaLocalitaResidenza(e) {
            this.paziente.localita_residenza = e.selectedItem;
        },
        selezionaLocalitaRilascioDocumento(e) {
            this.paziente.localita_rilascio_documento = e.selectedItem;
        },
        async cercaTramiteCodiceFiscale(codice_fiscale) {
            await axios.get(`api/sphere/cerca-tramite-codice-fiscale/${codice_fiscale}`)
                .then(response => {
                    if(response.data.id !== this.paziente?.id) this.paziente_doppio_trovato = response.data;
                })
                .catch(err => {
                    if (is404(err)) this.paziente_doppio_trovato = null;
                });
        },
        async calcolaCodiceFiscale() {
            this.errors = null;
            this.paziente_doppio_trovato = null;
            this.calcolo_cf = true;
            await axios.post('api/sphere/calcola-codice-fiscale', {
                nome: this.paziente.nome,
                cognome: this.paziente.cognome,
                sesso: this.paziente.sesso,
                data_nascita: dayjs(this.paziente.data_nascita).format('YYYY-MM-DD'),
                codice_catastale: this.paziente?.localita_nascita?.codice_catastale,
            }).then(response => {
                this.paziente.codice_fiscale = response.data;
                this.cercaTramiteCodiceFiscale(response.data);
            }).catch(err => {
                if (is422(err)) this.errors = err.response.data.errors;
                this.calcolo_cf = false;
            });
            this.calcolo_cf = false;
        },
        salvaPaziente() {
            if (this.paziente.id) {
                this.update();
            }
            else {
                this.store();
            }
        },
        async update() {
            this.errors = null;
            this.saving = true;
            await axios.put(`api/sphere/paziente/${this.paziente.id}`, this.paziente)
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

            await axios.post('api/sphere/paziente', this.paziente).then(response => {
                this.$emit('store', response.data);
            }).catch(err => {
                if (is422(err)) this.errors = err.response.data.errors;
                this.saving = false;
            });
            this.saving = false;
        },
    },
};
</script>

