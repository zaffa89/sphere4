<template>
    <AppLayout :hideSidebar="false">
        <template #main>
            <div class="rounded-lg bg-white overflow-hidden shadow p-6">              
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a aliquam tortor, vel tristique mauris. Maecenas eu ipsum porta, rutrum urna eget, eleifend nunc. Mauris euismod, enim nec posuere gravida, sem massa ornare velit, sed facilisis sem ex eget sapien. Maecenas vehicula urna sed condimentum aliquam. In feugiat semper tortor quis ultrices. Aliquam nisl tortor, malesuada ac fermentum sed, congue vitae neque.               
            </div>
            
            <div class="rounded-lg bg-white overflow-hidden shadow p-6 flex-col flex gap-5">
                <div>
                    <h2 class="text-2xl font-medium text-gray-900">Medicina dello sport</h2>
                    <p class="mt-1 text-md text-gray-500">Quale tipo di visita vuoi prenotare?</p>
                    <ul role="list" class="mt-6 border-t border-gray-200 py-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <li v-for="(item, itemIdx) in sezione_1" :key="itemIdx" class="flow-root">
                            <div class="relative -m-2 p-2 flex items-center space-x-4 rounded-xl hover:bg-gray-50 focus-within:ring-2 focus-within:ring-indigo-500">
                                <div :class="[item.background, 'flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-lg']">
                                    <component :is="item.icon" class="h-6 w-6 text-white" aria-hidden="true" />
                                </div>
                                <div>
                                    <h3 class="text-xl font-medium text-gray-900">
                                        <Link :href="item.route" class="focus:outline-none">
                                            <span class="absolute inset-0" aria-hidden="true" />
                                            {{ item.title }}<span aria-hidden="true"> &rarr;</span>
                                        </Link>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">{{ item.description }}</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h2 class="text-2xl font-medium text-gray-900">Area medica</h2>
                    <p class="mt-1 text-md text-gray-500">Quale tipo di visita vuoi prenotare?</p>
                    <ul role="list" class="mt-6 border-t border-gray-200 py-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <li v-for="(item, itemIdx) in sezione_2" :key="itemIdx" class="flow-root">
                            <div class="relative -m-2 p-2 flex items-center space-x-4 rounded-xl hover:bg-gray-50 focus-within:ring-2 focus-within:ring-indigo-500">
                            <div :class="[item.background, 'flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-lg']">
                                <component :is="item.icon" class="h-6 w-6 text-white" aria-hidden="true" />
                            </div>
                            <div>
                                <h3 class="text-xl font-medium text-gray-900">
                                    <Link :href="item.route" class="focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true" />
                                        {{ item.title }}<span aria-hidden="true"> &rarr;</span>
                                    </Link>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">{{ item.description }}</p>
                            </div>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <div class="mt-4 flex">
                    <a href="#" class="text-md font-medium text-indigo-600 hover:text-indigo-500">Oppure premi qui se la visita richiesta non è in elenco<span aria-hidden="true"> &rarr;</span></a>
                </div>
            </div>                        
        </template>
        <template #side>
            <div class="rounded-lg bg-white overflow-hidden shadow">
                <div class="p-6">
                    
                </div>
            </div>
        </template>
    </AppLayout>
</template>

<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue';
   
    import { BookmarkIcon } from '@heroicons/vue/outline'
    import { Link } from '@inertiajs/inertia-vue3';
    import { Inertia } from '@inertiajs/inertia';

    const sezione_1 = [
        {
            title: 'Pratica Agonistica',
            description: 'Visite per il rilascio del certificato di idoneità alla pratica agonistica.',
            icon: BookmarkIcon,
            background: 'bg-pink-500',
            route: route('prenotazione.selezione.anagrafica')
        },
        {
            title: 'Pratica non agonistica',
            description: 'Visite per il rilascio del certificato di idoneità alla pratica sportiva non agonistica.',
            icon: BookmarkIcon,
            background: 'bg-yellow-500',
        },
        {
            title: 'Pratica agonistica per atleti diversamente abili',
            description: 'Great for mood boards and inspiration.',
            icon: BookmarkIcon,
            background: 'bg-green-500',
        },
        {
            title: 'Pratica agonistica POST COVID',
            description: 'Track tasks in different stages of your project.',
            icon: BookmarkIcon,
            background: 'bg-blue-500',
        },
        {
            title: 'Pratica agonistica RETURN TO PLAY (RTP)',
            description: 'Lots of numbers and things — good for nerds.',
            icon: BookmarkIcon,
            background: 'bg-indigo-500',
        },
    ]

    const sezione_2 = [
        {
            title: 'Cardiologia',
            description: 'Visite cardiologiche.',
            icon: BookmarkIcon,
            background: 'bg-pink-500',
        },
        {
            title: 'Fisioterapia',
            description: 'Altre visite di fisioterapia.',
            icon: BookmarkIcon,
            background: 'bg-yellow-500',
        },
        
    ]

    
</script>