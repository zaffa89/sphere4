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
                <div>
                  <DialogTitle
                    as="h3"
                    class="text-lg font-medium leading-6 text-gray-900 text-center capitalize"
                  >
                    {{ prenotazione.id ? 'Modifica' : 'Creazione' }} Assenza
                  </DialogTitle>
                  <div class="mt-2">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                      <div>
                        <!-- <TextInput label="Data visita" v-model="prenotazione.data_inizio" :validate="false" type="datetime-local" :min="now" :isValid="!errorFor('data_inizio')" /> -->
                        <DxDateBox
                          v-model:value="prenotazione.data_inizio"
                          :min="now"
                          type="datetime"
                          :is-valid="!errorFor('data_inizio')"
                          label="Data e ora della visita"
                          :disabled="disabledElement"
                        />
                      </div>
                      <div>
                        <!-- <TextInput label="Durata" v-model="prenotazione.durata" :validate="false" type="number" min="1" :isValid="!errorFor('durata')" /> -->
                        <DxNumberBox
                          v-model:value="prenotazione.durata"
                          placeholder="Durata visita in minuti"
                          :is-valid="!errorFor('durata')"
                          label="Durata della visita"
                          :disabled="disabledElement"
                        />
                      </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                      <DxTextArea
                        v-model:value="prenotazione.note"
                        label="Note"
                        label-mode="floating"
                        placeholder="Scrivi qualcosa..."
                        :spellcheck="false"
                      />
                      <div>
                        <DxSelectBox
                          v-model:value="prenotazione.colore"
                          :data-source="colori"
                          value-expr="codice"
                          display-expr="nome"
                          :search-enabled="false"
                          label="Colore"
                          label-mode="floating"
                          :item-template="coloriTemplate"
                          :disabled="disabledElement"
                          :drop-down-options="{ maxHeight: '200px' }"
                        />
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
                    :text="saving ? 'Salvataggio...' : disabledElement ? 'Prenotazione già accettata' : 'Salva'"
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
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';


import DxButton from 'devextreme-vue/button';
import DxDateBox from 'devextreme-vue/date-box';
import DxNumberBox from 'devextreme-vue/number-box';
import { DxTextArea } from 'devextreme-vue/text-area';
import { DxSelectBox } from 'devextreme-vue/select-box';
import { is422 } from '../../../../utilities/response';


</script>

<script>

export default {
    props: ['eventData'],
    emits: ['update', 'store', 'close'],
    data() {
        return {
            fetching: false,
            saving: false,
            errors: null,
            now: dayjs().format('YYYY-MM-DD HH:mm'),
            prenotazione: null,
            colori: [],
        };
    },
    computed:
    {
        disabledElement() {
            return this.saving;
        },
        open() {
            return this.eventData !== null;
        },        
    },
    async created() {
        if (this.eventData.id) {
            this.fetching = true;
            await axios.get(`api/sphere/prenotazione/${this.eventData.id}/edit`)
                .then(response => {
                    this.prenotazione = response.data.prenotazione;
                    this.prenotazione.durata = dayjs(response.data.prenotazione.data_fine).diff(response.data.prenotazione.data_inizio, 'minute');
                    this.colori = response.data.colori;
                })
                .catch(
                    err => {
                        this.$emit('close');
                    });
            this.fetching = false;
        }
        else {
            this.fetching = true;
            await axios.post('api/sphere/prenotazione/create', this.eventData)
                .then(response => {
                    this.prenotazione = response.data.prenotazione;
                    this.prenotazione.durata = dayjs(response.data.prenotazione.data_fine).diff(response.data.prenotazione.data_inizio, 'minute');
                    this.colori = response.data.colori;
                })
                .catch(
                    err => {
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
                this.$emit('close');
            }).catch(err => {
                if (is422(err)) this.errors = err.response.data.errors;
                this.saving = false;
            });
            this.saving = false;
        },
    },
};

</script>

