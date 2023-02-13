<template>
  <TransitionRoot
    :show="open"
    as="template"
    appear
    @after-leave="query = ''"
  >
    <Dialog
      as="div"
      class="relative z-50"
      @close="open = false"
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
        <div class="fixed inset-0 bg-gray-500 bg-opacity-25 transition-opacity" />
      </TransitionChild>
  
      <div class="fixed inset-0 z-10 overflow-y-auto p-4 sm:p-6 md:p-20">
        <TransitionChild
          as="template"
          enter="ease-out duration-300"
          enter-from="opacity-0 scale-95"
          enter-to="opacity-100 scale-100"
          leave="ease-in duration-200"
          leave-from="opacity-100 scale-100"
          leave-to="opacity-0 scale-95"
        >
          <DialogPanel class="mx-auto max-w-xl transform divide-y divide-gray-100 overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 transition-all">
            <Combobox @update:modelValue="onSelect">
              <div class="relative">
                <MagnifyingGlassIcon
                  class="pointer-events-none absolute top-3.5 left-4 h-5 w-5 text-gray-400"
                  aria-hidden="true"
                />
                <ComboboxInput
                  class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-800 placeholder-gray-400 focus:ring-0 sm:text-sm"
                  placeholder="Search..."
                  @change="debouncedRicerca($event.target.value)"
                />
              </div>
  
              <ComboboxOptions
                v-if="state.filteredPeople && state.filteredPeople.length > 0"
                static
                class="max-h-72 scroll-py-2 overflow-y-auto py-2 text-sm text-gray-800"
              >
                <ComboboxOption
                  v-for="person in state.filteredPeople"
                  :key="person.id"
                  v-slot="{ active }"
                  :value="person"
                  as="template"
                >
                  <li :class="['flex justify-between cursor-default select-none px-4 py-2', active && 'bg-indigo-600 text-white']">
                    <span>{{ person.ragione_sociale }}</span><span>{{ dateFormat(person.data_nascita) }} - {{ person.visite_medsport_count }} visite</span>
                  </li>
                </ComboboxOption>
              </ComboboxOptions>
   
              <p
                v-if="state.filteredPeople && state.filteredPeople.length === 0"
                class="p-4 text-sm text-gray-500"
              >
                Nessun atleta trovato
              </p>
            </Combobox>
          </DialogPanel>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>
</template>
  
  <script setup>
  import { dateFormat } from '@utilities/dateUtilities';
  import { computed, ref , reactive } from 'vue';
  import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid';
  import {
    Combobox,
    ComboboxInput,
    ComboboxOptions,
    ComboboxOption,
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
  } from '@headlessui/vue';
  
  const people = [
    { id: 1, name: 'Leslie Alexander', url: '#' },
    // More people...
  ];
  
  const open = ref(true);
  const query = ref('');

  const state = reactive({
    filteredPeople : null,
    empty: false,
  });
  
  const emit = defineEmits(['selection']);
  function ricerca(query)
  {    
    query.trim().length > 0
    ? axios.get(`api/sphere/ricerca-paziente/${query}`).then(response => { state.filteredPeople = response.data; }).catch(err => { state.filteredPeople = []; state.empty = true; })
    : state.filteredPeople = null;
  }

  function onSelect(person) {
    emit('selection' , person);
  }

  const debouncedRicerca = _.debounce(ricerca , 300);
  </script>