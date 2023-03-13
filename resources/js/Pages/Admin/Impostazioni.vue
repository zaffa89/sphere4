<template>
    <AdminLayout>
        <div class="px-4 sm:px-6 md:px-0">
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">Impostazioni Sphere</h1>
        </div>

        <div class="py-6">
            <!-- Tabs -->
            <div class="lg:hidden">

                <select id="selected-tab" @change="currentTab = tab" name="selected-tab"
                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-purple-500 focus:outline-none focus:ring-purple-500 sm:text-sm">
                    <option v-for="tab in tabs" :key="tab" :selected="tab == currentTab">{{ tab }}</option>
                </select>
            </div>
            <div class="hidden lg:block">
                <div class="border-b border-gray-200">
                    <div class="-mb-px flex space-x-8">
                        <button @click="currentTab = tab" v-for="tab in tabs" :key="tab"
                            :class="[tab == currentTab ? 'border-purple-500 text-purple-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700', 'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm']">{{ tab }}</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-6" v-if="currentTab == 'Generale'">
            <div class="space-y-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Generale</h3>
                <p class="max-w-2xl text-sm text-gray-500">This information will be displayed publicly so be careful
                    what you share.</p>
            </div>
            <div class="mt-6">

            </div>
        </div>
        <div class="py-6" v-if="currentTab == 'Calendario'">
            <div class="space-y-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Calendario</h3>
                <p class="max-w-2xl text-sm text-gray-500">Impostazioni calendario e prenotazioni.</p>
            </div>
            <div class="mt-6">
                <div class="flex gap-5 mb-5 border p-6">
                    <div>
                        <label for="ora-inizio-agenda" class="block text-sm font-medium text-gray-700">Orario inizio
                            agenda</label>
                        <select v-model="$page.props.settings.ora_minima_calendario.value" id="ora-inizio-agenda"
                            name="ora-inizio-agenda"
                            class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
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
                        <label for="ora-fine-agenda" class="block text-sm font-medium text-gray-700">Orario fine
                            agenda</label>
                        <select v-model="$page.props.settings.ora_massima_calendario.value" id="ora-fine-agenda"
                            name="ora-fine-agenda"
                            class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
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
                    <div>
                        <label for="durata-cella" class="block text-sm font-medium text-gray-700">Durata cella
                            calendario</label>
                        <select id="durata-cella" v-model="$page.props.settings.durata_cella_calendario.value"
                            name="durata-cella"
                            class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <option value="5">5 Minuti</option>
                            <option value="6">6 Minuti</option>
                            <option value="10">10 Minuti</option>
                            <option value="15">15 Minuti</option>
                            <option value="20">20 Minuti</option>
                            <option value="30">30 Minuti</option>
                            <option value="60">60 Minuti</option>
                        </select>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6 border">
                    <dt class="text-sm font-medium text-gray-500">
                        {{ $page.props.settings.colore_prenotazione_medsport.description }}</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-1 sm:mt-0">
                        <input type="color" v-model="$page.props.settings.colore_prenotazione_medsport.value" />
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6 border">
                    <dt class="text-sm font-medium text-gray-500">
                        {{ $page.props.settings.colore_prenotazione_ambulatoriale.description }}</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-1 sm:mt-0">
                        <input type="color" v-model="$page.props.settings.colore_prenotazione_ambulatoriale.value" />
                    </dd>
                </div>
            </div>
        </div>
        <div class="py-6" v-if="currentTab == 'Colori'">
            <div class="space-y-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Colori</h3>
                <p class="max-w-2xl text-sm text-gray-500">This information will be displayed publicly so be careful
                    what you share.</p>
            </div>
            <div class="mt-6">

            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import AdminLayout from '../../Layouts/AdminLayout.vue';

</script>

<script>
export default {
    layout: AppLayout,
    data() {
        return {
            tabs: ['Generale', 'Calendario', 'Colori'],
            currentTab: 'Generale'
        }
    },

    methods: {
        save() {
            axios.put('/api/sphere/save-setting/1', [
                {
                    'name': 'Blu',
                    'code': '00F'
                }
            ]
            );
        }
    }
}
</script>