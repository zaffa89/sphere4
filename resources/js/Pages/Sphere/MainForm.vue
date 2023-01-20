<template>
    <div>
        Main form client sphere

        <button
      type="button"
      class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
      @click="letturaTessera"
    >
      Leggi tessera sanitaria
    </button>
    {{ dati_tessera }}
    
    </div>
</template>

<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';


</script>

<script>
    export default {
        emits: ['notify'],
        layout: AppLayout,
        data() {
            return {
                dati_tessera : null,
            };
        },
        mounted() {
            console.log(window)
        },
        methods: {
            letturaTessera() {
                window.electron.leggiTessera().then(response => {
                    this.dati_tessera = response;
                    console.log(this.dati_tessera);
                });            
            },
        },
    };
</script>