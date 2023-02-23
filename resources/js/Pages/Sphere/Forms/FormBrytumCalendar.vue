<template>
    <div class="h-full">
        <bryntum-calendar
            ref="calendar"
            v-bind="calendarConfig"
            @eventclick="console.log('asd')"
        />
    </div>
</template>

<script>
    import { ref, reactive, onMounted } from 'vue';

    import {
        BryntumCalendar
    } from '@bryntum/calendar-vue-3';

    import { useCalendarConfig } from './AppConfig';
    
    export default {
        components : {
            BryntumCalendar
        },

        setup() {
            const calendar = ref(null);
      
            

            const calendarConfig = reactive(useCalendarConfig());
            //const projectConfig = reactive(useProjectConfig());


            return {         
                calendar,
                calendarConfig,               
            };
        }

        
    };
</script>

<style lang="scss">
@import './App.scss';

//nascondi giorni in cima 
.b-resourceview .b-dayview .b-calendarrow-header .b-day-name-day , .b-day-name-date {
    display: none!important;
}

</style>