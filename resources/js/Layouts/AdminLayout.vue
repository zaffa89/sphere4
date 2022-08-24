<template>
    <div>
        <div class="max-w-screen-xl mx-auto pb-6 lg:pb-16">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="divide-y divide-gray-200 lg:grid lg:grid-cols-12 lg:divide-y-0 lg:divide-x">
                    <aside class="py-6 col-span-12 lg:col-span-3">
                        <nav class="space-y-1">
                            <Link v-for="item in menu_laterale" :key="item.name" :href="item.href" :class="[item.current ? 'bg-teal-50 border-teal-500 text-teal-700 hover:bg-teal-50 hover:text-teal-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900', 'group border-l-4 px-3 py-2 flex items-center text-sm font-medium']" :aria-current="item.current ? 'page' : undefined">
                            <component :is="item.icon" :class="[item.current ? 'text-teal-500 group-hover:text-teal-500' : 'text-gray-400 group-hover:text-gray-500', 'flex-shrink-0 -ml-1 mr-3 h-6 w-6']" aria-hidden="true" />
                            <span class="truncate">
                                {{ item.name }}
                            </span>
                            </Link>
                        </nav>
                    </aside>

                    <div class="divide-y divide-gray-200 col-span-12 lg:col-span-9 py-6">
                        <slot />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script setup>
    import { Link } from '@inertiajs/inertia-vue3';
    import {
        BellIcon,
        CogIcon,
        CreditCardIcon,
        KeyIcon,
        MenuIcon,
        UserCircleIcon,
        ViewGridAddIcon,
        XIcon,
    } from '@heroicons/vue/outline'
    const menu_laterale = [
        { name: 'Generale', href: route('admin'), icon: UserCircleIcon, current: route().current('admin') },
        { name: 'Utenti', href: route('admin.utenti'), icon: KeyIcon, current: route().current('admin.utenti') },
        { name: 'Impostazioni', href: route('admin.impostazioni'), icon: CogIcon, current: route().current('admin.impostazioni') },
        { name: 'Notifiche', href: route('admin.notifiche'), icon: BellIcon, current: route().current('admin.notifiche') },
        { name: 'Pagamenti', href: route('admin.pagamenti'), icon: CreditCardIcon, current: route().current('admin.pagamenti') },
        { name: 'Integrazioni', href: route('admin.integrazioni'), icon: ViewGridAddIcon, current: route().current('admin.integrazioni') },
    ]
</script>