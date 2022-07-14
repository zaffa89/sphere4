import { defineStore } from 'pinia'

export const usePrenotazioneUtenteStore = defineStore('PrenotazioneUtenteStore' , {
    
    state: () => {
        return {
            dataNascita: '',
            sesso: null
        }
    }
});

