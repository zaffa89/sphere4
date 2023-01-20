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
                  {{ sport.id ? 'Impostazioni sport: ' + sport.nome : 'Nuovo sport' }}
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
                          <span class="bg-white px-2 text-sm text-gray-500">Dettagli
                            sport</span>
                        </div>
                      </div>
                      <DxTextBox
                        v-model:value="sport.nome"
                        label="Nome sport"
                        label-mode="static"
                        placeholder="Nome sport"
                        :show-clear-button="true"
                        :is-valid="!errorFor('nome')"
                        :disabled="disabledElement"
                      />
                      <p>{{ errorMessageFor('nome') }}</p>

                      <DxTextBox
                        v-model:value="sport.codice_sport"
                        label="Codice sport"
                        label-mode="static"
                        placeholder="Codice sport"
                        :show-clear-button="true"
                        :is-valid="!errorFor('codice_sport')"
                        :disabled="disabledElement"
                      />

                      <div class="flex gap-2">
                        <DxTextBox
                          v-model:value="sport.tipo_visita"
                          label="Tipo visita"
                          width="100%"
                          label-mode="static"
                          placeholder="A1 , B1 ..."
                          :show-clear-button="true"
                          :is-valid="!errorFor('tipo_visita')"
                          :disabled="disabledElement"
                        />

                        <DxNumberBox
                          v-model:value="sport.mesi_scadenza"
                          label="Mesi di scadenza"
                          width="100%"
                          label-mode="static"
                          placeholder="es: 12"
                          :show-clear-button="true"
                          :is-valid="!errorFor('mesi_scadenza')"
                          :disabled="disabledElement"
                        />
                      </div>

                      <div class="relative">
                        <div
                          class="absolute inset-0 flex items-center"
                          aria-hidden="true"
                        >
                          <div class="w-full border-t border-gray-300" />
                        </div>
                        <div class="relative flex justify-center">
                          <span class="bg-white px-2 text-sm text-gray-500">Anno di
                            riferimento</span>
                        </div>
                      </div>

                      <DxRadioGroup
                        v-model:value="sport.anno_di_riferimento"
                        :items="riferimenti_anno"
                        value-expr="value"
                        display-expr="text"
                      />
                      <div
                        v-if="sport.anno_di_riferimento == 3"
                        class="flex justify-between gap-2"
                      >
                        <DxTextBox
                          v-model:value="sport.inizio_anno_riferimento"
                          label="Inizio anno sportivo"
                          width="100%"
                          label-mode="static"
                          placeholder="es: 01/07"
                          :show-clear-button="true"
                          :is-valid="!errorFor('inizio_anno_riferimento')"
                          :disabled="disabledElement"
                        />

                        <DxTextBox
                          v-model:value="sport.fine_anno_riferimento"
                          label="Fine anno sportivo"
                          width="100%"
                          label-mode="static"
                          placeholder="es: 30/06"
                          :show-clear-button="true"
                          :is-valid="!errorFor('fine_anno_riferimento')"
                          :disabled="disabledElement"
                        />
                      </div>

                      <div class="relative">
                        <div
                          class="absolute inset-0 flex items-center"
                          aria-hidden="true"
                        >
                          <div class="w-full border-t border-gray-300" />
                        </div>
                        <div class="relative flex justify-center">
                          <span class="bg-white px-2 text-sm text-gray-500">Federazione /
                            Ente principale</span>
                        </div>
                      </div>


                      <div class="flex gap-2">
                        <DxTextBox
                          v-model:value="sport.codice_federazione"
                          label="Codice Fed. / Ente"
                          label-mode="static"
                          placeholder=""
                          :show-clear-button="true"
                          :is-valid="!errorFor('codice_federazione')"
                          :disabled="disabledElement"
                        />

                        <DxTextBox
                          v-model:value="sport.sigla_federazione"
                          label="Sigla Fed. /Ente"
                          label-mode="static"
                          placeholder=""
                          :show-clear-button="true"
                          :is-valid="!errorFor('sigla_federazione')"
                          :disabled="disabledElement"
                        />

                        <DxTextBox
                          v-model:value="sport.affiliazione"
                          label="Affiliazione"
                          label-mode="static"
                          placeholder=""
                          :show-clear-button="true"
                          :is-valid="!errorFor('affiliazione')"
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
                          <span class="bg-white px-2 text-sm text-gray-500">Limiti di età
                            MASCHI</span>
                        </div>
                      </div>

                      <div class="flex justify-between gap-2">
                        <DxNumberBox
                          v-model:value="sport.eta_minima_maschi"
                          label="Età minima"
                          width="100%"
                          label-mode="static"
                          placeholder="es: 8"
                          :show-clear-button="true"
                          :is-valid="!errorFor('eta_minima_maschi')"
                          :disabled="disabledElement"
                        />

                        <DxNumberBox
                          v-model:value="sport.eta_massima_maschi"
                          label="Età massima"
                          width="100%"
                          label-mode="static"
                          placeholder="es: 99"
                          :show-clear-button="true"
                          :is-valid="!errorFor('eta_massima_maschi')"
                          :disabled="disabledElement"
                        />
                      </div>
                      <DxNumberBox
                        v-model:value="sport.eta_minima_tem_maschi"
                        label="Età minima TEM ( Test Ergometrico Massimale ) obbligatorio"
                        label-mode="static"
                        placeholder="es: 40"
                        :show-clear-button="true"
                        :is-valid="!errorFor('eta_minima_tem_maschi')"
                        :disabled="disabledElement"
                      />

                      <div class="relative">
                        <div
                          class="absolute inset-0 flex items-center"
                          aria-hidden="true"
                        >
                          <div class="w-full border-t border-gray-300" />
                        </div>
                        <div class="relative flex justify-center">
                          <span class="bg-white px-2 text-sm text-gray-500">Limiti di età
                            FEMMINE</span>
                        </div>
                      </div>
                      <div class="flex justify-between gap-2">
                        <DxNumberBox
                          v-model:value="sport.eta_minima_femmine"
                          label="Età minima"
                          label-mode="static"
                          placeholder="es: 8"
                          :show-clear-button="true"
                          :is-valid="!errorFor('eta_minima_femmine')"
                          :disabled="disabledElement"
                        />

                        <DxNumberBox
                          v-model:value="sport.eta_massima_femmine"
                          label="Età massima"
                          label-mode="static"
                          placeholder="es: 99"
                          :show-clear-button="true"
                          :is-valid="!errorFor('eta_massima_femmine')"
                          :disabled="disabledElement"
                        />
                      </div>
                      <DxNumberBox
                        v-model:value="sport.eta_minima_tem_femmine"
                        label="Età minima TEM ( Test Ergometrico Massimale ) obbligatorio"
                        label-mode="static"
                        placeholder="es: 50"
                        :show-clear-button="true"
                        :is-valid="!errorFor('eta_minima_tem_femmine')"
                        :disabled="disabledElement"
                      />

                      <div class="relative">
                        <div
                          class="absolute inset-0 flex items-center"
                          aria-hidden="true"
                        >
                          <div class="w-full border-t border-gray-300" />
                        </div>
                        <div class="relative flex justify-center">
                          <span class="bg-white px-2 text-sm text-gray-500">Opzioni</span>
                        </div>
                      </div>
                      <div class="flex justify-between">
                        <p class="text-gray-700">Sport per atleti disabili</p>
                        <DxCheckBox v-model:value="sport.disabili" />
                      </div>
                      <div class="flex justify-between">
                        <p class="text-gray-700">Gruppo sanguigno obbligatorio</p>
                        <DxCheckBox v-model:value="sport.richiesto_gruppo_sanguigno" />
                      </div>
                      <div class="flex justify-between">
                        <p class="text-gray-700">EEG obbligatorio</p>
                        <DxCheckBox v-model:value="sport.richiesto_eeg" />
                      </div>
                      <div class="flex justify-between">
                        <p class="text-gray-700">Prenotabile online</p>
                        <DxCheckBox v-model:value="sport.prenotabile_online" />
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
                    :text="saving ? 'Salvataggio...' : disabledElement ? 'Non modificabile' : 'Salva modifiche'"
                    icon="save"
                    type="success"
                    styling-mode="contained"
                    :disabled="disabledElement || saving"
                    @click="salvaSport()"
                  />
                </div>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>


      <!-- previene warning per mancanza di focus , magari sostituire i bottoni di Devexpress con quelli base -->
      <button class="opacity-0 absolute bottom-0"></button>
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


