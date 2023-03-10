<template>    
    <div class="h-full">            
        <bryntum-calendar v-if="isLoaded"
            ref="calendar"
            :config="calendarConfig"            
            :crudManager="crudManager"
           

            :onEventClick="onEventClick"
            :onBeforeEventEdit="onBeforeEventEdit"
            :onBeforeDragResizeEnd="onBeforeDragResizeEnd"
            :onBeforeDragMoveEnd="onBeforeDragMoveEnd"
            :onDateChange="onDateChange"
            :onActiveItemChange="onActiveItemChange"
           
            :onEventContextMenu="onEventContextMenu"

            :onBeforeEventDelete="onBeforeEventDelete"              
            :onAfterEventSave="consoleEvent"
            :features="features"
            :sidebar="sidebar"
        

        />
        <ModalPrenotazioneMedsport
            v-if="modalData?.sezione_visita == 'M'"
            :appointment-data="modalData"
            @close="chiudiAppuntamento"
            @store="addPrenotazione"
            @update="updatePrenotazione"
        />

        <ModalPrenotazioneMedsportSocieta
            v-if="modalData?.sezione_visita == 'SM'"
            :appointment-data="modalData"
            @close="chiudiAppuntamento"
            @store="addPrenotazione"
            @update="updatePrenotazione"
        />

        <ModalPrenotazioneAmbulatoriale
            v-if="modalData?.sezione_visita == 'A'"
            :appointment-data="modalData"
            @close="chiudiAppuntamento"
            @store="addPrenotazione"
            @update="updatePrenotazione"
        />

        <ModalNotaCalendario
            v-if="modalData?.sezione_visita == 'N'"
            :appointment-data="modalData"
            @close="chiudiAppuntamento"
            @store="addPrenotazione"
            @update="updatePrenotazione"
        />

        <ModalAssenzaCalendario
            v-if="modalData?.sezione_visita == 'X'"
            :appointment-data="modalData"
            @close="chiudiAppuntamento"
            @store="addPrenotazione"
            @update="updatePrenotazione"
        />

        <ModalConfermaEliminazione
            v-if="deleteDialog"
            @close="deleteDialog = null"
            @delete="eliminaAppuntamento"
        />
    </div>
</template>

