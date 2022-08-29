<template>
    <AppLayout>
        <template #main>
            <div class="rounded-lg bg-white overflow-hidden shadow p-6">
                <h4 class="text-xl mb-4">Benvenuti nella prenotazione online di Solution Med Srl</h4>
                <p class="text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a aliquam tortor, vel tristique mauris. Maecenas eu ipsum porta, rutrum urna eget, eleifend nunc. Mauris euismod, enim nec posuere gravida, sem massa ornare velit, sed facilisis sem ex eget sapien. Maecenas vehicula urna sed condimentum aliquam. In feugiat semper tortor quis ultrices. Aliquam nisl tortor, malesuada ac fermentum sed, congue vitae neque.</p>
            </div>

            <div class="rounded-lg bg-white overflow-hidden shadow p-6" v-if="!$page.props.user">
                <h2 class="text-lg font-medium text-gray-900">Processo di prenotazione</h2>
                <p class="mt-1 text-sm text-gray-500">Per rendere il processo di prenotazione il più semplice possibile, è consigliato entrare o registrarsi subito.</p>
                <ul role="list" class="mt-6 border-t border-b border-gray-200 py-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <li v-for="(item, itemIdx) in not_logged_items" :key="itemIdx" class="flow-root">
                        <div class="relative -m-2 p-2 flex items-center space-x-4 rounded-xl hover:bg-gray-50 focus-within:ring-2 focus-within:ring-indigo-500">
                            <div :class="[item.background, 'flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-lg']">
                                <component :is="item.icon" class="h-6 w-6 text-white" aria-hidden="true" />
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">
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

            <div class="rounded-lg bg-white overflow-hidden shadow p-6" v-if="$page.props.user">
                <h2 class="text-lg font-medium text-gray-900">Prenota ora una visita</h2>
                <!-- <p class="mt-1 text-sm text-gray-500">Per rendere il processo di prenotazione il più semplice possibile, è consigliato entrare o registrarsi subito.</p> -->
                <ul role="list" class="mt-6 border-t border-b border-gray-200 py-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <li v-for="(item, itemIdx) in logged_items" :key="itemIdx" class="flow-root">
                        <div class="relative -m-2 p-2 flex items-center space-x-4 rounded-xl hover:bg-gray-50 focus-within:ring-2 focus-within:ring-indigo-500">
                            <div :class="[item.background, 'flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-lg']">
                                <component :is="item.icon" class="h-6 w-6 text-white" aria-hidden="true" />
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">
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
            
        </template>
        <template #side>
            <div class="rounded-lg bg-white overflow-hidden shadow">
                <div class="p-6">                                           
                    Modulistica
                </div>
                <div>
                    <button @click="provaApiProtetta()">API protetta</button>
                </div>
            </div>
        </template>
    </AppLayout>
</template>

<script>
export default {
    methods: {
        provaApiProtetta()
        {
            axios.get('/api/sphere/check-auth' , {
                headers: { Authorization : 'Bearer 3|RBeBzsRHxj6DubsuJU2b3XK0HxjB2pls7Tt8IvGG' }
            });
        }
    }    
}
</script>

<script setup>
    import AppLayout from '../Layouts/AppLayout.vue';
    import { Inertia } from '@inertiajs/inertia';
    import { Link } from '@inertiajs/inertia-vue3';

    import {
        LoginIcon,
        PencilAltIcon,
        ArrowCircleRightIcon,
        PlusCircleIcon
    } from '@heroicons/vue/outline';

const not_logged_items = [
  {
    title: 'Entra',
    description: 'Se hai già prenotato da noi, entra con il tuo profilo utente.',
    icon: LoginIcon,
    background: 'bg-pink-500',
    route: route('login')
  },
  {
    title: 'Registrati',
    description: 'Se è la prima volta che prenoti, registrati ora.',
    icon: PencilAltIcon,
    background: 'bg-yellow-500',
    route: route('register')
  },
  {
    title: 'Continua senza registrarti',
    description: 'Dovrai registrarti dopo aver scelto data e ora della visita.',
    icon: ArrowCircleRightIcon,
    background: 'bg-green-500',
    route: route('prenotazione.selezione.categoria')
  }
]

const logged_items = [
  {
    title: 'Prenota una visita',
    description: 'Clicca qui per procedere con una nuova prenotazione.',
    icon: PlusCircleIcon,
    background: 'bg-blue-600',
    route: route('prenotazione.selezione.categoria')
  },
  
]
</script>