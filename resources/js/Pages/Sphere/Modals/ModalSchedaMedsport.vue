<template>
  <TransitionRoot
    as="template"
    :show="open"
  >
    <Dialog
      as="div"
      class="relative z-50"
      @close="$emit('close')"
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
              class="relative transform bg-white px-0 pb-0 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-7xl"
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
                <div class="px-6 py-2 border-b border-gray-400 flex justify-between items-center">
                  <span class="text-lg">{{ visita.paziente?.ragione_sociale }}</span>
                  <div class="flex gap-2">
                    <DxButton
                      :width="120"
                      text="Chiudi"
                      type="danger"
                      styling-mode="outlined"
                      @click="$emit('close')"
                    />

                    <DxButton
                      :width="120"
                      text="Salva"
                      type="success"
                      styling-mode="outlined"
                      @click="salvaScheda"
                    />
                  </div>
                </div>
                <div class="p-6 border-b-2 min-h-[450px]">
                  <!-- DATI ANAGRAFICI -->
                  <div v-show="currentTab === 1">
                    <div class="flex flex-col gap-1">
                      <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
                        <!-- colonna sx -->
                        <div class="flex flex-col gap-1 col-span-1 sm:col-span-2">
                          <div class="relative">
                            <div
                              class="absolute inset-0 flex items-center"
                              aria-hidden="true"
                            >
                              <div class="w-full border-t border-gray-300" />
                            </div>
                            <div class="relative flex justify-center">
                              <span
                                class="bg-white px-2 text-sm text-gray-500"
                              >Atleta</span>
                            </div>
                          </div>
                          <div class="grid grid-cols-1 sm:grid-cols-4 gap-2">
                            <div class="col-span-1">
                              <DxTextBox
                                :value="visita.paziente?.codice"
                                label="Cartella"
                                label-mode="static"
                                :show-clear-button="true"
                                :is-valid="!errorFor('codice')"
                                :disabled="true"
                              />
                            </div>
                            <div
                              class="col-span-1 sm:col-span-3 flex flex-col sm:flex-row items-end gap-2"
                            >
                              <DxButton
                                width="100%"
                                text="Allegati"
                                type="normal"
                                icon="activefolder"
                                styling-mode="contained"
                                :disabled="!pazienteSelezionato"
                              />
                              <DxButton
                                id="saveButton"
                                width="100%"
                                text="Storico Schede"
                                icon="verticalalignbottom"
                                type="normal"
                                styling-mode="contained"
                                :disabled="!pazienteSelezionato"
                              />
                              <DxButton
                                id="saveButton"
                                width="100%"
                                text="Anagrafica"
                                icon="user"
                                type="normal"
                                styling-mode="contained"
                                :disabled="!pazienteSelezionato"
                                @click="apriModalPaziente"
                              />
                              <DxButton
                                id="saveButton"
                                width="100%"
                                :text="pazienteSelezionato ? 'Cambia atleta' : 'Seleziona atleta'"
                                icon="user"
                                type="normal"
                                styling-mode="contained"
                                :disabled="false"
                                @click="apriRicercaPaziente"
                              />
                            </div>
                          </div>
                          <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                            <div class="col-span-2">
                              <DxTextBox
                                :value="visita.paziente?.cognome"
                                label="Cognome"
                                label-mode="static"
                                :show-clear-button="true"
                                :is-valid="!errorFor('cognome')"
                                :disabled="true"
                              />
                            </div>
                            <div class="col-span-2">
                              <DxTextBox
                                :value="visita.paziente?.nome"
                                label="Nome"
                                label-mode="static"
                                :show-clear-button="true"
                                :is-valid="!errorFor('nome')"
                                :disabled="true"
                              />
                            </div>
                          </div>
                          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2">
                            <div class="col-span-1">
                              <DxNumberBox
                                :value="getAgeFromDate(visita.paziente?.data_nascita)"
                                label="Età"
                                label-mode="static"
                                :show-clear-button="true"
                                :is-valid="!errorFor('eta')"
                                :disabled="true"
                              />
                            </div>
                            <div class="col-span-1">
                              <DxTextBox
                                :value="dateFormat(visita.paziente?.data_nascita)"
                                label="Data di nascita"
                                label-mode="static"
                                :show-clear-button="true"
                                :is-valid="!errorFor('data_nascita')"
                                :disabled="true"
                              />
                            </div>
                            <div class="col-span-1">
                              <DxTextBox
                                :value="visita.paziente?.localita_nascita?.nome"
                                label="Nato a"
                                label-mode="static"
                                :show-clear-button="true"
                                :is-valid="!errorFor('localita_nascita')"
                                :disabled="true"
                              />
                            </div>
                            <div class="col-span-1">
                              <DxTextBox
                                :value="visita.paziente?.localita_nascita?.sigla_provincia"
                                label="Prov."
                                label-mode="static"
                                :show-clear-button="true"
                                :is-valid="!errorFor('sigla_provincia')"
                                :disabled="true"
                              />
                            </div>
                          </div>
                          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2">
                            <div class="col-span-1">
                              <DxTextBox
                                :value="visita.paziente?.localita_residenza?.nome"
                                label="Residente in"
                                label-mode="static"
                                :show-clear-button="true"
                                :is-valid="!errorFor('localita_residenza')"
                                :disabled="true"
                              />
                            </div>
                            <div class="col-span-1">
                              <DxTextBox
                                :value="visita.paziente?.localita_residenza?.sigla_provincia"
                                label="Prov."
                                label-mode="static"
                                :show-clear-button="true"
                                :is-valid="!errorFor('sigla_provincia')"
                                :disabled="true"
                              />
                            </div>
                            <div class="col-span-2">
                              <DxTextBox
                                :value="visita.paziente?.codice_fiscale"
                                label="Codice fiscale"
                                label-mode="static"
                                :show-clear-button="true"
                                :is-valid="!errorFor('codice_fiscale')"
                                :disabled="true"
                              />
                            </div>
                            <div
                              class="col-span-1 sm:col-span-2 lg:col-span-4 flex justify-end items-end gap-1"
                            >
                              <div class="w-20">
                                <DxTextBox
                                  v-model:value="visita.posizione_ticket"
                                  label="Pos. Ticket"
                                  label-mode="static"
                                  :disabled="false"
                                />
                              </div>
                              <div>
                                <DxButton
                                  type="normal"
                                  icon="refresh"
                                  text="Calcola"
                                  styling-mode="contained"
                                  :disabled="false"
                                  @click="calcPosTicket"
                                />
                              </div>
                            </div>
                          </div>

                          <!-- società sportiva e sport praticato -->
                          <div class="relative">
                            <div
                              class="absolute inset-0 flex items-center cursor-no"
                              aria-hidden="true"
                            >
                              <div class="w-full border-t border-gray-300" />
                            </div>
                            <div class="relative flex justify-center">
                              <span class="bg-white px-2 text-sm text-gray-500">Visita -
                                Sport</span>
                            </div>
                          </div>
                          <div class="grid grid-cols-1 sm:grid-cols-2 gap-1">
                            <DxTextBox
                              :value="visita.prestazione.nome"
                              label="Prestazione"
                              label-mode="static"
                              :disabled="true"
                            />
                            <DxSelectBox
                              v-model:value="visita.medico_id"
                              label="Medico esecutore"
                              :data-source="elenco_medici"
                              value-expr="id"
                              display-expr="ragione_sociale"
                              :search-enabled="false"
                              :is-valid="!errorFor('medico_id')"
                              :disabled="false"
                              no-data-text="Nessuno medico trovato"
                            />
                          </div>

                          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2">
                            <div class="col-span-2">
                              <DxSelectBox
                                v-model:value="visita.sport_id"
                                label="Sport praticato"
                                :data-source="elenco_sport"
                                value-expr="id"
                                display-expr="nome"
                                :search-enabled="true"
                                :item-template="sportItemTemplate"
                                :is-valid="!errorFor('visita.sport_id')"
                                :disabled="false"
                                no-data-text="Nessuno sport trovato"
                              />
                            </div>
                            <div class="col-span-2">
                              <DxSelectBox
                                v-model:value="visita.societa_id"
                                label="Società sportiva"
                                :data-source="societaDataSource"
                                value-expr="id"
                                display-expr="ragione_sociale"
                                :search-enabled="true"
                                :is-valid="!errorFor('visita.societa_id')"
                                :disabled="false"
                                no-data-text="Nessuna società trovata"
                              />
                            </div>
                          </div>
                        </div>

                        <!-- colonna dx -->
                        <div class="flex flex-col gap-1 col-span-1">
                          <div class="relative">
                            <div
                              class="absolute inset-0 flex items-center"
                              aria-hidden="true"
                            >
                              <div class="w-full border-t border-gray-300" />
                            </div>
                            <div class="relative flex justify-center">
                              <span
                                class="bg-white px-2 text-sm text-gray-500"
                              >Prenotazione</span>
                            </div>
                          </div>
                          <DxDateBox
                            v-model:value="visita.prenotazione.data_prenotazione"
                            type="datetime"
                            :is-valid="!errorFor('data_inizio')"
                            label="Prenotata il"
                            :disabled="true"
                          />
                          <DxDateBox
                            v-model:value="visita.prenotazione.data_inizio"
                            type="datetime"
                            :is-valid="!errorFor('data_inizio')"
                            label="Data e ora della visita"
                            :disabled="false"
                          />

                          <RadioGroup v-model="visita.pagamento_a_carico">
                            <RadioGroupLabel class="text-base font-medium text-gray-900">
                              Pagamento a carico:
                            </RadioGroupLabel>

                            <div
                              class="mt-4 grid grid-cols-1 gap-y-1 sm:grid-cols-2 sm:gap-x-3"
                            >
                              <RadioGroupOption
                                v-for="optionPagamento in optionsPagamento"
                                :key="optionPagamento.value"
                                v-slot="{ checked, active }"
                                as="template"
                                :value="optionPagamento.value"
                              >
                                <div
                                  :class="[checked ? 'border-transparent' : 'border-gray-300', active ? 'border-indigo-500 ring-2 ring-indigo-500' : '', 'relative flex cursor-pointer border bg-white p-2 shadow-sm focus:outline-none']"
                                >
                                  <span class="flex flex-1">
                                    <span class="flex flex-col">
                                      <RadioGroupLabel
                                        as="span"
                                        class="block text-sm font-medium text-gray-900"
                                      >
                                        {{ optionPagamento.text }}
                                      </RadioGroupLabel>
                                    </span>
                                  </span>
                                  <CheckCircleIcon
                                    :class="[!checked ? 'invisible' : '', 'h-5 w-5 text-indigo-600']"
                                    aria-hidden="true"
                                  />
                                  <span
                                    :class="[active ? 'border' : 'border-2', checked ? 'border-indigo-500' : 'border-transparent', 'pointer-events-none absolute -inset-px']"
                                    aria-hidden="true"
                                  />
                                </div>
                              </RadioGroupOption>
                            </div>
                          </RadioGroup>

                          <DxButton
                            width="100%"
                            height="80px"
                            text="Accettato"
                            type="normal"
                            icon="activefolder"
                            styling-mode="contained"
                            :disabled="!accettabile"
                          />

                          <DxButton
                            width="100%"
                            height="80px"
                            text="Anteprima"
                            type="normal"
                            icon="activefolder"
                            styling-mode="contained"
                            :disabled="false"
                            @click="anteprimaCertificato(visita.id)"
                          />

                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- PRE ANAMNESI -->
                  <div v-show="currentTab === 2">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                      <div class="flex flex-col gap-2">
                        <div class="relative">
                          <div
                            class="absolute inset-0 flex items-center"
                            aria-hidden="true"
                          >
                            <div class="w-full border-t border-gray-300" />
                          </div>
                          <div class="relative flex justify-center">
                            <span class="bg-white px-2 text-sm text-gray-500">Anamnesi familiare (genitori , fratelli, nonni)</span>
                          </div>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                          <div>
                            <label class="text-sm font-medium text-gray-900">Diabete</label>                                                    
                            <fieldset class="mt-0">                                                  
                              <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-4">
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.diabete"
                                    :value="false"
                                    type="radio"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                  />
                                  <label class="ml-3 block text-sm font-medium text-gray-700">No</label>
                                </div>
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.diabete"
                                    :value="true"
                                    type="radio"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                  />
                                  <label class="ml-3 block text-sm font-medium text-gray-700">Si</label>
                                </div>
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.diabete_chi"
                                    type="text"
                                    class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Chi?"
                                  />
                                </div>
                              </div>
                            </fieldset>
                          </div>
                          <div>
                            <label class="text-sm font-medium text-gray-900">Ipertensione arteriosa</label>                                                    
                            <fieldset class="mt-0">                                                  
                              <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-4">
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.ipertensione_arteriosa"
                                    :value="false"
                                    type="radio"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                  />
                                  <label class="ml-3 block text-sm font-medium text-gray-700">No</label>
                                </div>
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.ipertensione_arteriosa"
                                    :value="true"
                                    type="radio"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                  />
                                  <label class="ml-3 block text-sm font-medium text-gray-700">Si</label>
                                </div>
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.ipertensione_arteriosa_chi"
                                    type="text"
                                    class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Chi?"
                                  />
                                </div>
                              </div>
                            </fieldset>
                          </div>
                                                
                                                
                          <div>
                            <label class="text-sm font-medium text-gray-900">Morte improvvisa giovanile</label>                                                    
                            <fieldset class="mt-0">                                                  
                              <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-4">
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.morte_improvvisa_giovanile"
                                    :value="false"
                                    type="radio"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                  />
                                  <label class="ml-3 block text-sm font-medium text-gray-700">No</label>
                                </div>
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.morte_improvvisa_giovanile"
                                    :value="true"
                                    type="radio"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                  />
                                  <label class="ml-3 block text-sm font-medium text-gray-700">Si</label>
                                </div>
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.morte_improvvisa_giovanile_chi"
                                    type="text"
                                    class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Chi?"
                                  />
                                </div>
                              </div>
                            </fieldset>
                          </div>
                          <div>
                            <label class="text-sm font-medium text-gray-900">Cardiopatia ischemica od infarto</label>                                                    
                            <fieldset class="mt-0">                                                  
                              <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-4">
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.cardiopatia_ischemica_infarto"
                                    :value="false"
                                    type="radio"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                  />
                                  <label class="ml-3 block text-sm font-medium text-gray-700">No</label>
                                </div>
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.cardiopatia_ischemica_infarto"
                                    :value="true"
                                    type="radio"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                  />
                                  <label class="ml-3 block text-sm font-medium text-gray-700">Si</label>
                                </div>
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.cardiopatia_ischemica_infarto_chi"
                                    type="text"
                                    class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Chi?"
                                  />
                                </div>
                              </div>
                            </fieldset>
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
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                          <div>
                            <label class="text-sm font-medium text-gray-900">Uso di farmaci?</label>                                                    
                            <fieldset class="mt-0">                                                  
                              <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-4">
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.uso_farmaci"
                                    :value="false"
                                    type="radio"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                  />
                                  <label class="ml-3 block text-sm font-medium text-gray-700">No</label>
                                </div>
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.uso_farmaci"
                                    :value="true"
                                    type="radio"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                  />
                                  <label class="ml-3 block text-sm font-medium text-gray-700">Si</label>
                                </div>
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.uso_farmaci_quali"
                                    type="text"
                                    class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Quali?"
                                  />
                                </div>
                              </div>
                            </fieldset>
                          </div>
                          <div>
                            <label class="text-sm font-medium text-gray-900">Vaccinazione antitetanica obbligatoria</label>                                                    
                            <fieldset class="mt-0">                                                  
                              <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-4">
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.vaccinazione_antitetanica_obbligatoria"
                                    :value="false"
                                    type="radio"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                  />
                                  <label class="ml-3 block text-sm font-medium text-gray-700">No</label>
                                </div>
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.vaccinazione_antitetanica_obbligatoria"
                                    :value="true"
                                    type="radio"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                  />
                                  <label class="ml-3 block text-sm font-medium text-gray-700">Si</label>
                                </div>
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.vaccinazione_antitetanica_ultima_data"
                                    type="text"
                                    class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Data ultima vaccinazione"
                                  />
                                </div>
                              </div>
                            </fieldset>
                          </div>
                          <div>
                            <label class="text-sm font-medium text-gray-900">Gravidanze</label>                                                    
                            <fieldset class="mt-0">                                                  
                              <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-4">
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.gravidanze"
                                    :value="false"
                                    type="radio"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                  />
                                  <label class="ml-3 block text-sm font-medium text-gray-700">No</label>
                                </div>
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.gravidanze"
                                    :value="true"
                                    type="radio"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                  />
                                  <label class="ml-3 block text-sm font-medium text-gray-700">Si</label>
                                </div>
                                <div class="flex items-center">
                                  <input
                                    v-model="visita.pre_anamnesi.gravidanze_quante"
                                    type="text"
                                    class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Quante?"
                                  />
                                </div>
                              </div>
                            </fieldset>
                          </div>
                        </div>
                      </div>
                      <div class="flex flex-col gap-2">
                        <div class="relative">
                          <div
                            class="absolute inset-0 flex items-center"
                            aria-hidden="true"
                          >
                            <div class="w-full border-t border-gray-300" />
                          </div>
                          <div class="relative flex justify-center">
                            <span class="bg-white px-2 text-sm text-gray-500">Dati sport</span>
                          </div>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                          <div>
                            <label class="block text-sm font-medium text-gray-700">Allenamenti a settimana</label>
                            <div class="mt-1">
                              <input
                                type="text"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                              />
                            </div>                                                        
                          </div>
                          <div>
                            <label class="block text-sm font-medium text-gray-700">Durata media allenamento</label>                                                        
                            <div class="mt-1">
                              <input
                                type="text"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                              />
                            </div>
                          </div>
                        </div>
                        <div>
                          <label class="text-base font-medium text-gray-900">Durante l'attività sportiva l'atleta ha accusato di:</label>                                                    
                          <fieldset class="mt-4 grid grid-cols-2 gap-2">
                            <div>
                              <div class="space-y-2">
                                <div class="flex items-center space-x-3 justify-between">
                                  <label class="ml-3 block text-sm font-medium text-gray-700">Disturbi improvvisi</label>
                                  <div class="flex gap-2">
                                    <div class="flex items-center">
                                      <input
                                        v-model="visita.pre_anamnesi.disturbi_improvvisi"
                                        :value="false"
                                        type="radio"
                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                      />
                                      <label class="ml-1 block text-sm font-medium text-gray-700">No</label>
                                    </div>
                                    <div class="flex items-center">
                                      <input
                                        v-model="visita.pre_anamnesi.disturbi_improvvisi"
                                        :value="true"
                                        type="radio"
                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                      />
                                      <label class="ml-1 block text-sm font-medium text-gray-700">Si</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="space-y-2">
                                <div class="flex items-center space-x-3 justify-between">                                                                
                                  <label class="ml-3 block text-sm font-medium text-gray-700">Svenimenti</label>
                                  <div class="flex gap-2">
                                    <div class="flex items-center">
                                      <input
                                        v-model="visita.pre_anamnesi.svenimenti"
                                        :value="false"
                                        type="radio"
                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                      />
                                      <label class="ml-1 block text-sm font-medium text-gray-700">No</label>
                                    </div>
                                    <div class="flex items-center">
                                      <input
                                        v-model="visita.pre_anamnesi.svenimenti"
                                        :value="true"
                                        type="radio"
                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                      />
                                      <label class="ml-1 block text-sm font-medium text-gray-700">Si</label>
                                    </div>
                                  </div>                                                                    
                                </div>
                              </div>
                              <div class="space-y-2">
                                <div class="flex items-center space-x-3 justify-between">                                                                
                                  <label class="ml-3 block text-sm font-medium text-gray-700">Dolori toracici</label>
                                  <div class="flex gap-2">
                                    <div class="flex items-center">
                                      <input
                                        v-model="visita.pre_anamnesi.dolori_toracici"
                                        :value="false"
                                        type="radio"
                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                      />
                                      <label class="ml-1 block text-sm font-medium text-gray-700">No</label>
                                    </div>
                                    <div class="flex items-center">
                                      <input
                                        v-model="visita.pre_anamnesi.dolori_toracici"
                                        :value="true"
                                        type="radio"
                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                      />
                                      <label class="ml-1 block text-sm font-medium text-gray-700">Si</label>
                                    </div>
                                  </div>                                                                    
                                </div>
                              </div>
                              <div class="space-y-2">
                                <div class="flex items-center space-x-3 justify-between">                                                                
                                  <label class="ml-3 block text-sm font-medium text-gray-700">Grande stanchezza</label>
                                  <div class="flex gap-2">
                                    <div class="flex items-center">
                                      <input
                                        v-model="visita.pre_anamnesi.grande_stanchezza"
                                        :value="false"
                                        type="radio"
                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                      />
                                      <label class="ml-1 block text-sm font-medium text-gray-700">No</label>
                                    </div>
                                    <div class="flex items-center">
                                      <input
                                        v-model="visita.pre_anamnesi.grande_stanchezza"
                                        :value="true"
                                        type="radio"
                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                      />
                                      <label class="ml-1 block text-sm font-medium text-gray-700">Si</label>
                                    </div>
                                  </div>                                                                    
                                </div>
                              </div>
                            </div>
                          </fieldset>
                        </div>
                        <hr>
                        <div>
                          <label class="text-sm font-medium text-gray-900">L'atleta ha eseguito visite per idoneità agonistica in passato?</label>
                          <fieldset class="mt-0">                                                  
                            <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-4">
                              <div class="flex items-center">
                                <input
                                  v-model="visita.pre_anamnesi.idoneita_precedente"
                                  :value="false"
                                  type="radio"
                                  class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                />
                                <label class="ml-3 block text-sm font-medium text-gray-700">No</label>
                              </div>
                              <div class="flex items-center">
                                <input
                                  v-model="visita.pre_anamnesi.idoneita_precedente"
                                  :value="true"
                                  type="radio"
                                  class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                />
                                <label class="ml-3 block text-sm font-medium text-gray-700">Si</label>
                              </div>                                                            
                            </div>
                          </fieldset>
                        </div>
                        <div>
                          <label class="text-sm font-medium text-gray-900">L'atleta è mai stato giudicato temporaneamente NON idoneo all'attività sportiva?</label>
                          <fieldset class="mt-0">                                                  
                            <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-4">
                              <div class="flex items-center">
                                <input
                                  v-model="visita.pre_anamnesi.temporaneamente_non_idoneo"
                                  :value="false"
                                  type="radio"
                                  class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                />
                                <label class="ml-3 block text-sm font-medium text-gray-700">No</label>
                              </div>
                              <div class="flex items-center">
                                <input
                                  v-model="visita.pre_anamnesi.temporaneamente_non_idoneo"
                                  :value="true"
                                  type="radio"
                                  class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                />
                                <label class="ml-3 block text-sm font-medium text-gray-700">Si</label>
                              </div>                                                            
                            </div>
                          </fieldset>
                        </div>
                        <div>
                          <label class="text-sm font-medium text-gray-900">L'atleta ha mai eseguito ulteriori accertamenti successivi alle visite di idoneità sportiva?</label>
                          <fieldset class="mt-0">                                                  
                            <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-4">
                              <div class="flex items-center">
                                <input
                                  v-model="visita.pre_anamnesi.accertamenti_precedenti"
                                  :value="false"
                                  type="radio"
                                  class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                />
                                <label class="ml-3 block text-sm font-medium text-gray-700">No</label>
                              </div>
                              <div class="flex items-center">
                                <input
                                  v-model="visita.pre_anamnesi.accertamenti_precedenti"
                                  :value="true"
                                  type="radio"
                                  class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                />
                                <label class="ml-3 block text-sm font-medium text-gray-700">Si</label>
                              </div>                                                            
                            </div>
                          </fieldset>
                        </div>
                        <div>
                          <label class="block text-sm font-medium text-gray-700">In caso affermativo, quali?</label>
                          <div class="mt-1">
                            <textarea
                              v-model="visita.pre_anamnesi.accertamenti_precedenti_quali"
                              rows="4"
                              class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- ANAMNESI -->
                  <div v-show="currentTab === 3">
                    <div class="grid grid-cols-1">
                      <div>
                        <label class="block text-sm font-medium text-gray-700">Anamnesi familiare</label>
                        <div class="mt-1">
                          <textarea
                            v-model="visita.dati_clinici.anamnesi_familiare"
                            rows="3"
                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />
                        </div>
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700">Anamnesi fisiologica</label>
                        <div class="mt-1">
                          <textarea
                            v-model="visita.dati_clinici.anamnesi_fisiologica"
                            rows="3"
                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />
                        </div>
                      </div>
                      <div class="flex items-center justify-between gap-2">
                        <div class="flex-grow">
                          <label class="block text-sm font-medium text-gray-700">Menarca</label>
                          <div class="mt-1">
                            <input
                              v-model="visita.dati_clinici.anamnesi_menarca"
                              type="text"
                              class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            />
                          </div>
                        </div>
                        <div class="flex-grow">
                          <label class="block text-sm font-medium text-gray-700">Data ultima mestruazione</label>
                          <div class="mt-1">
                            <input
                              v-model="visita.dati_clinici.anamnesi_data_ultima_mestruazione"
                              type="text"
                              class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            />
                          </div>
                        </div>
                        <div class="flex-grow">
                          <label class="block text-sm font-medium text-gray-700">Fumo</label>
                          <div class="mt-1">
                            <input
                              v-model="visita.dati_clinici.anamnesi_fumo"
                              type="text"
                              class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            />
                          </div>
                        </div>
                        <div class="flex-grow">
                          <label class="block text-sm font-medium text-gray-700">Alcol</label>
                          <div class="mt-1">
                            <input
                              v-model="visita.dati_clinici.anamnesi_alcol"
                              type="text"
                              class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            />
                          </div>
                        </div>
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700">Anamnesi patologica: malattie sofferte</label>
                        <div class="mt-1">
                          <textarea
                            v-model="visita.dati_clinici.anamnesi_patologica"
                            rows="3"
                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />
                        </div>
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700">Interventi chirurgici</label>
                        <div class="mt-1">
                          <textarea
                            v-model="visita.dati_clinici.anamnesi_interventi_chirurgici"
                            rows="3"
                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />
                        </div>
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700">Infortuni</label>
                        <div class="mt-1">
                          <textarea
                            v-model="visita.dati_clinici.anamnesi_infortuni"
                            rows="3"
                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- SPIRO URINE ACUITA' VISIVA-->
                  <div v-show="currentTab === 4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                      <div class="flex flex-col gap-2">
                        <div class="flex gap-2 justify-between">
                          <div>
                            <label class="block text-sm font-medium text-gray-700">Peso Kg</label>
                            <div class="mt-1">
                              <input
                                v-model="visita.dati_clinici.peso"
                                type="text"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                              />
                            </div>
                          </div>
                          <div>
                            <label class="block text-sm font-medium text-gray-700">Statura cm.</label>
                            <div class="mt-1">
                              <input
                                v-model="visita.dati_clinici.altezza"
                                type="text"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                              />
                            </div>
                          </div>
                          <div>
                            <label class="block text-sm font-medium text-gray-700">B.M.I.</label>
                            <div class="mt-1">
                              <input
                                type="text"
                                disabled
                                :value="bmiCalcolato"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                              />
                            </div>
                          </div>
                        </div>
                        <!-- SPIRO -->
                        <div class="relative">
                          <div
                            class="absolute inset-0 flex items-center"
                            aria-hidden="true"
                          >
                            <div class="w-full border-t border-gray-300" />
                          </div>
                          <div class="relative flex justify-center">
                            <span class="bg-white px-2 text-sm text-gray-500">Spirometria</span>
                          </div>
                        </div>                                                
                        <div class="flex flex-col">
                          <p class="text-sm font-medium text-gray-700">Capacità vitale (CV)</p>
                          <div class="flex gap-2 justify-between">
                            <div>
                              <label class="block text-sm text-gray-700">Litri</label>
                              <input
                                v-model="visita.dati_clinici.spiro_capacita_vitale"
                                type="text"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                              />                                                            
                            </div>
                            <div>
                              <label class="block text-sm text-gray-700">Teorico</label>
                              <input
                                type="text"
                                disabled
                                :value="null"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                              />
                            </div>
                            <div>
                              <label class="block text-sm text-gray-700">Teorico(%)</label>
                              <input
                                type="text"
                                disabled
                                :value="null"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                              />                                                            
                            </div>
                          </div>
                        </div>
                        <div class="flex flex-col">
                          <p class="text-sm font-medium text-gray-700">Capacità vitale forzata(CVF)</p>
                          <div class="flex gap-2 justify-between">
                            <div>
                              <label class="block text-sm text-gray-700">Litri</label>
                              <input
                                v-model="visita.dati_clinici.spiro_capacita_vitale_forzata"
                                type="text"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                              />                                                            
                            </div>
                            <div>
                              <label class="block text-sm text-gray-700">Teorico</label>
                              <input
                                type="text"
                                disabled
                                :value="null"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                              />
                            </div>
                            <div>
                              <label class="block text-sm text-gray-700">Teorico(%)</label>
                              <input
                                type="text"
                                disabled
                                :value="null"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                              />                                                            
                            </div>
                          </div>
                        </div>
                        <div class="flex flex-col">
                          <p class="text-sm font-medium text-gray-700">Volume espiratorio massimo/sec (VEMS)</p>
                          <div class="flex gap-2 justify-between">
                            <div>
                              <label class="block text-sm text-gray-700">Litri</label>
                              <input
                                v-model="visita.dati_clinici.spiro_volume_espiratorio_massimo_sec"
                                type="text"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                              />                                                            
                            </div>
                            <div>
                              <label class="block text-sm text-gray-700">Teorico</label>
                              <input
                                type="text"
                                disabled
                                :value="null"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                              />
                            </div>
                            <div>
                              <label class="block text-sm text-gray-700">Teorico(%)</label>
                              <input
                                type="text"
                                disabled
                                :value="null"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                              />                                                            
                            </div>
                          </div>
                        </div>
                        <div class="flex flex-col">
                          <p class="text-sm font-medium text-gray-700">Indice di Tiffenau (VEMS/CVF)</p>
                          <div class="flex gap-2 justify-between">
                            <div>
                              <label class="block text-sm text-gray-700">%</label>
                              <input
                                v-model="visita.dati_clinici.spiro_indice_tiffenau"
                                type="text"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                              />                                                            
                            </div>
                            <div>
                              <label class="block text-sm text-gray-700">Teorico</label>
                              <input
                                type="text"
                                disabled
                                :value="null"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                              />
                            </div>
                            <div>
                              <label class="block text-sm text-gray-700">Teorico(%)</label>
                              <input
                                type="text"
                                disabled
                                :value="null"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                              />                                                            
                            </div>
                          </div>
                        </div>
                        <div class="flex flex-col">
                          <p class="text-sm font-medium text-gray-700">Massima ventilazione volontaria (MVV)</p>
                          <div class="flex gap-2 justify-between">
                            <div>
                              <label class="block text-sm text-gray-700">Litri/minuto</label>
                              <input
                                v-model="visita.dati_clinici.spiro_massima_ventilazione_volontaria"
                                type="text"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                              />                                                            
                            </div>
                            <div>
                              <label class="block text-sm text-gray-700">Teorico</label>
                              <input
                                type="text"
                                disabled
                                :value="null"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                              />
                            </div>
                            <div>
                              <label class="block text-sm text-gray-700">Teorico(%)</label>
                              <input
                                type="text"
                                disabled
                                :value="null"
                                class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                              />                                                            
                            </div>
                          </div>
                        </div>
                        <div>
                          <label class="block text-sm font-medium text-gray-700">Conclusioni</label>
                          <div class="mt-1">
                            <textarea
                              v-model="visita.dati_clinici.spiro_conclusioni"
                              rows="3"
                              class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            />
                          </div>
                        </div> 
                      </div>

                                            
                      <div class="flex flex-col gap-2">
                        <!-- VISTA -->
                        <div class="relative">
                          <div
                            class="absolute inset-0 flex items-center"
                            aria-hidden="true"
                          >
                            <div class="w-full border-t border-gray-300" />
                          </div>
                          <div class="relative flex justify-center">
                            <span class="bg-white px-2 text-sm text-gray-500">Acuità visiva</span>
                          </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                          <div>
                            <p class="text-sm font-medium text-gray-700">Naturale</p>
                            <div class="flex gap-4">                                                    
                              <div class="flex-grow">
                                <label class="block text-sm text-gray-700">Occhio destro</label>
                                <div class="relative mt-1 rounded-md shadow-sm">
                                  <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-8">
                                    <span class="text-gray-700 font-medium sm:text-sm">/ 10</span>
                                  </div>
                                  <input
                                    v-model="visita.dati_clinici.vista_od_naturale"
                                    type="number"
                                    min="0"
                                    max="10"
                                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="10"
                                  />
                                </div>
                              </div>
                              <div class="flex-grow">
                                <label class="block text-sm text-gray-700">Occhio sinistro</label>
                                <div class="relative mt-1 rounded-md shadow-sm">
                                  <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-8">
                                    <span class="text-gray-700 font-medium sm:text-sm">/ 10</span>
                                  </div>
                                  <input
                                    v-model="visita.dati_clinici.vista_os_naturale"
                                    type="number"
                                    min="0"
                                    max="10"
                                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="10"
                                  />
                                </div>
                              </div>
                            </div>
                          </div>
                          <div>
                            <p class="text-sm font-medium text-gray-700">Corretta</p>
                            <div class="flex gap-4">                                                    
                              <div class="flex-grow">
                                <label class="block text-sm text-gray-700">Occhio destro</label>
                                <div class="relative mt-1 rounded-md shadow-sm">
                                  <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-8">
                                    <span class="text-gray-700 font-medium sm:text-sm">/ 10</span>
                                  </div>
                                  <input
                                    v-model="visita.dati_clinici.vista_od_corretta"
                                    type="number"
                                    min="0"
                                    max="10"
                                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="10"
                                  />
                                </div>
                              </div>
                              <div class="flex-grow">
                                <label class="block text-sm text-gray-700">Occhio sinistro</label>
                                <div class="relative mt-1 rounded-md shadow-sm">
                                  <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-8">
                                    <span class="text-gray-700 font-medium sm:text-sm">/ 10</span>
                                  </div>
                                  <input
                                    v-model="visita.dati_clinici.vista_os_corretta"
                                    type="number"
                                    min="0"
                                    max="10"
                                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="10"
                                  />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div>
                          <label class="block text-sm font-medium text-gray-700">Informazioni vista</label>
                          <div class="mt-1">
                            <textarea
                              v-model="visita.dati_clinici.vista_conclusioni"
                              rows="3"
                              class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            />
                          </div>
                        </div> 

                        <!-- URINE -->
                        <div>
                          <div class="relative">
                            <div
                              class="absolute inset-0 flex items-center"
                              aria-hidden="true"
                            >
                              <div class="w-full border-t border-gray-300" />
                            </div>
                            <div class="relative flex justify-center">
                              <span class="bg-white px-2 text-sm text-gray-500">Urine</span>
                            </div>
                          </div>
                        </div>
                        <div class="flex gap-2">
                          <div class="flex-grow">
                            <label class="block text-sm font-medium text-gray-700">Aspetto</label>
                            <input
                              v-model="visita.dati_clinici.urine_aspetto"
                              type="text"
                              class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                            />                                                            
                          </div>
                          <div class="flex-grow">
                            <label class="block text-sm font-medium text-gray-700">Colore</label>
                            <input
                              v-model="visita.dati_clinici.urine_colore"
                              type="text"
                              class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                            />                                                            
                          </div>
                        </div>
                        <div class="flex gap-2">
                          <div class="flex-grow">
                            <label class="block text-sm font-medium text-gray-700">Densità</label>
                            <input
                              v-model="visita.dati_clinici.urine_densita"
                              type="text"
                              class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                            />                                                            
                          </div>
                          <div class="flex-grow">
                            <label class="block text-sm font-medium text-gray-700">Reazione</label>
                            <input
                              v-model="visita.dati_clinici.urine_reazione"
                              type="text"
                              class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                            />                                                            
                          </div>
                        </div>
                        <div>
                          <label class="block text-sm font-medium text-gray-700">Referto urine</label>
                          <div class="mt-1">
                            <textarea
                              v-model="visita.dati_clinici.urine_conclusioni"
                              rows="3"
                              class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            />
                          </div>
                        </div> 
                      </div>
                    </div>
                  </div>
                  <!-- ESAME OBBIETTIVO-->
                  <div v-show="currentTab === 5">
                    <div class="grid grid-cols-1">
                      <div>
                        <label class="block text-sm font-medium text-gray-700">Trofismo</label>
                        <div class="mt-1">
                          <input
                            v-model="visita.dati_clinici.eo_trofismo"
                            type="text"
                            class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />
                        </div>
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700">Apparato locomotore</label>
                        <div class="mt-1">
                          <textarea
                            v-model="visita.dati_clinici.eo_apparato_locomotore"
                            rows="3"
                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />
                        </div>
                      </div>                                            
                      <div>
                        <label class="block text-sm font-medium text-gray-700">Arti</label>
                        <div class="mt-1">
                          <textarea
                            v-model="visita.dati_clinici.eo_arti"
                            rows="3"
                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />
                        </div>
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700">Torace e apparato respiratorio</label>
                        <div class="mt-1">
                          <textarea
                            v-model="visita.dati_clinici.eo_torace_apparato_respiratorio"
                            rows="3"
                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />
                        </div>
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700">Apparato cardiocircolatorio</label>
                        <div class="mt-1">
                          <textarea
                            v-model="visita.dati_clinici.eo_apparato_cardiocircolatorio"
                            rows="3"
                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />
                        </div>
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700">Addome e organi genitali</label>
                        <div class="mt-1">
                          <textarea
                            v-model="visita.dati_clinici.eo_addome_organi_genitali"
                            rows="3"
                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />
                        </div>
                      </div>
                      <div class="flex gap-2">
                        <div class="flex-grow">
                          <label class="block text-sm font-medium text-gray-700">Senso cromatico</label>
                          <div class="mt-1">
                            <input
                              v-model="visita.dati_clinici.eo_senso_cromatico"
                              type="text"
                              class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            />
                          </div>
                        </div>
                        <div class="flex-grow">
                          <label class="block text-sm font-medium text-gray-700">Udito</label>
                          <div class="mt-1">
                            <input
                              v-model="visita.dati_clinici.eo_udito"
                              type="text"
                              class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            />
                          </div>
                        </div>
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700">Conclusioni esame obbiettivo</label>
                        <div class="mt-1">
                          <textarea
                            v-model="visita.dati_clinici.eo_conclusioni"
                            rows="3"
                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- ECG -->
                  <div v-show="currentTab === 6">
                    <div class="relative">
                      <div
                        class="absolute inset-0 flex items-center"
                        aria-hidden="true"
                      >
                        <div class="w-full border-t border-gray-300" />
                      </div>
                      <div class="relative flex justify-center">
                        <span class="bg-white px-2 text-sm text-gray-500">ECG a riposo</span>
                      </div>
                    </div>

                    <div class="flex gap-4">
                      <div>
                        <label class="block text-sm text-gray-700">FC media</label>
                        <input
                          v-model="visita.dati_clinici.ecg_riposo_fc_media"
                          type="text"
                          class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                        />                                                            
                      </div>
                      <div>
                        <label class="block text-sm text-gray-700">PR</label>
                        <input
                          v-model="visita.dati_clinici.ecg_riposo_pr"
                          type="text"
                          class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                        />                                                            
                      </div>
                      <div>
                        <label class="block text-sm text-gray-700">QT</label>
                        <input
                          v-model="visita.dati_clinici.ecg_riposo_qt"
                          type="text"
                          class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                        />                                                            
                      </div>
                      <div>
                        <label class="block text-sm text-gray-700">QTC</label>
                        <input
                          v-model="visita.dati_clinici.ecg_riposo_qtc"
                          type="text"
                          class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                        />                                                            
                      </div>
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-gray-700">Referto ECG a riposo</label>
                      <div class="mt-1">
                        <textarea
                          v-model="visita.dati_clinici.ecg_riposo_referto"
                          rows="3"
                          class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        />
                      </div>
                    </div> 

                    <div class="relative mt-4">
                      <div
                        class="absolute inset-0 flex items-center"
                        aria-hidden="true"
                      >
                        <div class="w-full border-t border-gray-300" />
                      </div>
                      <div class="relative flex justify-center">
                        <span class="bg-white px-2 text-sm text-gray-500">ECG dopo sforzo</span>
                      </div>
                    </div>

                    <div class="flex gap-4">
                      <div>
                        <label class="block text-sm text-gray-700">FC media</label>
                        <input
                          v-model="visita.dati_clinici.ecg_dopo_sforzo_fc_media"
                          type="text"
                          class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                        />                                                            
                      </div>
                      <div>
                        <label class="block text-sm text-gray-700">FC media</label>
                        <input
                          v-model="visita.dati_clinici.ecg_dopo_sforzo_pr"
                          type="text"
                          class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                        />                                                            
                      </div>
                      <div>
                        <label class="block text-sm text-gray-700">FC media</label>
                        <input
                          v-model="visita.dati_clinici.ecg_dopo_sforzo_qt"
                          type="text"
                          class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                        />                                                            
                      </div>
                      <div>
                        <label class="block text-sm text-gray-700">FC media</label>
                        <input
                          v-model="visita.dati_clinici.ecg_dopo_sforzo_qtc"
                          type="text"
                          class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                        />                                                            
                      </div>
                    </div>

                    <div class="flex gap-4">
                      <div>
                        <label class="block text-sm text-gray-700">I.R.I.</label>
                        <input
                          v-model="visita.dati_clinici.ecg_dopo_sforzo_iri"
                          type="text"
                          class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                        />                                                            
                      </div>
                      <div>
                        <label class="block text-sm text-gray-700">N° pulsazioni per I.R.I.</label>
                        <input
                          v-model="visita.dati_clinici.ecg_dopo_sforzo_pulsazioni_iri"
                          type="text"
                          class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                        />                                                            
                      </div>
                      <div>
                        <label class="block text-sm text-gray-700">Valutazione</label>
                        <input
                          v-model="visita.dati_clinici.ecg_dopo_sforzo_valutazione"
                          type="text"
                          class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                        />                                                            
                      </div>                                            
                    </div>

                    <div>
                      <label class="block text-sm font-medium text-gray-700">Referto ECG dopo sforzo</label>
                      <div class="mt-1">
                        <textarea
                          v-model="visita.dati_clinici.ecg_dopo_sforzo_referto"
                          rows="3"
                          class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        />
                      </div>
                    </div> 

                    <div class="relative mt-4">
                      <div
                        class="absolute inset-0 flex items-center"
                        aria-hidden="true"
                      >
                        <div class="w-full border-t border-gray-300" />
                      </div>
                      <div class="relative flex justify-center">
                        <span class="bg-white px-2 text-sm text-gray-500">Pressione arteriosa</span>
                      </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                      <div class="flex flex-col">
                        <p class="text-sm font-medium text-gray-700">A riposo</p>
                        <div class="flex gap-2 justify-between">
                          <div>
                            <label class="block text-sm text-gray-700">Sistolica</label>
                            <input
                              v-model="visita.dati_clinici.ecg_pressione_riposo_sist"
                              type="text"
                              class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                            />                                                            
                          </div>
                          <div>
                            <label class="block text-sm text-gray-700">Diastolica</label>
                            <input
                              v-model="visita.dati_clinici.ecg_pressione_riposo_diast"
                              type="text"
                              class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                            />
                          </div>                                                    
                        </div>
                      </div>
                      <div class="flex flex-col">
                        <p class="text-sm font-medium text-gray-700">Dopo sforzo</p>
                        <div class="flex gap-2 justify-between">
                          <div>
                            <label class="block text-sm text-gray-700">Sistolica</label>
                            <input
                              v-model="visita.dati_clinici.ecg_pressione_dopo_sforzo_sist"
                              type="text"
                              class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                            />                                                            
                          </div>
                          <div>
                            <label class="block text-sm text-gray-700">Diastolica</label>
                            <input
                              v-model="visita.dati_clinici.ecg_pressione_dopo_sforzo_diast"
                              type="text"
                              class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                            />
                          </div>                                                    
                        </div>
                      </div>
                      <div class="flex flex-col">
                        <p class="text-sm font-medium text-gray-700">Dopo 1 minuto e mezzo dallo sforzo</p>
                        <div class="flex gap-2 justify-between">
                          <div>
                            <label class="block text-sm text-gray-700">Sistolica</label>
                            <input
                              v-model="visita.dati_clinici.ecg_pressione_dopo_sforzo_minuto_sist"
                              type="text"
                              class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                            />                                                            
                          </div>
                          <div>
                            <label class="block text-sm text-gray-700">Diastolica</label>
                            <input
                              v-model="visita.dati_clinici.ecg_pressione_dopo_sforzo_diast_sist"
                              type="text"
                              class="py-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 sm:text-sm"
                            />
                          </div>                                                    
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- ESAMI SPECIALISTICI -->
                  <div v-show="currentTab === 7">
                    <div class="grid grid-cols-1">
                      <div>
                        <label class="block text-sm font-medium text-gray-700">Esame neurologico</label>
                        <div class="mt-1">                                                    
                          <textarea
                            v-model="visita.dati_clinici.esame_neurologico"
                            rows="3"
                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />
                        </div>
                      </div>

                      <div>
                        <label class="block text-sm font-medium text-gray-700">Esame encefalogramma</label>
                        <div class="mt-1">                                                    
                          <textarea
                            v-model="visita.dati_clinici.esame_encefalogramma"
                            rows="3"
                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />
                        </div>
                      </div>

                      <div>
                        <label class="block text-sm font-medium text-gray-700">Esame otorinolaringoiatrico</label>
                        <div class="mt-1">                                                   
                          <textarea
                            v-model="visita.dati_clinici.esame_otorinolaringoiatrico"
                            rows="3"
                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />
                        </div>
                      </div>

                      <div>
                        <label class="block text-sm font-medium text-gray-700">Esame audiometrico</label>
                        <div class="mt-1">
                          <textarea
                            v-model="visita.dati_clinici.esame_audiometrico"
                            rows="3"
                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />                                                    
                        </div>
                      </div>

                      <div>
                        <label class="block text-sm font-medium text-gray-700">Esame oculistico</label>
                        <div class="mt-1">
                          <textarea
                            v-model="visita.dati_clinici.esame_oculistico"
                            rows="3"
                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />                                                   
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- RICHIESTA ACCERTAMENTI -->
                  <div v-show="currentTab === 8">
                    <div class="grid grid-cols-1">
                      <div>
                        <label class="block text-sm font-medium text-gray-700">Problematiche riscontrate</label>
                        <div class="mt-1">                                                    
                          <textarea
                            v-model="visita.dati_clinici.accertamenti_problematiche_riscontrate"
                            rows="3"
                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />                                                   
                        </div>
                      </div>

                      <div>
                        <label class="block text-sm font-medium text-gray-700">Esami previsti come accertamento</label>
                        <div class="mt-1">
                          <textarea
                            v-model="visita.dati_clinici.accertamenti_esami_previsti"
                            rows="3"
                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />                                                   
                        </div>
                      </div>

                      <div>
                        <label class="block text-sm font-medium text-gray-700">Esami integrativi</label>
                        <div class="mt-1">
                          <textarea
                            v-model="visita.dati_clinici.accertamenti_esami_integrativi"
                            rows="3"
                            class="block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          />                                                   
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- menu in basso -->
                <div
                  class="isolate flex flex-wrap divide-x divide-gray-200 shadow"
                  aria-label="Tabs"
                >
                  <button
                    v-for="(tab, tabIdx) in tabs"
                    :key="tab.name"
                    :disabled="!visita.paziente_id"
                    :class="[currentTab == tab.id ? 'text-gray-900' : 'text-gray-500 hover:text-gray-700', tabIdx === 0 ? 'rounded-l-lg' : '', tabIdx === tabs.length - 1 ? 'rounded-r-lg' : '', 'disabled:cursor-not-allowed group relative min-w-0 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10']"
                    @click="currentTab = tab.id"
                  >
                    <span
                      aria-hidden="true"
                      :class="[currentTab == tab.id ? 'bg-indigo-500' : 'bg-transparent', 'absolute inset-x-0 top-0 h-0.5']"
                    />
                    <span>{{ tab.label }}</span>
                  </button>
                </div>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
      <button class="opacity-0 absolute bottom-0"></button>
      <ModalPaziente
        v-if="showModalPaziente"
        :paziente-id="visita.paziente_id"
        @close="chiudiModalPaziente"
        @update="updatePaziente"
      />
      <ModalRicercaPaziente
        v-if="showModalRicercaPaziente"
        @close="showModalRicercaPaziente = false"
        @selection="updatePaziente"
      />
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

