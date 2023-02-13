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
                  {{ ambulatorio.id ? 'Ambulatorio: ' + ambulatorio.nome : 'Nuovo ambulatorio' }}
                </DialogTitle>
                <div class="flex flex-col gap-1">
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
                          ambulatorio</span>
                      </div>
                    </div>

                    <DxTextBox
                      v-model:value="ambulatorio.nome"
                      label="Nome ambulatorio"
                      label-mode="floating"
                      placeholder="Nome"
                      :show-clear-button="true"
                      :is-valid="!errorFor('nome')"
                      :disabled="disabledElement"
                    />

                    <DxSelectBox
                      v-model:value="ambulatorio.struttura_id"
                      :data-source="strutture"
                      value-expr="id"
                      display-expr="nome"
                      label="Struttura"
                      label-mode="floating"
                      placeholder="Seleziona struttura"
                      :disabled="disabledElement"
                      :is-valid="!errorFor('struttura_id')"
                    />
                    <div class="flex gap-2 justify-between">
                      <DxNumberBox
                        v-model:value="ambulatorio.ordine"
                        placeholder="Ordine ( in numero )"
                        :show-spin-buttons="true"
                        :is-valid="!errorFor('ordine')"
                        label="Ordine"
                        :disabled="disabledElement"
                      />

                      <div class="flex justify-end items-center gap-2">
                        <span class="text-gray-700">Attivo</span>
                        <DxCheckBox v-model:value="ambulatorio.attivo" />
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
                    @click="salvaAmbulatorio()"
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

import { is422 } from '@utilities/response';

import { locale } from 'devextreme/localization';

import DxButton from 'devextreme-vue/button';
import { DxSelectBox } from 'devextreme-vue/select-box';

import DxNumberBox from 'devextreme-vue/number-box';
import { DxTextBox, DxButton as DxTextBoxButton } from 'devextreme-vue/text-box';

import { DxTextArea } from 'devextreme-vue/text-area';
import { DxCheckBox } from 'devextreme-vue/check-box';

</script>

<script>
export default {
	props: ['ambulatorioId'],
	emits: ['update', 'store', 'close'],
	data() {
		return {
			fetching: false,
			saving: false,
			errors: null,
			ambulatorio: {},
			strutture: []
		};
	},
	computed:
	{
		disabledElement() {
			return this.fetching || this.saving;
		},
		open() {
			return this.ambulatorioId !== null;
		},
	},
	async created() {
		locale('it-IT');

		if (this.ambulatorioId === 'new') {
			this.fetching = true;
			await axios.get('api/sphere/ambulatorio/create')
				.then(response => {
					this.ambulatorio = response.data.ambulatorio;
					this.strutture = response.data.strutture;
				}).catch(err => {
					this.$emit('close');
				});
			this.fetching = false;
		}
		else {
			this.fetching = true;
			await axios.get(`api/sphere/ambulatorio/${this.ambulatorioId}/edit`)
				.then(response => {
					this.ambulatorio = response.data.ambulatorio;
					this.strutture = response.data.strutture;
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
		salvaAmbulatorio() {
			if (this.ambulatorio.id) {
				this.update();
			}
			else {
				this.store();
			}
		},
		async update() {
			this.errors = null;
			this.saving = true;

			await axios.put(`api/sphere/ambulatorio/${this.ambulatorio.id}`, this.ambulatorio)
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

			await axios.post('api/sphere/ambulatorio', this.ambulatorio).then(response => {
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

