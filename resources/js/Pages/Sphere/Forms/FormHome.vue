<template>
           
        <div class="grid grid-cols-2 gap-4">
            <div class="flex flex-col border bg-white p-4">
                <button type="button"
                    class="w-40 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    @click="letturaTessera">
                    Leggi tessera sanitaria
                </button>
                {{ dati_tessera }}
            </div>

            <div class="flex flex-col gap-2 border bg-white p-4">
                <button type="button"
                    class="w-40 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    @click="generaCertificatoNonAgonistico">
                    genera certificato
                </button>

                <button type="button"
                    class="w-40 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    @click="generaCertificatoGiallo">
                    genera giallo
                </button>

                <button type="button"
                    class="w-40 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    @click="generaCertificatoRosso">
                    genera rosso
                </button>

                <button type="button"
                    class="w-40 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    @click="generaSchedaAtleta">
                    genera scheda
                </button>

            </div>

            <div class="flex flex-col border bg-white p-4">
                <button type="button"
                    class="w-40 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    @click="anteprimaCertificato">
                    anteprimaCertificato
                </button>
            </div>
            <div class="flex flex-col border bg-white p-4">
                <button type="button"
                    class="w-40 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    @click="apriAllegati">
                    Apri allegati zaffa ( locale )
                </button>
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
            if (window.electron) {
                window.electron.leggiTessera().then(response => {
                    this.dati_tessera = response;
                    console.log(this.dati_tessera);
                });
            }
        },
        apriAllegati() {
            if (window.electron) window.electron.apriAllegati(4001)

        },
        generaCertificatoNonAgonistico() {
            window.electron.generaCertificatoNonAgonistico(4669, 4001)
        },
        generaCertificatoGiallo() {
            window.electron.generaCertificatoAgonisticoGiallo(4669, 4001)
        },
        generaCertificatoRosso() {
            window.electron.generaCertificatoAgonisticoRosso(4669, 4001)
        },
        generaSchedaAtleta() {
            window.electron.generaSchedaAtleta(4669, 4001)
        },
        anteprimaCertificato() {
            window.electron.anteprimaCertificatoAgonisticoGiallo(1339)
        }
    }
}
</script>