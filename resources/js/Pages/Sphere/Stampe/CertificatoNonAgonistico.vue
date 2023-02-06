<template>
    <div class="bg-gray-200">
        <div class="container max-w-3xl h-screen mx-auto flex flex-col content-between bg-white">
            <div class="flex justify-between">
                <img src="/storage/logo_struttura.png" class="w-60" />
                <div class="flex flex-col font-bold text-sm">
                    <span>Solution Med Srl</span>
                    <span>26100 Cremona (CR)</span>
                    <span>Via Giulio Ratti , 2</span>
                    <span>0372 027 380</span>
                    <span>info@solutionmed.it</span>
                </div>
            </div>
            
            <div class="flex flex-1 flex-col gap-6 mt-10">
                <div class="flex flex-col text-center font-bold">
                    <span>CERTIFICATO D I IDONEITA ' ALLA PRATICA</span>
                    <span>SPORTIVA D I TIPO NON AGONISTICO</span>
                    <span>D.M . 24 Aprile 2013</span>
                </div>
                <div>
                    Nato a: {{ $page.props.data.paziente.ragione_sociale }}
                </div>
    
                <div class="mt-2">
                    SPORT PRATICATO: <span class="uppercase">{{ $page.props.data.sport.nome }}</span>
                </div>
                
                <div>
                    MEDICO: <span class="capitalize">{{ $page.props.data.medico.ragione_sociale}}</span>
                </div>            
            </div>
            <div class="flex justify-between">
                <span>Cremona, GG/MM/AAAA</span>
                <div class="h-20 text-center">
                    <p>TIMBRO E FIRMA DEL MEDICO</p>
                    <div class="flex flex-col text-center">
                        <span>DOTT. ZAFFONE</span>
                        <span>SPEC. IN MED. DELLO SPORT</span>
                        <span>CF. ZFFNHL89C17D150M</span>
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="w-full">
                    asd
                </div>
            </div>

        </div>
    </div>    
</template>

<style>
    .page {               
        width: 29.7cm;
        height: 42cm;
    }
</style>
<script setup>

</script>