<template>
    <div>
        Maschera stampa
        <br>
        <button @click="getElenco()">Get elenco</button>
        {{ elencoStampanti }}
    </div>
</template>

<script setup>
    
</script>

<script>
    export default {
        data() {
            return {
                elencoStampanti: []
            }
        },
        created() {
            if(window.electron) {
                    window.electron.getElencoStampanti().then(response => {
                        this.elencoStampanti = response;
                        console.log(this.elencoStampanti);
                    });
                }
        }
    }
</script>