import { DxTextBox } from 'devextreme-vue/text-box';
import DxButton from 'devextreme-vue/button';
import DxNumberBox from 'devextreme-vue/number-box';
import { DxSelectBox } from 'devextreme-vue/select-box';
import DxDateBox from 'devextreme-vue/date-box';
import { getAgeFromDate, dateFormat, dateAndTimeFormat } from '../../../utilities/dateUtilities';

import { RadioGroup, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue';
import { CheckCircleIcon } from '@heroicons/vue/20/solid';
import DataSource from 'devextreme/data/data_source';
import CustomStore from 'devextreme/data/custom_store';

import ModalPaziente from './ModalPaziente.vue';
import ModalRicercaPaziente from './ModalRicercaPaziente.vue';

const tabs = [
    { id: 1, label: 'Generale' },
    { id: 2, label: 'Pre Anamnesi' },
    { id: 3, label: 'Anamnesi' },
    { id: 4, label: 'Spiro / Urine / Acuità visiva' },
    { id: 5, label: 'Esame obbiettivo' },
    { id: 6, label: 'ECG' },
    { id: 7, label: 'Esami specialistici' },
    { id: 8, label: 'Richiesta accertamenti' },
    { id: 9, label: 'Idoneità' },
];

const societaDataSource = new DataSource({
    store: new CustomStore({
        key: 'id',
        useDefaultSearch: false,
        load(loadOptions) {
            if (loadOptions.searchValue) {
                return axios.get(`api/sphere/ricerca-societa/${loadOptions.searchValue}`).then(response => response.data).catch(() => { throw new Error('Errore caricamento'); });
            }
        },
        byKey: (key) => {
            return axios.get(`api/sphere/societa-sportiva/${key}`).then(response => response.data).catch(() => { throw new Error('Errore caricamento località'); });
        },
        errorHandler: (error) => {
            console.log(error.message);
        },
    }),
});

</script>

<script>
export default {
    props: ['visitaId'],
    emits: ['update', 'close'],
    data() {
        return {
            fetching: false,
            saving: false,
            errors: null,
            currentTab: 1,
            visita: null,

            elenco_sport: [],
            elenco_medici: [],

            optionsPagamento: [
                {
                    value: 0,
                    text: 'Non specificato',
                },
                {
                    value: 1,
                    text: 'Atleta',
                },
                {
                    value: 2,
                    text: 'Società',
                },
                {
                    value: 3,
                    text: 'Visita gratuita',
                },
            ],
            showModalPaziente: false,
            showModalRicercaPaziente: false,
        };
    },
    computed:
    {
        accettabile() {
            return this.visita.paziente !== null;
        },
        pazienteSelezionato() {
            return this.visita.paziente !== null;
        },
        disabledElement() {
            return this.fetching || this.saving;
        },
        open() {
            return this.visitaId !== null;
        },
        bmiCalcolato() {
            return this.visita.dati_clinici.peso && this.visita.dati_clinici.altezza 
                ? Math.round(((this.visita.dati_clinici.peso / ((this.visita.dati_clinici.altezza/100)**2)) * 100)) / 100 
                : 'Peso o altezza mancanti';
        },
        capacitaVistalePercentualeTeorica() {
            return true;
        },
    },
    watch: {
        'visita.pagamento_a_carico'() { this.calcPosTicket(); },
        'visita.paziente.data_nascita'() { this.calcPosTicket(); },
        'visita.paziente.disabile'() { this.calcPosTicket(); },
        'visita.prestazione.tipo_visita'() { this.calcPosTicket(); },
        'visita.visita_privata'() { this.calcPosTicket(); },
    },
    async created() {
        locale('it-IT');

        this.fetching = true;
        await axios.get(`api/sphere/visita-medsport/${this.visitaId}`)
            .then(response => {
                this.visita = response.data.visita;
                this.elenco_sport = response.data.elenco_sport;
                this.elenco_medici = response.data.elenco_medici;
            })
            .catch(
                () => {
                    this.$emit('close');
                });
        this.fetching = false;

    },

    methods: {
        calcPosTicket() {
            this.visita.posizione_ticket =
                this.visita.prestazione.tipo_visita == 'BS'
                    ? 'BB'
                    : [1, 2, 3].includes(this.visita.pagamento_a_carico) || this.visita.visita_privata
                        ? '40'
                        : this.visita.paziente?.disabile
                            ? '10'
                            : getAgeFromDate(this.visita.paziente?.data_nascita) < 18
                                ? '60'
                                : '40';
        },
        calcolaPosizioneTicket() {
            axios.get(`api/sphere/calcola-posizione-ticket/${this.visita.id}`).then(res => this.visita.posizione_ticket = String(res.data)).catch(() => this.visita.posizione_ticket = null);
        },
        apriModalPaziente() {
            this.showModalPaziente = true;
        },
        apriRicercaPaziente() {
            this.showModalRicercaPaziente = true;
        },
        chiudiModalPaziente() {
            this.showModalPaziente = false;
        },
        updatePaziente(paziente) {
            this.showModalPaziente = false;
            this.showModalRicercaPaziente = false;
            this.visita.paziente_id = paziente.id;
            this.visita.paziente = paziente;
        },

        errorFor(field) {
            return null !== this.errors && this.errors[field]
                ? true
                : false;
        },
        sportItemTemplate(data) {
            return '<div class="flex justify-between"><span class="truncate">' + data.nome + '</span><span>' + data.tipo_visita + '</span></div>';
        },

        async salvaScheda()
        {
            this.fetching = true;
            //await axios.put()
            this.fetching = false;
        },

        anteprimaCertificato() {           
           window.electron.anteprimaCertificatoAgonisticoGiallo(this.visita.id)
        }
    },
};
</script>

