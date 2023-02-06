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
        methods: {
            getElenco() {
             
            }
        },
        created() {

        }
    }
</script>