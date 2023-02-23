export const useCalendarConfig = () => {

    return {
        // Start life looking at this date
        date: new Date(2020, 9, 12),

        
        listeners : {
            dataChange: (event) => {
                console.log(event)
            },
            eventclick: (event) =>  {
                
            }
        },
        
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
            scheduleMenu : {
                items : {
                    // Knocks out the predefined addEvent item
                    //addEvent : null,
        
                    // Add our own custom item
                    disableDate : {
                         icon    : 'b-fa b-fa-calendar-times',
                         text    : 'Nuova voce',
        
                         // Will look up ownership chain and find the Calendar
                         handler : null
                    }
                }
            },
            eventMenu : {
                items : {
                    // Knocks out the predefined deleteEvent item
                    //deleteEvent : null,
        
                    // Add our own custom item
                    myMenuItem : {
                         icon    : 'b-fa b-fa-clone',
                         text    : 'Nuova voce',
        
                         // Will look up ownership chain and find the Calendar
                         handler : 'up.duplicateEvent'
                    }
                }
            }
        },
        // CrudManager arranges loading and syncing of data in JSON form from/to a web service
        crudManager: {
            transport: {
                load: {
                    url: 'data/data.json'
                }
            },
            autoLoad: true
        },

        // Features named by the properties are included.
        // An object is used to configure the feature.
        eventTooltipFeature: {
            // Configuration options are passed on to the tooltip instance
            // We want the tooltip's left edge aligned to the right edge of the event if possible.
            align: 'l-r'
        },
        header: null,
        
        weekStartDay: 1,
        mode: 'dayResourceview',
        modes: {
            day: {
                dayStartTime : 7,
                dayEndTime: 21,                
            },
            week   : {
                
            },
            month: {
                showWeekColumn : false
            },
            agenda: {

            },
            year: null,

            dayResourceview : {
                // Type has the final say over which view type is created
                type : 'resource',
                showAvatars: true,
                meta : resource => resource.name,
                
                // This is a config object for the subviews; one for each resource
                view : {
                    // We show a month view for each resource in the project
                    type : 'day',   
                    showAllDayHeader: true,
                    allDayEvents: {
                        fullWeek: false                        
                    },
                  
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
            }
        }
    };
};