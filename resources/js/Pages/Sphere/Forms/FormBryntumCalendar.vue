<template>
    <div class="h-full">    
        <bryntum-calendar
            ref="calendar"
            :config="calendarConfig"            
            
            :resourceStore="resourceStore"
            :eventStore="eventStore"
            
            :onEventClick="onEventClick"
            :onBeforeEventEdit="onBeforeEventEdit"
            :onBeforeDragResizeEnd="onBeforeDragResizeEnd"
            :onBeforeDragMoveEnd="onBeforeDragMoveEnd"
            :onDateChange="consoleDate"
            :onActiveItemChange="onActiveItemChange"
           
            :onEventContextMenu="consoleEvent"

            :onBeforeEventDelete="onBeforeEventDelete"              
            :onAfterEventSave="consoleEvent"
            :features="menu"
            :sidebar="sidebar"
        

        />
        <ModalPrenotazioneMedsport
            v-if="modalData?.sezione_visita == 'M'"
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

    import { EventStore , ResourceStore , MessageDialog } from '@bryntum/calendar'
    import {
        BryntumCalendar
    } from '@bryntum/calendar-vue-3';

    import { useCalendarConfig } from './CalendarConfig';

    import ModalPrenotazioneMedsport from '@modals/Calendario/ModalPrenotazioneMedsport.vue';
    import ModalConfermaEliminazione from '@modals/ModalConfermaEliminazione.vue';
    

    export default {
        name: 'Calendario-Bryntum',
        
        components : {
            BryntumCalendar,
            ModalPrenotazioneMedsport,
            ModalConfermaEliminazione
        },
        methods: {
            consoleEvent(e) { console.log(e) },
            async consoleDate(event) {             
                console.log('date: ' + dayjs(event.date).format('DD-MM-YYYY') + ' view: ' + event.source._mode)

                
                await axios.get(`api/sphere/calendario/bryntum/load/${event.source._mode}/${dayjs(event.date).format('YYYY-MM-DD')}`).then(response => { 
                    this.eventStore.data = response.data.events
                    this.resourceStore.data = response.data.resources
                })
                
            },
            apriAppuntamento(data)
            {
                this.modalData = data;
            },
            chiudiAppuntamento()
            {
                this.modalData = null;
            },
            eliminaAppuntamento()
            {                                
                axios.delete(`api/sphere/prenotazione/${this.deleteDialog.data.prenotazione_id}`).then(() => {                    
                    this.eventStore.getById(this.deleteDialog.data.id).remove()
                    this.deleteDialog = null

                }).catch(() => {
                    this.deleteDialog = null
                });
                
                
                
            },
            addPrenotazione(e) {
                console.log('add ' + e.id)
                this.eventStore.add(e)
                this.modalData = null;
            },
            updatePrenotazione(e) {
                console.log('update' + e.id)
                this.eventStore.getById(e.id).set(e)
                this.modalData = null;
            },
            onActiveItemChange(e) { //cambio view . caricare roba ?
                console.log(e)
            },
            onEventClick(e) {
                console.log('cliccato')
                console.log(this.eventStore.getById(e.eventRecord.data.id))
                //this.eventStore.getById(e.eventRecord.data.id).set({ 'name' : 'CIAONE' }) 1407 1151
            },
            
            onBeforeEventEdit(e) {
                console.log('opened')
                console.log(e.eventRecord.data)
                this.apriAppuntamento(e.eventRecord.data)
                return false
            },
            async onBeforeDragMoveEnd(e) {
                console.log('spostamento')
                console.log(e)

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
            onBeforeEventDelete({eventRecords}) {                
                this.deleteDialog = eventRecords[0]
                return false                
            }
        },
        setup() {

            const calendar = ref(null)
            const modalData = ref(null)
            const deleteDialog = ref(null)
            const calendarConfig = reactive(useCalendarConfig());

            //const events = ref(null)
            //const resources = ref(null)
            //const store = reactive({data: events})
            const eventStore = new EventStore()
            const resourceStore = new ResourceStore()
            
            function nuovaMedsport(e) {
                console.log(e)
                modalData.value = {                    
                    startDate : dayjs(e.date).format('YYYY-MM-DD HH:mm:ss'),
                    sezione_visita: "M",
                    resourceId: e.resourceRecord.data.id,
                    struttura_id: 1
                }
            }
            
            const menu = {
                scheduleMenu : {
                    items: {
                        addEvent: null,
                        nuovaMedsport : {
                            icon    : 'b-fa b-fa-calendar-times',
                            text    : 'Medsport',
            
                            onItem: (e) => {
                                //calcolo floor

                                //durata default in backend
                                
                                console.log('data: ' + e.date + ' | ambu: ' +e.resourceRecord.data.id)
                                nuovaMedsport(e)
                            }
                        },
                   
                    }
                }
            }

            const sidebar = {
                items: {
                    resourceFilter: {
                        selected: [1 , 2 , 3] 
                    }
                }
            }

            onMounted( async () => {
                await axios.get('api/sphere/calendario/bryntum/load/dayResourceView').then(response => { 
                    eventStore.data = response.data.events
                    resourceStore.data = response.data.resources
                })

                console.log(calendar.value)
            });

            return {
                calendar,
                calendarConfig,
                eventStore,
                resourceStore,
                modalData,
                deleteDialog,
                menu,
                sidebar
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

</style>