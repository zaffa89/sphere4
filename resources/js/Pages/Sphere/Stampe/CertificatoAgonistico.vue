<template>
    <div class="container max-w-2xl mx-auto">
        <div class="flex justify-between">
            <img src="/storage/logo_struttura.png" class="w-60" />
            <div>
                <span>TIMBRO E CAGATINE</span>
            </div>
        </div>
        
        <div class="flex flex-col gap-5 mt-10">
            <div>
                ATLETA: {{ $page.props.data.paziente.ragione_sociale }}
            </div>

            <div>
                SPORT PRATICATO: <span class="uppercase">{{ $page.props.data.sport.nome }}</span>
            </div>
            
            <div>
                MEDICO: <span class="capitalize">{{ $page.props.data.medico.ragione_sociale}}</span>
            </div>            
        </div>
        <div class="flex justify-between">
            <span>Data e ora</span>
            <span>Firma del medico</span>
        </div>
        
    </div>
</template>

<script setup>

</script>