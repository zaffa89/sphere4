<template>
    <div class="h-full">
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog as="div" class="relative z-40" @close="sidebarOpen = false" :unmount="false"> <!-- lg:hidden -->
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0"
                    enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100"
                    leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-600 bg-opacity-75" />
                </TransitionChild>

                <div class="fixed inset-0 z-40 flex">
                    <TransitionChild as="template" enter="transition ease-in-out duration-300 transform"
                        enter-from="-translate-x-full" enter-to="translate-x-0"
                        leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0"
                        leave-to="-translate-x-full">
                        <DialogPanel class="relative flex w-full max-w-xs flex-1 flex-col bg-white pt-5 pb-4">
                            <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0"
                                enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100"
                                leave-to="opacity-0">
                                <div class="absolute top-0 right-0 -mr-12 pt-2">
                                    <button type="button"
                                        class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                        @click="sidebarOpen = false">
                                        <span class="sr-only">Close sidebar</span>
                                        <XMarkIcon class="h-6 w-6 text-white" aria-hidden="true" />
                                    </button>
                                </div>
                            </TransitionChild>
                            <div class="flex flex-shrink-0 items-center px-4">
                                <img class="h-8 w-auto"
                                    src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                                    alt="Your Company" />
                            </div>
                            <div class="mt-5 h-0 flex-1 overflow-y-auto">
                                <!-- sidebar browser -->
                                <nav class="flex-1 space-y-1 bg-white px-2" aria-label="Sidebar">
                                    <template v-for="item in browserSidebarItems" :key="item.name">
                                        <div v-if="!item.children">
                                            <button @click="emit('activateForm' , item) , sidebarOpen = false"
                                                :class="[item.name === props.currentTab?.name ? 'bg-gray-200 text-gray-900' : 'bg-white text-gray-600 hover:bg-gray-50 hover:text-gray-900', 'group flex w-full items-center rounded-md py-2 pl-2 text-sm font-medium']">
                                                <component :is="item.icon"
                                                    :class="[item.current ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500', 'mr-3 h-6 w-6 flex-shrink-0']"
                                                    aria-hidden="true" />
                                                {{ item.name }}
                                        </button>
                                        </div>
                                        <Disclosure as="div" v-else class="space-y-1" v-slot="{ open }">
                                            <DisclosureButton
                                                :class="[item.current ? 'bg-gray-100 text-gray-900' : 'bg-white text-gray-600 hover:bg-gray-50 hover:text-gray-900', 'group flex w-full items-center rounded-md py-2 pl-2 pr-1 text-left text-sm font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500']">
                                                <component :is="item.icon"
                                                    class="mr-3 h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                                    aria-hidden="true" />
                                                <span class="flex-1">{{ item.name }}</span>
                                                <svg :class="[open ? 'rotate-90 text-gray-400' : 'text-gray-300', 'ml-3 h-5 w-5 flex-shrink-0 transform transition-colors duration-150 ease-in-out group-hover:text-gray-400']"
                                                    viewBox="0 0 20 20" aria-hidden="true">
                                                    <path d="M6 6L14 10L6 14V6Z" fill="currentColor" />
                                                </svg>
                                            </DisclosureButton>
                                            <DisclosurePanel class="space-y-1">
                                                <button v-for="subItem in item.children" :key="subItem.name" as="button"
                                                    @click="emit('activateForm' , subItem) , sidebarOpen = false"
                                                    :class="[subItem.name === props.currentTab?.name ? 'bg-gray-200 text-gray-900' : 'bg-white text-gray-600 hover:bg-gray-50 hover:text-gray-900' , 'group flex w-full items-center rounded-md py-2 pl-11 pr-2 text-sm font-medium']">
                                                    {{ subItem.name }}
                                                </button>
                                            </DisclosurePanel>
                                        </Disclosure>
                                    </template>
                                </nav>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                    <div class="w-14 flex-shrink-0">
                        <!-- Dummy element to force sidebar to shrink to fit close icon -->
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>

       
        <!-- <div class="lg:pl-64 h-full"> -->
        <div class="h-full">
            <div class="mx-auto flex flex-col browser-container">
                <div class="sticky top-0 z-10 flex h-16 flex-shrink-0 border-b border-gray-200 bg-white">
                    <button type="button" v-if="!electronClient"
                        class="border-r border-gray-200 px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" 
                        @click="sidebarOpen = true">
                        <span class="sr-only">Open sidebar</span>
                        <Bars3BottomLeftIcon class="h-6 w-6" aria-hidden="true" />
                    </button>
                    <div class="flex flex-1 justify-between px-4 lg:px-4">
                        <div class="flex flex-1">
                            <slot name="navigazione" />
                        </div>
                        <div class="flex items-center">
                            <slot name="bottoneChiusuraForm" />                                                            
                        </div>
                        <div class="ml-4 flex items-center lg:ml-6">
                            <button type="button"
                                class="rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <span class="sr-only">View notifications</span>
                                <BellIcon class="h-6 w-6" aria-hidden="true" />
                            </button>

                            <!-- Profile dropdown -->
                            <Menu as="div" class="relative ml-3">
                                <div>
                                    <MenuButton
                                        class="flex max-w-xs items-center rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full"
                                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                            alt="" />
                                    </MenuButton>
                                </div>
                                <transition enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95">
                                    <MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                            <MenuItem v-slot="{ active }">
                                            <a href="#"
                                                :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
                                                <UserIcon class="inline h-6 w-6" aria-hidden="true" />
                                                Profilo utente
                                            </a>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                            <a href="#"
                                                :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
                                                <CogIcon class="inline h-6 w-6" aria-hidden="true" />
                                                Preferenze
                                            </a>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                            <button @click="logout"
                                                :class="[active ? 'bg-gray-100' : '', 'w-full text-left block px-4 py-2 text-sm text-gray-700']">
                                                <ArrowLeftOnRectangleIcon class="inline h-6 w-6" aria-hidden="true" />
                                                Esci                                        
                                            </button>
                                        </MenuItem>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </div>
                    </div>
                </div>

                <main class="w-full mx-auto p-4 overflow-hidden h-full">
                    <slot />          
                </main>
            </div>            
        </div>
        <footer class="w-full mx-auto px-4 fixed bottom-0 border-t border-gray-200 text-gray-500 text-center text-sm h-10 items-center flex justify-center">          
            <span class="block sm:inline">&copy; 2023 Solution Med Srl.</span> <span class="block sm:inline">All rights reserved.</span>              
        </footer>
    </div>