<script>
    import { ref, reactive, onMounted } from 'vue';    
    import '@bryntum/calendar/locales/calendar.locale.It';

    import { CrudManager , Toast , LocaleManager , StringHelper , DateHelper } from '@bryntum/calendar'
    import {
        BryntumCalendar
    } from '@bryntum/calendar-vue-3';

    import { useCalendarConfig } from './CalendarConfig';

    import ModalPrenotazioneMedsport from '@modals/Calendario/ModalPrenotazioneMedsport.vue';
    import ModalPrenotazioneAmbulatoriale from '@modals/Calendario/ModalPrenotazioneAmbulatoriale.vue'
    import ModalPrenotazioneMedsportSocieta from '@modals/Calendario/ModalPrenotazioneMedsportSocieta.vue';
    import ModalNotaCalendario from '@modals/Calendario/ModalNotaCalendario.vue';
    import ModalAssenzaCalendario from '@modals/Calendario/ModalAssenzaCalendario.vue';

    import ModalConfermaEliminazione from '@modals/ModalConfermaEliminazione.vue';
    

    export default {
        components : {
            BryntumCalendar,
            ModalPrenotazioneMedsport,
            ModalPrenotazioneAmbulatoriale,
            ModalPrenotazioneMedsportSocieta,
            ModalNotaCalendario,
            ModalAssenzaCalendario,
            ModalConfermaEliminazione
        },
        methods: {
            
            onEventContextMenu() {
                return false
            },
            consoleEvent(e) { 
                console.log(e) 
            },                       
            apriAppuntamento(data)
            {
                this.modalData = data;
            },
            chiudiAppuntamento()
            {
                this.modalData = null;
            },
            onBeforeEventDelete({eventRecords}) {                
                this.deleteDialog = eventRecords[0]
                return false                
            },
            eliminaAppuntamento()
            {                                
                axios.delete(`api/sphere/prenotazione/${this.deleteDialog.data.prenotazione_id}`).then(() => {                    
                    this.crudManager.eventStore.getById(this.deleteDialog.data.id).remove()
                    this.deleteDialog = null
                }).catch(() => {
                    this.deleteDialog = null
                });                                                
            },
            addPrenotazione(e) {
                //console.log('add ' + e.id)
                this.crudManager.eventStore.add(e)
                this.modalData = null;
            },
            updatePrenotazione(e) {
                //console.log('update' + e.id)
                this.crudManager.eventStore.getById(e.id).set(e)
                this.modalData = null;
            },
            onActiveItemChange(e) { //cambio view . caricare roba ?
                console.log(e)
            },
            onEventClick(e) {
                //         
            },            
            onBeforeEventEdit(e) {                                              
                this.apriAppuntamento(e.eventRecord.data)
                return false                
            },
            async onBeforeDragMoveEnd(e) {
                //console.log('spostamento')
                //console.log(e)

                //const medico_id = crudManager.timeRangeStore.find(orario => { return dayjs(e.date).isBetween(orario.data.startDate, orario.data.endDate, null, '[]') && orario.data.resourceId == e.resourceRecord.data.id })?.data.medico_id ?? null
                
                const medico_id = null //da vedere

                return await axios.put(`api/sphere/calendario/sposta-prenotazione/${e.eventRecord.data.prenotazione_id}`, { 
                    startDate: dayjs(e.eventRecord.data.startDate).format('YYYY-MM-DD HH:mm:ss'),
                    endDate: dayjs(e.eventRecord.data.endDate).format('YYYY-MM-DD HH:mm:ss'),
                    resourceId : e.view.resourceId,
                    medico_id
                })
                .then(() => { return true; })
                .catch(() => { return false; });
                //return false
            },
            onBeforeDragResizeEnd({eventRecord}){
                console.log('resize')
                console.log(eventRecord)
                return axios.put(`api/sphere/calendario/resize-prenotazione/${eventRecord.data.prenotazione_id}`, { 
                    startDate: dayjs(eventRecord.data.startDate).format('YYYY-MM-DD HH:mm:ss'),
                    endDate: dayjs(eventRecord.data.endDate).format('YYYY-MM-DD HH:mm:ss'),                                        
                })
                .then(() => { return true; })
                .catch(() => { return false; });
            },            
            
        },
        setup() {
            let datepickerData = [];
            const isLoaded = ref(false)
            const calendar = ref(null)
            const modalData = ref(null)
            const deleteDialog = ref(null)
            const calendarConfig = reactive(useCalendarConfig());
                        
            const crudManager = new CrudManager({
                loadUrl : 'api/sphere/calendario/bryntum/on-demand',
                autoLoad  : false,
                //syncUrl: 'nope',
                //autoSync: true                                
            });

            function nuovaPrenotazione(e , sezione_visita) {
                //console.log(e)
                console.log(sezione_visita)
                const medico_id = crudManager.resourceTimeRangeStore.find(orario => { return dayjs(e.date).isBetween(orario.data.startDate, orario.data.endDate, null, '[]') && orario.data.resourceId == e.resourceRecord.data.id })?.data.medico_id ?? null
                console.log(medico_id)
                //calcolo floor ??
                modalData.value = {                    
                    startDate : dayjs(e.date).format('YYYY-MM-DD HH:mm:ss'),
                    sezione_visita,
                    resourceId: e.resourceRecord.data.id,
                    struttura_id: 1,
                    medico_id
                }
            }
            
            const features = {
                eventTooltip : {                 
                    align: 'l-r',
                    listeners : {
                        beforeShow({source}) {        
                            
                            source.tools.delete = false;

                            return source.ownerFeature.eventRecord.data.sezione_visita !== 'ORARIO'
                        }
                    },
                    
                    
                    renderer: data => {
                        console.log(data.eventRecord.data)
                        const asd = `<div class="flex flex-col gap-2">
                                        <div class="flex gap-2 items-center">
                                            <i class="b-fa-solid b-fa-clock"></i> ${DateHelper.format(data.eventRecord.startDate, 'LT')} - ${DateHelper.format(data.eventRecord.endDate, 'LT')}
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <div class="b-cal-tooltip-duration b-icon b-icon-duration">${DateHelper.getDurationInUnit(data.eventRecord.data.startDate, data.eventRecord.data.endDate , 'minutes')} minuti</div>
                                        </div>
                                    </div>`
                        
                        return `<div class="flex flex-col gap-2">
                                    <div class="flex gap-2 items-center">
                                        <i class="b-fa-solid b-fa-clock"></i> ${DateHelper.format(data.eventRecord.startDate, 'LT')} - ${DateHelper.format(data.eventRecord.endDate, 'LT')}
                                    </div>
                                    <div class="flex gap-2 items-center">
                                        <div class="b-icon b-icon-duration"></div> ${DateHelper.getDurationInUnit(data.eventRecord.data.startDate, data.eventRecord.data.endDate , 'minutes')} minuti
                                    </div>                                                                
                                    <hr />
                                    <div class="whitespace-pre-line">
                                        ${data.eventRecord.data.note ?? ''}
                                    </div>
                                </div>`
                                    
                    }
                    
                    /*
                    renderer: (data) => {
                        //console.log(data)     
                        //html di default
                        "<div class="b-sch-clockwrap b-sch-clock-hour b-sch-tooltip-startdate">
                    <div class="b-sch-clock">
                        <div class="b-sch-hour-indicator">mar</div>
                        <div class="b-sch-minute-indicator">9</div>
                        <div class="b-sch-clock-dot"></div>
                    </div>
                    <span class="b-sch-clock-text">7:00</span>
                </div><div class="b-sch-clockwrap b-sch-clock-hour b-sch-tooltip-enddate">
                    <div class="b-sch-clock">
                        <div class="b-sch-hour-indicator">mar</div>
                        <div class="b-sch-minute-indicator">9</div>
                        <div class="b-sch-clock-dot"></div>
                    </div>
                    <span class="b-sch-clock-text">7:10</span>
                </div><div class="b-cal-tooltip-duration b-icon b-icon-duration">10 minuti</div>"                                           
                    } 
                    */                   
                },
                eventMenu : {
                    processItems({ items, eventRecord, assignmentRecord, resourceRecord }) { //
                        
                        if(eventRecord.data.sezione_visita === 'ORARIO')
                        {
                            items.editEvent.text = 'Modifica orario medico'
                            items.deleteEvent.text = 'Elimina orario medico'
                            items.duplicate = null
                        }
                        else if(eventRecord.data.sezione_visita == 'N') {
                            items.editEvent.text = 'Apri Nota'
                            items.deleteEvent.text = 'Elimina Nota'
                            items.duplicate = null
                        }
                        else if(eventRecord.data.sezione_visita == 'X') {
                            items.editEvent.text = 'Apri Assenza'
                            items.deleteEvent.text = 'Elimina Assenza'
                            items.duplicate = null
                        }
                        else
                        {
                            items.editEvent.text = 'Apri prenotazione',
                            items.deleteEvent.text = 'Elimina prenotazione',
                            items.duplicate = null
                            items.custom = {
                                icon    : 'b-fa b-fa-clone',
                                text: 'ciaone',
                                onItem: (e) => {
                                    console.log('ciao!')
                                }
                            }
                        }

                    }
                    /*
                    items : {
                        
                        editEvent: {
                            'text' : 'Apri prenotazione'
                        },
                        deleteEvent : {
                            text: 'Elimina'
                        },
                        duplicate: null,
                        // Add our own custom item
                        myMenuItem : {
                            icon    : 'b-fa b-fa-clone',
                            text    : 'Nuova voce',
            
                            // Will look up ownership chain and find the Calendar
                            handler : null
                        }
                    }
                    */
                },
                scheduleMenu : {
                    processItems(data) {
                        console.log(data)
                    },
                    items: {
                        addEvent: null,
                        nuovaMedsport : {
                            icon    : 'b-icon b-icon-add',
                            text    : 'Medsport',
            
                            onItem: (e) => {
                                
                                //console.log('data: ' + e.date + ' | ambu: ' +e.resourceRecord.data.id)
                                nuovaPrenotazione(e , 'M')
                            }
                        },
                        nuovaMedsportSocieta : {
                            icon    : 'b-icon b-icon-add',
                            text    : 'Medsport - Società sportiva',
            
                            onItem: (e) => {
                                
                                //console.log('data: ' + e.date + ' | ambu: ' +e.resourceRecord.data.id)
                                nuovaPrenotazione(e , 'SM')
                            }
                        },
                        nuovaAmbulatoriale : {
                            icon    : 'b-icon b-icon-add',
                            text    : 'Ambulatoriale',
            
                            onItem: (e) => {
                                
                                //console.log('data: ' + e.date + ' | ambu: ' +e.resourceRecord.data.id)
                                nuovaPrenotazione(e , 'A')
                            }
                        },
                   
                    }
                },
                loadOnDemand: {
                    clearOnNewRange : false,
                    alwaysLoadNewRange: false
                }
            }

            const sidebar = ref({
                items: {
                    
                    datePicker : {
                        // Never go to dates in the past
                        //minDate : new Date(2020, 9, 12),
                        //multiSelect: 'range',
                        //eventStore: countEventStore,
                        //showEvents : false, // non usare o va in loop . attendere fix
                        cellRenderer(all) {                            
                            let dayCount = datepickerData.find(element => {
                                return element.data_inizio === dayjs(all.date).format('YYYY-MM-DD')
                            })?.count
                                                        
                            all.cell.style.color = dayCount > 119 
                                ? 'red'
                                : 'blue'
                    
                        }
                    },
                    
                    eventFilter : {
                        // Let's have this at the top
                        weight : 50
                    },
                    resourceFilter: {
                        selected: [1 , 2 , 3] ,
                        store : {
                            sorters : [{
                                field     : 'name',
                                // By default this is in ascending name order
                                // Let's change that round.
                                ascending : true
                            }]
                        }
                    }
                }
            })

            
            onMounted( async () => {
                
                await axios.get('api/sphere/calendario/bryntum/count-prenotazioni-datepicker').then(response => {                                         
                    datepickerData = response.data
                    
                })

                isLoaded.value = true
                //provatotale()
                /*
                await axios.get('api/sphere/calendario/bryntum/load/firstLoad').then(response => { 
                    eventStore.data = response.data.events
                    console.log(eventStore.lastDateRange)
                    //resourceStore.data = response.data.resources                    
                })
                */ 
           
                console.log(calendar)
            });

        

            LocaleManager.applyLocale('It')
            return {
                calendar,
                calendarConfig,
                //resourceStore,
                modalData,
                deleteDialog,
                features,
                sidebar,
                //resourceTimeRangeStore,
                crudManager,                
                datepickerData,
                isLoaded
           
                
            }
        }
    }
</script>


<style lang="scss">
@import './Calendar.scss';

//nascondi giorni in cima 
.b-resourceview .b-dayview .b-calendarrow-header .b-day-name-day , .b-day-name-date {
    display: none!important;
}

.background-orario {
    background-color: rgba(58 , 130 , 246 , 0.3);
    
    margin-right: -4px;
}
</style>