<?php
/*
    IMPOSTAZIONI APPLICAZIONE SPHERE
*/
return [
    'codice_paziente' => 'automatico', // automatico: uguale a paziente_id / visita: vuoto e generato alla prima visita / manuale: totalmente manuale
    'numero_cartella' => 'codice-paziente', //codice-paziente: uguale a codice paziente / numeratore: usa il numeratore numero_cartella

    /*
        IDONEITA'
        automatica: imposta idoneo all'accettazione e genera subito il numero certificato
        medico: idoneità da parte del medico a visita conclusa, il numero certificato verrà generato al momento dell'idoneità
    */
    'idoneita' => 'automatica',

    /*
        CERTIFICATI AGONISTICI
        automatico: usa numeratore progressivo "certificato"
        manuale: impostato manualmente dall'utente
    */
    'numero-certificato' => 'automatico',
    'societa_obbligatoria' => false,

    /*
        CERTIFICATI NON AGONISTICI
    */
    'numero-certificato-bs' => true, //se true genera il numero certificato per le visite non agonistiche utilizzando il numeratore "certificato-bs" se presente

    'mesi_scadenza_default' => 12, //mesi scadenza default per visite ms



];