import DxNumberBox from 'devextreme-vue/number-box';
import { DxTextBox, DxButton as DxTextBoxButton } from 'devextreme-vue/text-box';
import DxRadioGroup from 'devextreme-vue/radio-group';
import { DxCheckBox } from 'devextreme-vue/check-box';

</script>
  
<script>
export default {
    props: ['sportId'],
    emits: ['update', 'store', 'close'],
    data() {
        return {
            fetching: false,
            saving: false,
            //errors: null,
            errors: null,

            sport: null,

            riferimenti_anno: [
                {
                    value: 1,
                    text: 'Compimento anno',
                },
                {
                    value: 2,
                    text: 'Anno solare',
                },
                {
                    value: 3,
                    text: 'Anno sportivo',
                },
            ],
        };
    },
    computed:
    {
        disabledElement() {
            return this.fetching || this.saving;
        },
        open() {
            return this.sportId !== null;
        },
    },
    async created() {
        locale('it-IT');

        if (this.sportId === 'new') {
            this.fetching = true;
            await axios.get('api/sphere/sport/create')
                .then(response => {
                    this.sport = response.data;
                });
            this.fetching = false;
        }
        else {
            this.fetching = true;
            await axios.get(`api/sphere/sport/${this.sportId}/edit`)
                .then(response => {
                    this.sport = response.data;
                })
                .catch(
                    err => {

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
        errorMessageFor(field) {
            return null !== this.errors && this.errors[field]
                ? this.errors[field].toString()
                : false;
        },
        salvaSport() {
            if (this.sport.id) {
                this.update();
            }
            else {
                this.store();
            }
        },
        async update() {
            this.saving = true;
            await axios.put(`api/sphere/sport/${this.sport.id}`, this.sport)
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

            await axios.post('api/sphere/sport', this.sport).then(response => {
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
  
  