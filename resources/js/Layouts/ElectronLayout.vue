<template>
        <Disclosure as="nav" class="bg-white shadow sticky top-0 z-50" v-slot="{ open }">
            <div class="mx-auto max-w-full px-2 sm:px-6 lg:px-8">
                <div class="relative flex h-16 justify-between">
                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                        <!-- Mobile menu button -->
                        <DisclosureButton
                            class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                            <span class="sr-only">Open main menu</span>
                            <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                            <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
                        </DisclosureButton>
                    </div>
                    <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                        <div class="flex flex-shrink-0 items-center">
                            <img class="block h-8 w-auto lg:hidden"
                                src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                                alt="Your Company" />
                            <img class="hidden h-8 w-auto lg:block"
                                src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                                alt="Your Company" />
                        </div>
                        <slot name="navigazione"></slot>                        
                    </div>
                    <div class="flex items-center">
                        <slot name="bottoneChiusuraForm">
                            
                        </slot>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                        <button type="button"
                            class="rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <span class="sr-only">View notifications</span>
                            <BellIcon class="h-6 w-6" aria-hidden="true" />
                        </button>

                        <!-- Profile dropdown -->
                        <Menu as="div" class="relative ml-3">
                            <div>
                                <MenuButton
                                    class="flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full"
                                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt="" />
                                </MenuButton>
                            </div>
                            <transition enter-active-class="transition ease-out duration-200"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95">
                                <MenuItems
                                    class="absolute right-0 z-50 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
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

            <DisclosurePanel class="sm:hidden">
                <div class="space-y-1 pt-2 pb-4">
                    <!-- Current: "bg-indigo-50 border-indigo-500 text-indigo-700", Default: "border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700" -->
                    <DisclosureButton as="a" href="#"
                        class="block border-l-4 border-indigo-500 bg-indigo-50 py-2 pl-3 pr-4 text-base font-medium text-indigo-700">
                        Dashboard</DisclosureButton>
                    <DisclosureButton as="a" href="#"
                        class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700">
                        Team</DisclosureButton>
                    <DisclosureButton as="a" href="#"
                        class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700">
                        Projects</DisclosureButton>
                    <DisclosureButton as="a" href="#"
                        class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700">
                        Calendar</DisclosureButton>
                </div>
            </DisclosurePanel>
        </Disclosure>
        <main class="w-full mx-auto p-4 overflow-hidden">
            <slot />          
        </main>
        <footer class="w-full mx-auto px-4 fixed bottom-0 border-t border-gray-200 text-gray-500 text-center text-sm h-10 items-center flex justify-center">          
            <span class="block sm:inline">&copy; 2023 Solution Med Srl.</span> <span class="block sm:inline">All rights reserved.</span>              
        </footer>
</template>

<script setup>
import { router } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3'

import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { Bars3Icon, BellIcon, XMarkIcon , ArrowLeftOnRectangleIcon , CogIcon , UserIcon } from '@heroicons/vue/24/outline'
</script>

<script>
export default {    
    data() {
        return {
            guestNavigation: [
                { name: 'Entra', href: '/login' },
                { name: 'Registrati', href: '/register' },
            ],            
        }
    },
    computed() {

    },
    methods: {        
        logout() {
            if(window.electron) {
                window.electron.eliminaMenu();
                //router.post(route('sphere.logout'))
            }
            else {
                router.post(route('logout'));
            }
            
        }
    }
}
</script>

<style scoped>
    main {
        height: calc(100vh - 104px) !important;
    }
</style>