</template>
  
<script setup>
import { ref } from 'vue'
import {
    Dialog,
    DialogPanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
    Disclosure,
    DisclosureButton, 
    DisclosurePanel
} from '@headlessui/vue'

import {
    Bars3BottomLeftIcon,
    BellIcon,
    XMarkIcon,
    ArrowLeftOnRectangleIcon , 
    CogIcon , 
    UserIcon,
    HomeIcon,
    CalendarIcon,
    FolderIcon,
    UsersIcon,
    InboxIcon,
    ChartBarIcon,
    Cog6ToothIcon
} from '@heroicons/vue/24/outline'
import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid'

const sidebarOpen = ref(false)
const electronClient = window.electron ? true : false

const props = defineProps({currentTab: Object})
const emit = defineEmits(['activateForm'])

const browserSidebarItems = [
    { name: 'Homepage', icon: HomeIcon, component: "FormHome" },
    {
        name: 'Agenda',
        icon: CalendarIcon,
      
        children: [
            { name: 'Calendario', component: "FormBryntumCalendar" },
            { name: 'Ricerca prenotazioni', component: null },
            { name: 'Altro', component: null }           
        ],
    },
    {
        name: 'Accettazione',
        icon: FolderIcon,
       
        children: [
            { name: 'Medsport', component: "FormAccettazioneMedsport" },
            { name: 'Ambulatoriale', component: null }            
        ],
    },    
    {
        name: 'Anagrafiche',
        icon: UsersIcon,
       
        children: [
            { name: 'Pazienti', component: "FormPazienti" },
            { name: 'Medici', component: "FormMedici" },
            { name: 'Ambulatori', component: "FormAmbulatori" },
            { name: 'Società sportive', component: "FormSocieta" },
            { name: 'Aziende', component: null },                        
        ],
    },
    {
        name: 'Contabilità',
        icon: InboxIcon,
        
        children: [
            { name: 'Chiusura cassa', component: null },
            { name: 'Precompilato 730', component: null },
            { name: 'Tracciati', component: null },            
        ],
    },
    {
        name: 'Reports',
        icon: ChartBarIcon,
       
        children: [
            { name: 'Overview', component: null },
            { name: 'Members', component: null },
            { name: 'Calendar', component: null },
            { name: 'Settings', component: null },
        ],
    },
    {
        name: 'Utility',
        icon: Cog6ToothIcon,
        children: [
            { name: 'Gestione prestazioni' , component: "FormGestionePrestazioni" },
            { name: 'Gestione numeratori' , component: "FormGestioneNumeratori" },
        ]
    }
]

</script>