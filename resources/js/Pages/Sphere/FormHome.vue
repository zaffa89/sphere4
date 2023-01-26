<template>
    <div>
        <div class="grid grid-cols-2 gap-4">
            <div class="flex flex-col border bg-white p-4">
                <button
                    type="button"
                    class="w-40 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    @click="letturaTessera"
                    >
                    Leggi tessera sanitaria
                </button>
                {{ dati_tessera }}
            </div>

            <div class="flex flex-col border bg-white p-4">
                <button
                    type="button"
                    class="w-40 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    @click="stampaCertificato"
                    >
                    Stampa certificato
                </button>
            </div>

            <div class="flex flex-col border bg-white p-4">
                <button
                    type="button"
                    class="w-40 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    @click="apriFormStampe"
                    >
                    Apri stampe
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                dati_tessera: null,
            }
        },
        methods: {
            letturaTessera() {
                if(window.electron) {
                    window.electron.leggiTessera().then(response => {
                        this.dati_tessera = response;
                        console.log(this.dati_tessera);
                    });
                }
            },
            apriFormStampe() {
                if(window.electron) window.electron.apriMascheraStampa()
                
            },
            stampaCertificato() {
                console.log('inizio stampa')
                window.electron.stampaCertificato()
            }
        }
    }
</script>