import { Toast } from '@bryntum/calendar'
export const useCalendarConfig = () => {
    return {
        // Start life looking at this date
        date: new Date(),
        
        
        dateFormat: 'DD MMMM YYYY', //giorno in alto
        onDateRangeLoad(e) {
            //Toast.show(`Loaded ${this.eventStore.count} events`);
        },
        //readOnly: true, questo funziona
        sidebar : {
            footer: 'footer sidebar',
            
        },
        features : {
            timeRanges  : true,
            
            
            drag: {
                creatable: false,
            },
                                                                   
        },
        // CrudManager arranges loading and syncing of data in JSON form from/to a web service 36563
        
        
        
        /*
        crudManager: {            
            transport : {
                load : {
                    url : '/api/sphere/calendario/bryntum/autoload'
                },
                sync: {
                    url: 'asd'
                }
            },            
            //loadUrl: '/api/sphere/calendario/bryntum/autoload',
            autoLoad: true,
            autoSync: true
        },
        */
        
        
        // Features named by the properties are included.
        // An object is used to configure the feature.
        
        header: null,
        
        weekStartDay: 1,
        mode: 'dayResourceView',
        autoCreate: false ,

        modes: {
            day: {},
            week   : {
                /*
                hourHeight: 260,
                    hourHeightBreakpoints: {
                        thirty : 70,
                        fifteen: 140,
                        ten: 260,
                        five: 500 
                    },
                */
            },
            month: {
                showWeekColumn : false
            },
            agenda: null,
            year: null,

            dayResourceView : {
                title: 'Ambulatori',
                // Type has the final say over which view type is created
                type : 'resource',
                showAvatars: true,
                meta : resource => resource.name,
                timeFormat: 'HH:mm',
                //includeTimeRanges: true,
                //syncViewDate: false,
                // This is a config object for the subviews; one for each resource
                view : {
                    // We show a day view for each resource in the project
                    type : 'dayView',
                    showAllDayHeader: true,
                    allDayEvents: {
                        fullWeek: false                        
                    },                    
                    dayStartTime : 6,
                    dayEndTime: 21,
                    autoCreate: false ,
            
                    hourHeight : 140,
    
                    
                    increment: '1 minute',   
                                     
                                     
                    /*
                    dayHeaderRenderer : function(headerDomConfig, cellData) {
                        if (true) {
                            headerDomConfig.className['b-is-special-date'] = 1;
                    
                            // Add to the content element's children
                            headerDomConfig.children.push({
                                text : 'Medico 1',
                                className : 'b-special-day'
                            });
                        }
                    }
                    */                    
                },                                
            },
            weekResourcesView: {
                title: 'Settimana',
                type: 'resource',
                meta : resource => resource.name,
                timeFormat: 'HH:mm',
                view: {
                    type: 'week',
                    showAllDayHeader: true,
                    allDayEvents: {
                        fullWeek: true                        
                    },                    
                    dayStartTime : 7,
                    dayEndTime: 21,
                    hourHeight: 300,
                    increment: '1 minute', 
        autoCreate: false ,
                    
                }
            }
        }
    };
};