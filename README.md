## BACKEND SPHERE 4

## generale
- menu da browser e mobile da rivedere
- impostazioni app, calendario, colori e altro ( spostare impostazioni calendario in global $page )



## calendario
- fix prenotazioni.lenght > 0 nella FormCalendario
- impostazioni notifiche, avviso notifiche disabilitate, altro
- 


## prenotazione e accettazione medsport
- separare metodi classe prenotazione in base a sezione_visita
- verifica ultima visita
- verifica ultima prenotazione no-show
- durate di default? 

## accettazioni
- data corrente
- accettazioni senza prenotazione
- verifica dati anagrafici
- idoneità
- esami previsti
- certificati aggiuntivi
- numeri cartella
- numeri certificato
- controllo visita con sport aggiuntivi
- visita conclusa ( flag da parte del medico ) . Disabilita dati medici e anamnesi.

## statistiche

## griglie
- salvataggio profili
- maschera di ricerca nel footer

## certificati
- impostare w-[Xcm] , h-[Xcm] e overflow-hidden a tutti campi
- settare lettura firme su tutti i certificati
- opzioni campi ?

## notifiche
- view mail di prenotazione
- view mail di reminder
- view mail scadenze
- view mail di marketing ?

- SMS prenotazione
- SMS reminder
- SMS scadenze



## accettazione effettuata

- flag accettata. Rendi visibile al medico le sue visite accettate ( possibilità di vedere le proprie visite non accettate )
- alcuni medici possono vedere tutto

## codice_paziente MS
opzioni:
    - uguale a paziente_id
    - vuoto e generato successivamente    

## numero cartella visita
- assegnato all'accettazione 
opzioni:
    - uguale a codice_paziente , se codice_paziente è vuoto -> generarlo
    - numeratore indipendente della visita ( numero visita ) / progressivo o annuale
varianti
    - distinzione numero cartella ago e non ago
    - numero cartella solo per ago

DEFAULT paziente_id <- codice <- numero_cartella

## numero visita
    - numeratore annuale
    - numero giornaliero

## idoneità
    - idoneità automatica all'accettazione / idoneità la da il medico
    - idoneità sport aggiuntivi = idoneità sport principale

## non idoneità e sospeso
    - pulire numero certificato

## numero certificato        
    - numero progressivo ( lombardia )
    - numero certificato giornaliero data/numero

    - assegnato all'idoneità ( no privati, no miliari )
    - data_scadenza ( somma con validità mesi , flag se data_visita o data_certificato )
    - validità in mesi ( modificabile )


## storico e gdpr
- creare model e migrations per gli storici ( prenotazione* , visita , ...? )
- usare model events in booted

## vedere permessi medico sulle visite

## sistema notifiche, controllo jobs e servizio attivo. stistiche invio mail

## sistema richiesta modifiche / assistenza

## dashboard per noi. Per assistenza, statistiche e altro, connessa a tutte le installazioni

## area società sportive

## referti online