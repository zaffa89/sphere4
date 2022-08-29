<template>
    <AppLayout :hideSidebar="false">
        <template #main>
            <div class="rounded-lg bg-white overflow-hidden shadow p-6">              
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a aliquam tortor, vel tristique mauris. Maecenas eu ipsum porta, rutrum urna eget, eleifend nunc. Mauris euismod, enim nec posuere gravida, sem massa ornare velit, sed facilisis sem ex eget sapien. Maecenas vehicula urna sed condimentum aliquam. In feugiat semper tortor quis ultrices. Aliquam nisl tortor, malesuada ac fermentum sed, congue vitae neque.               
            </div>
            
            <div class="rounded-lg bg-white overflow-hidden shadow p-6 flex-col flex gap-5">
                
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
    
    import { usePrenotazioneUtenteStore } from '@/stores/PrenotazioneUtenteStore';

    // store to refs mantiene reactive l'oggetto esportato dallo store
    //import { storeToReps } from 'pinia'
    //const { prova } = storeToRefs(usePrenotazioneUtenteStore());

    const prenotazione = usePrenotazioneUtenteStore();
</script>