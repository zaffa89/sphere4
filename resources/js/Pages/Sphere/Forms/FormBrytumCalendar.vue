<template>
    <div class="h-full">    
        <bryntum-calendar
            ref="calendar"
            :config="calendarConfig"            
            
            :resources="resources"
            :events="events"

            :onEventClick="onEventClick"
            :onBeforeEventEdit="onBeforeEventEdit"
            :onBeforeDragResizeEnd="onBeforeDragResizeEnd"
            :onBeforeDragMoveEnd="onBeforeDragMoveEnd"
            :onDateChange="consoleDate"
            :onActiveItemChange="onActiveItemChange"

        />
        <!--
            :onDateRangeRequested="consoleTimeRange"
            :onDateRangeChange="consoleEvent"
            
            step 805 - 2
            tem 120 | 91

            magg rtp con step 803
            magg rtp con tem 91
            magg rtp disabili step 4
            magg rtp disabili tem 1

            visite magg disabili step 3 
            visite magg disabili tem 0

            visita 40 con step 555
            visita 40 con tem 83  

            rtp 899
            EA 649

        -->
    </div>
</template>

<script setup>
    import { ref, reactive, onMounted } from 'vue';    

    import {
        BryntumCalendar
    } from '@bryntum/calendar-vue-3';

    import { useCalendarConfig } from './AppConfig';

    const calendarConfig = reactive(useCalendarConfig());
</script>
<script>
    
    
    export default {
        name: 'Calendario-Bryntum',
        /*
        components : {
            BryntumCalendar
        },
        */
        data() {
            return {
                events: [],
                resources: [],
                calendar: null
            }
        },
        methods: {
            consoleEvent(e) { console.log(e) },
            async consoleDate(event) {             
                console.log('date: ' + dayjs(event.date).format('DD-MM-YYYY') + ' view: ' + event.source._mode)

                await axios.get(`api/sphere/calendario/bryntum/load/${event.source._mode}/${dayjs(event.date).format('YYYY-MM-DD')}`).then(response => { 
                    this.events = response.data.events
                    this.resources = response.data.resources
                })
            },
            
            onActiveItemChange(e) { //cambio view
                console.log(e)
            },
            onEventClick() {
                console.log('cliccato')
            },
            onBeforeEventEdit() {
                console.log('opened')

                return false
            },
            onBeforeDragMoveEnd() {
                console.log('spostamento')
                //return false
            },
            onBeforeDragResizeEnd(){
                console.log('resize')
                //return false
            }
        },
        async mounted() {
            this.calendar = this.$refs.calendar;

            await axios.get('api/sphere/calendario/bryntum/load/day').then(response => { 
                this.events = response.data.events
                this.resources = response.data.resources
            })

            console.log(this.calendar)
        }

        //CONVERTIRE IN OPTIONS API
        

        
    };
</script>

<style lang="scss">
@import './App.scss';

//nascondi giorni in cima 
.b-resourceview .b-dayview .b-calendarrow-header .b-day-name-day , .b-day-name-date {
    display: none!important;
}

</style>