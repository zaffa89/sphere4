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
              class="relative transform rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-7xl sm:p-6"
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
                  {{ societaSportiva.id ? 'Società: ' + societaSportiva.ragione_sociale : 'Nuova società sportiva' }}
                </DialogTitle>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                  <div class="flex flex-col gap-1">
                    <div class="relative">
                      <div
                        class="absolute inset-0 flex items-center"
                        aria-hidden="true"
                      >
                        <div class="w-full border-t border-gray-300" />
                      </div>
                      <div class="relative flex justify-center">
                        <span class="bg-white px-2 text-sm text-gray-500">Dati anagrafici</span>
                      </div>
                    </div>

                    <DxTextBox
                      v-model:value="societaSportiva.ragione_sociale"
                      label="Ragione sociale"
                      label-mode="static"
                      placeholder="Ragione sociale società"
                      :show-clear-button="true"
                      :is-valid="!errorFor('ragione_sociale')"
                      :disabled="disabledElement"
                    />

                    <div class="flex justify-between gap-2">
                      <DxTextBox
                        v-model:value="societaSportiva.partita_iva"
                        label="Partita IVA"
                        width="100%"
                        label-mode="static"
                        placeholder="Partita IVA"
                        :show-clear-button="true"
                        :is-valid="!errorFor('partita_iva')"
                        :disabled="disabledElement"
                      />

                      <DxTextBox
                        v-model:value="societaSportiva.codice_fiscale"
                        label="Codice fiscale"
                        width="100%"
                        label-mode="static"
                        placeholder="Codice fiscale"
                        :show-clear-button="true"
                        :is-valid="!errorFor('codice_fiscale')"
                        :disabled="disabledElement"
                      />
                    </div>

                    <div class="flex justify-between gap-2">
                      <DxTextBox
                        v-model:value="societaSportiva.nome"
                        label="Indirizzo"
                        width="100%"
                        label-mode="static"
                        placeholder="Indirizzo"
                        :show-clear-button="true"
                        :is-valid="!errorFor('indirizzo')"
                        :disabled="disabledElement"
                      />

                      <DxTextBox
                        v-model:value="societaSportiva.civico"
                        label="Civico"
                        label-mode="static"
                        placeholder="Civico"
                        :show-clear-button="true"
                        :is-valid="!errorFor('civico')"
                        :disabled="disabledElement"
                      />
                    </div>

                    <!-- localita -->
                    <DxSelectBox
                      v-model:value="societaSportiva.localita_id"
                      :data-source="localitaDataSource"
                      value-expr="id"
                      display-expr="nome"
                      :search-enabled="true"
                      :search-timeout="500"
                      :min-search-length="2"
                      :open-on-field-click="false"
                      label="Localita"
                      label-mode="static"
                      placeholder="Localita"
                      no-data-text="Nessuna località trovata"
                      :disabled="disabledElement"
                      :drop-down-options="{ maxHeight: '200px' }"
                      :item-template="localitaItemTemplate"
                      :on-selection-changed="selezionaLocalita"
                      :is-valid="!errorFor('localita_id') && !errorFor('codice_catastale')"
                    />

                    <div class="relative">
                      <div
                        class="absolute inset-0 flex items-center"
                        aria-hidden="true"
                      >
                        <div class="w-full border-t border-gray-300" />
                      </div>
                      <div class="relative flex justify-center">
                        <span class="bg-white px-2 text-sm text-gray-500">Contatti</span>
                      </div>
                    </div>

                    <div class="flex justify-between gap-2">
                      <DxTextBox
                        v-model:value="societaSportiva.telefono"
                        label="Telefono"
                        width="100%"
                        label-mode="static"
                        placeholder="Telefono"
                        :show-clear-button="true"
                        :is-valid="!errorFor('telefono')"
                        :disabled="disabledElement"
                      />

                      <DxTextBox
                        v-model:value="societaSportiva.email"
                        label="Indirizzo Email"
                        width="100%"
                        label-mode="static"
                        placeholder="Indirizzo email"
                        :show-clear-button="true"
                        :is-valid="!errorFor('email')"
                        :disabled="disabledElement"
                      />
                    </div>

                    <div class="flex justify-between gap-2">
                      <DxTextBox
                        v-model:value="societaSportiva.responsabile"
                        label="Responsabile"
                        width="100%"
                        label-mode="static"
                        placeholder="Cognome e nome"
                        :show-clear-button="true"
                        :is-valid="!errorFor('responsabile')"
                        :disabled="disabledElement"
                      />

                      <DxTextBox
                        v-model:value="societaSportiva.responsabile_telefono"
                        label="Telefono Responsabile"
                        width="100%"
                        label-mode="static"
                        placeholder="Telefono"
                        :show-clear-button="true"
                        :is-valid="!errorFor('responsabile_telefono')"
                        :disabled="disabledElement"
                      />
                      <DxTextBox
                        v-model:value="societaSportiva.responsabile_email"
                        label="Indirizzo Email Responsabile"
                        width="100%"
                        label-mode="static"
                        placeholder="Indirizzo email"
                        :show-clear-button="true"
                        :is-valid="!errorFor('responsabile_email')"
                        :disabled="disabledElement"
                      />
                    </div>

                    <div class="flex justify-between gap-2">
                      <DxTextBox
                        v-model:value="societaSportiva.presidente"
                        label="Presidente"
                        width="100%"
                        label-mode="static"
                        placeholder="Indirizzo email"
                        :show-clear-button="true"
                        :is-valid="!errorFor('presidente')"
                        :disabled="disabledElement"
                      />

                      <DxTextBox
                        v-model:value="societaSportiva.presidente_telefono"
                        label="Telefono Presidente"
                        width="100%"
                        label-mode="static"
                        placeholder="Telefono"
                        :show-clear-button="true"
                        :is-valid="!errorFor('presidente_telefono')"
                        :disabled="disabledElement"
                      />

                      <DxTextBox
                        v-model:value="societaSportiva.presidente_email"
                        label="Indirizzo Email Presidente"
                        width="100%"
                        label-mode="static"
                        placeholder="Indirizzo email"
                        :show-clear-button="true"
                        :is-valid="!errorFor('presidente_email')"
                        :disabled="disabledElement"
                      />
                    </div>
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
                        <span class="bg-white px-2 text-sm text-gray-500">Dati fatturazione
                          elettronica</span>
                      </div>
                    </div>

                    <DxTextBox
                      v-model:value="societaSportiva.pec"
                      label="Indirizzo PEC"
                      width="100%"
                      label-mode="static"
                      placeholder="Indirizzo PEC"
                      :show-clear-button="true"
                      :is-valid="!errorFor('pec')"
                      :disabled="disabledElement"
                    />

                    <DxTextBox
                      v-model:value="societaSportiva.codice_destinatario"
                      label="Codice destinatario"
                      width="100%"
                      label-mode="static"
                      placeholder="Codice destinatario"
                      :show-clear-button="true"
                      :is-valid="!errorFor('codice_destinatario')"
                      :disabled="disabledElement"
                    />

                    <div>
                      SELECT NAZIONI
                    </div>

                    <DxButton
                      width="100%"
                      height="80px"
                      text="Allegati"
                      type="normal"
                      icon="activefolder"
                      styling-mode="contained"
                      :disabled="false"
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
                    :text="saving ? 'Salvataggio...' : disabledElement ? 'Non modificabile' : 'Salva modifiche'"
                    icon="save"
                    type="success"
                    styling-mode="contained"
                    :disabled="disabledElement || saving"
                    @click="salvaSocieta()"
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
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';

