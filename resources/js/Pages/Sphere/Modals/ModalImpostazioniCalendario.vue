<template>
  <TransitionRoot
    as="template"
    :show="true"
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
              class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-3xl sm:p-6"
            >
              <div class="">
                <DialogTitle
                  as="h3"
                  class="text-lg font-medium leading-6 text-gray-900 text-center"
                >
                  Impostazioni calendario
                </DialogTitle>
                <div class="mt-2">
                  <div class="grid grid-cols-3 gap-5">
                    <div>
                      <label
                        for="durata-cella"
                        class="block text-sm font-medium text-gray-700"
                      >Durata righe
                        calendario</label>
                      <select
                        id="durata-cella"
                        :value="durataCella"
                        name="durata-cella"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                        @change="$emit('update:durataCella', parseInt($event.target.value))"
                      >
                        <option value="5">5 Minuti</option>
                        <option value="6">6 Minuti</option>
                        <option value="10">10 Minuti</option>
                        <option value="15">15 Minuti</option>
                        <option value="20">20 Minuti</option>
                        <option value="30">30 Minuti</option>
                        <option value="60">60 Minuti</option>
                      </select>
                    </div>
                    <div>
                      <label
                        for="ora-inizio-calendario"
                        class="block text-sm font-medium text-gray-700"
                      >Orario inizio
                        agenda</label>
                      <select
                        id="ora-inizio-calendario"
                        :value="oraInizioCalendario"
                        name="ora-inizio-calendario"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                        @change="$emit('update:oraInizioCalendario', parseInt($event.target.value))"
                      >
                        <option value="5">5:00</option>
                        <option value="6">6:00</option>
                        <option value="7">7:00</option>
                        <option value="8">8:00</option>
                        <option value="9">9:00</option>
                        <option value="10">10:00</option>
                        <option value="11">11:00</option>
                        <option value="12">12:00</option>
                      </select>
                    </div>
                    <div>
                      <label
                        for="ora-fine-calendario"
                        class="block text-sm font-medium text-gray-700"
                      >Ora fine agenda</label>
                      <select
                        id="ora-fine-calendario"
                        :value="oraFineCalendario"
                        name="ora-fine-calendario"
                        class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                        @change="$emit('update:oraFineCalendario', parseInt($event.target.value))"
                      >
                        <option value="13">13:00</option>
                        <option value="14">14:00</option>
                        <option value="15">15:00</option>
                        <option value="16">16:00</option>
                        <option value="17">17:00</option>
                        <option value="18">18:00</option>
                        <option value="19">19:00</option>
                        <option value="20">20:00</option>
                        <option value="21">21:00</option>
                        <option value="22">22:00</option>
                        <option value="23">23:00</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="mt-5 sm:mt-6">
                <button
                  type="button"
                  class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:text-sm"
                  @click="$emit('close')"
                >
                  Chiudi
                </button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { ref } from 'vue';
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { CheckIcon } from '@heroicons/vue/24/outline';


</script>

<script>

export default {
    props: {
        durataCella: {
            type: Number,
            default: 15,
        },
        oraInizioCalendario: Number,
        oraFineCalendario: Number,
    },
    emits: ['close', 'update:durataCella', 'update:oraInizioCalendario', 'update:oraFineCalendario'],
    data() {
        return {

        };
    },
    computed:
    {

    },
    created() {


    },
    methods: {

        async update() {

        },

    },
};

</script>
