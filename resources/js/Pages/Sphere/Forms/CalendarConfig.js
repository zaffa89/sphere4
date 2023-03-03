export const useCalendarConfig = () => {
    return {
        // Start life looking at this date
        date: new Date(),
        
        datePicker: {
            showEvents: true
        },
        dateFormat: 'DD MMMM YYYY', //giorno in alto
        
        //readOnly: true, questo funziona
        sidebar : {
            footer: 'footer sidebar',
            items : {
                datePicker : {
                    // Never go to dates in the past
                    minDate : new Date(2020, 9, 12)
                },
                
                eventFilter : {
                    // Let's have this at the top
                    weight : 50
                },
                resourceFilter : {
                    store : {
                        sorters : [{
                            field     : 'name',
                            // By default this is in ascending name order
                            // Let's change that round.
                            ascending : false
                        }]
                    }                    
                },
                
            }
        },
        features : {            
            eventTooltip : {
                align: 'l-r',
                listeners : {
                    beforeShow({ source }) {
                        source.tools.delete = false;
                    }
                }
            },
            eventMenu : {
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
            },
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
        modes: {
            day: null,
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
                    hourHeight: 240,
                    increment: '1 minute',  
                    //autoCreate: false                  
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
                        fullWeek: false                        
                    },                    
                    dayStartTime : 7,
                    dayEndTime: 21,
                    hourHeight: 300,
                    increment: '1 minute', 
                }
            }
        }
    };
};