import { is422 } from '../../../utilities/response';

import { locale } from 'devextreme/localization';

import DxButton from 'devextreme-vue/button';
import { DxSelectBox } from 'devextreme-vue/select-box';

import DxNumberBox from 'devextreme-vue/number-box';
import { DxTextBox, DxButton as DxTextBoxButton } from 'devextreme-vue/text-box';

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
    props: ['societaId'],
    emits: ['update', 'store', 'close'],
    data() {
        return {
            fetching: false,
            saving: false,
            errors: null,

            societaSportiva: {},

            strutture: [],
        };
    },
    computed:
    {
        disabledElement() {
            return this.fetching || this.saving;
        },
        open() {
            return this.societaId !== null;
        },
    },
    async created() {
        locale('it-IT');

        if (this.societaId === 'new') {
            this.fetching = true;
            await axios.get('api/sphere/societa-sportiva/create')
                .then(response => {
                    this.societaSportiva = response.data;
                }).catch(err => {
                    this.$emit('close');
                });
            this.fetching = false;
        }
        else {
            this.fetching = true;
            await axios.get(`api/sphere/societa-sportiva/${this.societaId}/edit`)
                .then(response => {
                    this.societaSportiva = response.data;
                })
                .catch(
                    err => {
                        this.$emit('close');
                    });
            this.fetching = false;
        }
    },
    methods: {
        selezionaLocalita(e) {
            this.societaSportiva.localita = e.selectedItem;
        },
        localitaItemTemplate(data) {
            return data ? '<div class="flex gap-2"><span class="truncate capitalize">' + data.nome + '</span> <span class="uppercase">(' + data.sigla_provincia + ')</span></div>' : '<div />';
        },
        errorFor(field) {
            return null !== this.errors && this.errors[field]
                ? true
                : false;
        },
        salvaSocieta() {
            if (this.societaSportiva.id) {
                this.update();
            }
            else {
                this.store();
            }
        },
        async update() {
            this.errors = null;
            this.saving = true;

            await axios.put(`api/sphere/societa-sportiva/${this.societaSportiva.id}`, this.societaSportiva)
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

            await axios.post('api/sphere/societa-sportiva', this.societaSportiva).then(response => {
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

