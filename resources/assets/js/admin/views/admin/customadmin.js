

demo = {
    initPickColor: function(){
        $('.pick-class-label').click(function(){
            var new_class = $(this).attr('new-class');
            var old_class = $('#display-buttons').attr('data-class');
            var display_div = $('#display-buttons');
            if(display_div.length) {
                var display_buttons = display_div.find('.btn');
                display_buttons.removeClass(old_class);
                display_buttons.addClass(new_class);
                display_div.attr('data-class', new_class);
            }
        });
    },

    checkFullPageBackgroundImage: function(){
        $page = $('.full-page');
        image_src = $page.data('image');

        if(image_src !== undefined){
            image_container = '<div class="full-page-background" style="background-image: url(' + image_src + ') "/>';
            $page.append(image_container);
        }
    },

    initDateTimePicker: function() {
        if($(".datetimepicker").length != 0){
            $('.datetimepicker').datetimepicker({
                icons: {
                    time: "now-ui-icons tech_watch-time",
                    date: "now-ui-icons ui-1_calendar-60",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'now-ui-icons arrows-1_minimal-left',
                    next: 'now-ui-icons arrows-1_minimal-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });
        }

        if($(".datepicker").length != 0){
            $('.datepicker').datetimepicker({
                format: 'MM/DD/YYYY',
                icons: {
                    time: "now-ui-icons tech_watch-time",
                    date: "now-ui-icons ui-1_calendar-60",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'now-ui-icons arrows-1_minimal-left',
                    next: 'now-ui-icons arrows-1_minimal-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });
        }

        if($(".timepicker").length != 0){
            $('.timepicker').datetimepicker({
                //          format: 'H:mm',    // use this format if you want the 24hours timepicker
                format: 'h:mm A',    //use this format if you want the 12hours timpiecker with AM/PM toggle
                icons: {
                    time: "now-ui-icons tech_watch-time",
                    date: "now-ui-icons ui-1_calendar-60",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'now-ui-icons arrows-1_minimal-left',
                    next: 'now-ui-icons arrows-1_minimal-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });
        }
    },

    initFullCalendar: function(){
        $calendar = $('#fullCalendar');

        today = new Date();
        y = today.getFullYear();
        m = today.getMonth();
        d = today.getDate();

        $calendar.fullCalendar({
            viewRender: function(view, element) {
                // We make sure that we activate the perfect scrollbar when the view isn't on Month
                if (view.name != 'month'){
                    $(element).find('.fc-scroller').perfectScrollbar();
                }
            },
            header: {
                left: 'title',
                center: 'month,agendaWeek,agendaDay',
                right: 'prev,next,today'
            },
            defaultDate: today,
            selectable: true,
            selectHelper: true,
            views: {
                month: { // name of view
                    titleFormat: 'MMMM YYYY'
                    // other view-specific options here
                },
                week: {
                    titleFormat: " MMMM D YYYY"
                },
                day: {
                    titleFormat: 'D MMM, YYYY'
                }
            },

            select: function(start, end) {

                // on select we show the Sweet Alert modal with an input
                swal({
                    title: 'Create an Event',
                    html: '<div class="form-group">' +
                    '<input class="form-control" placeholder="Event Title" id="input-field">' +
                    '</div>',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                }).then(function(result) {

                    var eventData;
                    event_title = $('#input-field').val();

                    if (event_title) {
                        eventData = {
                            title: event_title,
                            start: start,
                            end: end
                        };
                        $calendar.fullCalendar('renderEvent', eventData, true); // stick? = true
                    }

                    $calendar.fullCalendar('unselect');

                });
            },
            editable: true,
            eventLimit: true, // allow "more" link when too many events


            // color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
            events: [
                {
                    title: 'All Day Event',
                    start: new Date(y, m, 1),
                    className: 'event-default'
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d-1, 10, 30),
                    allDay: false,
                    className: 'event-green'
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d+7, 12, 0),
                    end: new Date(y, m, d+7, 14, 0),
                    allDay: false,
                    className: 'event-red'
                },
                {
                    title: 'Nud-pro Launch',
                    start: new Date(y, m, d-2, 12, 0),
                    allDay: true,
                    className: 'event-azure'
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d+1, 19, 0),
                    end: new Date(y, m, d+1, 22, 30),
                    allDay: false,
                    className: 'event-azure'
                },
                {
                    title: 'Click for Creative Tim',
                    start: new Date(y, m, 21),
                    end: new Date(y, m, 22),
                    url: 'http://www.creative-tim.com/',
                    className: 'event-orange'
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 21),
                    end: new Date(y, m, 22),
                    url: 'http://www.creative-tim.com/',
                    className: 'event-orange'
                }
            ]
        });
    },

    initDocChart: function(){
        chartColor = "#FFFFFF";

        // General configuration for the charts with Line gradientStroke
        gradientChartOptionsConfiguration = {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                bodySpacing: 4,
                mode:"nearest",
                intersect: 0,
                position:"nearest",
                xPadding:10,
                yPadding:10,
                caretPadding:10
            },
            responsive: true,
            scales: {
                yAxes: [{
                    display:0,
                    gridLines:0,
                    ticks: {
                        display: false
                    },
                    gridLines: {
                        zeroLineColor: "transparent",
                        drawTicks: false,
                        display: false,
                        drawBorder: false
                    }
                }],
                xAxes: [{
                    display:0,
                    gridLines:0,
                    ticks: {
                        display: false
                    },
                    gridLines: {
                        zeroLineColor: "transparent",
                        drawTicks: false,
                        display: false,
                        drawBorder: false
                    }
                }]
            },
            layout:{
                padding:{left:0,right:0,top:15,bottom:15}
            }
        };

        ctx = document.getElementById('lineChartExample').getContext("2d");

        gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
        gradientStroke.addColorStop(0, '#80b6f4');
        gradientStroke.addColorStop(1, chartColor);

        gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
        gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
        gradientFill.addColorStop(1, "rgba(249, 99, 59, 0.40)");

        myChart = new Chart(ctx, {
            type: 'line',
            responsive: true,
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Active Users",
                    borderColor: "#f96332",
                    pointBorderColor: "#FFF",
                    pointBackgroundColor: "#f96332",
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 4,
                    fill: true,
                    backgroundColor: gradientFill,
                    borderWidth: 2,
                    data: [542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 630]
                }]
            },
            options: gradientChartOptionsConfiguration
        });
    },

    initChartPageCharts: function(){
        chartColor = "#FFFFFF";

        // General configuration for the charts with Line gradientStroke
        gradientChartOptionsConfiguration = {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                bodySpacing: 4,
                mode:"nearest",
                intersect: 0,
                position:"nearest",
                xPadding:10,
                yPadding:10,
                caretPadding:10
            },
            responsive: 1,
            scales: {
                yAxes: [{
                    display:0,
                    gridLines:0,
                    ticks: {
                        display: false
                    },
                    gridLines: {
                        zeroLineColor: "transparent",
                        drawTicks: false,
                        display: false,
                        drawBorder: false
                    }
                }],
                xAxes: [{
                    display:0,
                    gridLines:0,
                    ticks: {
                        display: false
                    },
                    gridLines: {
                        zeroLineColor: "transparent",
                        drawTicks: false,
                        display: false,
                        drawBorder: false
                    }
                }]
            },
            layout:{
                padding:{left:0,right:0,top:15,bottom:15}
            }
        };

        gradientChartOptionsConfigurationWithNumbersAndGrid = {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                bodySpacing: 4,
                mode:"nearest",
                intersect: 0,
                position:"nearest",
                xPadding:10,
                yPadding:10,
                caretPadding:10
            },
            responsive: true,
            scales: {
                yAxes: [{
                    gridLines:0,
                    gridLines: {
                        zeroLineColor: "transparent",
                        drawBorder: false
                    }
                }],
                xAxes: [{
                    display:0,
                    gridLines:0,
                    ticks: {
                        display: false
                    },
                    gridLines: {
                        zeroLineColor: "transparent",
                        drawTicks: false,
                        display: false,
                        drawBorder: false
                    }
                }]
            },
            layout:{
                padding:{left:0,right:0,top:15,bottom:15}
            }
        };

        var cardStatsMiniLineColor = "#fff",
            cardStatsMiniDotColor = "#fff";

        ctx = document.getElementById('lineChartExample').getContext("2d");

        gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
        gradientStroke.addColorStop(0, '#80b6f4');
        gradientStroke.addColorStop(1, chartColor);

        gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
        gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
        gradientFill.addColorStop(1, "rgba(249, 99, 59, 0.40)");

        myChart = new Chart(ctx, {
            type: 'line',
            responsive: true,
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Active Users",
                    borderColor: "#f96332",
                    pointBorderColor: "#FFF",
                    pointBackgroundColor: "#f96332",
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 4,
                    fill: true,
                    backgroundColor: gradientFill,
                    borderWidth: 2,
                    data: [542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 630]
                }]
            },
            options: gradientChartOptionsConfiguration
        });


        ctx = document.getElementById('lineChartExampleWithNumbersAndGrid').getContext("2d");

        gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
        gradientStroke.addColorStop(0, '#18ce0f');
        gradientStroke.addColorStop(1, chartColor);

        gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
        gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
        gradientFill.addColorStop(1, hexToRGB('#18ce0f',0.4));

        myChart = new Chart(ctx, {
            type: 'line',
            responsive: true,
            data: {
                labels: ["12pm,", "3pm", "6pm", "9pm", "12am", "3am", "6am", "9am"],
                datasets: [{
                    label: "Email Stats",
                    borderColor: "#18ce0f",
                    pointBorderColor: "#FFF",
                    pointBackgroundColor: "#18ce0f",
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 4,
                    fill: true,
                    backgroundColor: gradientFill,
                    borderWidth: 2,
                    data: [40, 500, 650, 700, 1200, 1250, 1300, 1900]
                }]
            },
            options: gradientChartOptionsConfigurationWithNumbersAndGrid
        });

        var e = document.getElementById("barChartSimpleGradientsNumbers").getContext("2d");

        gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
        gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
        gradientFill.addColorStop(1, hexToRGB('#2CA8FF', 0.6));

        var a =  {
            type : "bar",
            data : {
                labels : ["January","February","March","April","May","June","July","August","September","October","November","December"],
                datasets: [{
                    label: "Active Countries",
                    backgroundColor: gradientFill,
                    borderColor: "#2CA8FF",
                    pointBorderColor: "#FFF",
                    pointBackgroundColor: "#2CA8FF",
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 4,
                    fill: true,
                    borderWidth: 1,
                    data: [80,99,86,96,123,85,100,75,88,90,123,155]
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    bodySpacing: 4,
                    mode:"nearest",
                    intersect: 0,
                    position:"nearest",
                    xPadding:10,
                    yPadding:10,
                    caretPadding:10
                },
                responsive: 1,
                scales: {
                    yAxes: [{
                        gridLines:0,
                        gridLines: {
                            zeroLineColor: "transparent",
                            drawBorder: false
                        }
                    }],
                    xAxes: [{
                        display:0,
                        gridLines:0,
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            zeroLineColor: "transparent",
                            drawTicks: false,
                            display: false,
                            drawBorder: false
                        }
                    }]
                },
                layout:{
                    padding:{left:0,right:0,top:15,bottom:15}
                }
            }
        };

        var viewsChart = new Chart(e,a);

        var e = document.getElementById("barChartMultipleBarsNoGradient").getContext("2d");

        var a =  {
            type : "bar",
            data : {
                labels:[
                    "January","February","March","April","May","June","July","August","September","October","November","December"
                ],
                datasets:[
                    {
                        backgroundColor: "#f96332",
                        data: [40, 26, 28, 45, 20, 25, 30, 25, 20, 25, 20, 15,]
                    },
                    {
                        backgroundColor: "#2CA8FF",
                        data: [15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20]
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    bodySpacing: 4,
                    mode:"nearest",
                    intersect: 0,
                    position:"nearest",
                    xPadding:10,
                    yPadding:10,
                    caretPadding:10
                },
                responsive: true,
                scales: {
                    yAxes: [{
                        gridLines:0,
                        gridLines: {
                            zeroLineColor: "transparent",
                            drawBorder: false
                        }
                    }],
                    xAxes: [{
                        gridLines:0,
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            zeroLineColor: "transparent",
                            drawTicks: false,
                            drawBorder: false
                        }
                    }]
                },
                layout:{
                    padding:{left:0,right:0,top:15,bottom:15}
                }
            }
        };

        var viewsChart = new Chart(e,a);

        // For a pie chart
        // var e = document.getElementById("pieChart").getContext("2d");
        //
        // var myPieChart = {
        //     type: 'pie',
        //     data: data,
        //     options: options
        // };
        //
        // var pieChart = new Chart(e,myPieChart);
    },

    initDashboardPageCharts: function(){

        chartColor = "#FFFFFF";

        // General configuration for the charts with Line gradientStroke
        gradientChartOptionsConfiguration = {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                bodySpacing: 4,
                mode:"nearest",
                intersect: 0,
                position:"nearest",
                xPadding:10,
                yPadding:10,
                caretPadding:10
            },
            responsive: 1,
            scales: {
                yAxes: [{
                    display:0,
                    gridLines:0,
                    ticks: {
                        display: false
                    },
                    gridLines: {
                        zeroLineColor: "transparent",
                        drawTicks: false,
                        display: false,
                        drawBorder: false
                    }
                }],
                xAxes: [{
                    display:0,
                    gridLines:0,
                    ticks: {
                        display: false
                    },
                    gridLines: {
                        zeroLineColor: "transparent",
                        drawTicks: false,
                        display: false,
                        drawBorder: false
                    }
                }]
            },
            layout:{
                padding:{left:0,right:0,top:15,bottom:15}
            }
        };






        /*****************************************************************************************************/
        /*                                                 mamei begin                                       */
        /*****************************************************************************************************/


        let worldsCodes;
        let mapData = {};
        let countriesUsers;

        axios.get(route('v1.coustomadmin.countriescodes')).then(function (response) {
            worldsCodes = response['data']['countries_codes'];
        }).catch(function (error) {
            console.log(error);
        });


        let bigDashboardCtx = document.getElementById('bigDashboardChart').getContext("2d");

        var gradientStroke = bigDashboardCtx.createLinearGradient(500, 0, 100, 0);
        gradientStroke.addColorStop(0, '#80b6f4');
        gradientStroke.addColorStop(1, chartColor);

        var gradientFill = bigDashboardCtx.createLinearGradient(0, 200, 0, 50);
        gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
        gradientFill.addColorStop(1, "rgba(255, 255, 255, 0.24)");

        let publishedRafflesChart = new Chart(bigDashboardCtx, {
            type: 'line',
            data: {
                labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
                datasets: [{
                    label: "Published Raffles",
                    borderColor: chartColor,
                    pointBorderColor: chartColor,
                    pointBackgroundColor: "#1e3d60",
                    pointHoverBackgroundColor: "#1e3d60",
                    pointHoverBorderColor: chartColor,
                    pointBorderWidth: 1,
                    pointHoverRadius: 7,
                    pointHoverBorderWidth: 2,
                    pointRadius: 5,
                    fill: true,
                    backgroundColor: gradientFill,
                    borderWidth: 2,
                    data: [],
                }]
            },
            options: {
                title: {
                    text: '',
                    display: true,
                    fontSize: 18,
                    fontStyle: 'normal',
                    position: 'left',
                    fontColor: "rgba(255, 255, 255, 1)",
                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 0,
                        bottom: 0
                    }
                },
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: '#fff',
                    titleFontColor: '#333',
                    bodyFontColor: '#666',
                    bodySpacing: 4,
                    xPadding: 12,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest"
                },
                legend: {
                    position: "top",
                    fillStyle: "#FFF",
                    display: false,
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: "rgba(255,255,255,0.4)",
                            fontStyle: "bold",
                            beginAtZero: true,
                            maxTicksLimit: 5,
                            padding: 10
                        },
                        gridLines: {
                            drawTicks: true,
                            drawBorder: false,
                            display: true,
                            color: "rgba(255,255,255,0.1)",
                            zeroLineColor: "transparent"
                        }

                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent",
                            display: false,

                        },
                        ticks: {
                            padding: 10,
                            fontColor: "rgba(255,255,255,0.4)",
                            fontStyle: "bold"
                        }
                    }]
                }
            }
        });

        function updateActiveRaffles() {
            axios.get(route('v1.customadmin.publishedraffles')).then(function (response) {
                //this chart show enabled raffles count in the current year
                let publishedRaffles = response['data']['publishedRaffles'];
                let total = 0;
                for (let i = 0; i < 12; i++)
                    total += publishedRaffles[i];

                publishedRafflesChart.data.datasets[0].data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

                publishedRafflesChart.update();

                publishedRafflesChart.data.datasets[0].data = publishedRaffles;

                publishedRafflesChart.options.title.text = 'Published Raffles in this year:  ' + total;

                publishedRafflesChart.update();
            }).catch(function (error) {
                console.log(error);
                //showajaxerror('#mdal_publishRaffle',  error.response.data.error['message']);
            });
        }

        updateActiveRaffles();
        $('#bigDashboardChart').on('click', updateActiveRaffles);


        let activeUsersCanvas = document.getElementById('activeUsers');
        let activeUsersCtx = activeUsersCanvas.getContext("2d");

        /*********************************************************/
        gradientFill = activeUsersCtx.createLinearGradient(0, 200, 0, 10);
        gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
        gradientFill.addColorStop(1, "rgba(255, 0, 0, 0.24)");

        gradientStroke = activeUsersCtx.createLinearGradient(500, 0, 100, 0);
        gradientStroke.addColorStop(0, '#80b6f4');
        gradientStroke.addColorStop(1, chartColor);
        /*********************************************************/

        let activeUsersChart = new Chart(activeUsersCtx, {
            type: 'bar',
            data: {
                labels: [
                    "29", "28", "27", "26", "25", "24", "23", "22", "21", "20",
                    "19", "18", "17", "16", "15", "14", "13", "12", "11", "10",
                    "9",  "8",  "7",  "6",  "5",  "4",  "3",  "2",  "1",  "0",
                ],
                datasets: [{
                    label: "Active Male Users",
                    borderColor: "rgba(0, 0, 0, 0.2)",
                    fill: false,
                    backgroundColor: "rgba(0, 230, 0, 0.4)",
                    hoverBackgroundColor: "rgba(0, 230, 0, 0.6)",
                    borderWidth: 0.5,
                    data: [],
                },
                {
                    label: "Active Female Users",
                    borderColor: "rgba(0, 0, 0, 0.2)",
                    fill: false,
                    backgroundColor: "rgba(0, 0, 230, 0.4)",
                    hoverBackgroundColor: "rgba(0, 0, 230, 0.6)",
                    borderWidth: 0.5,
                    data: [],
                },
                {
                label: "Active Users",
                    borderColor: "rgba(230, 0, 0, 0.4)",
                    pointBorderColor: "rgba(230, 0, 0, 0.4)",
                    pointBackgroundColor: "rgba(230, 0, 0, 0.4)",
                    pointHoverBackgroundColor: "rgba(230, 0, 0, 0.4)",
                    pointHoverBorderColor: "rgba(230, 0, 0, 0.4)",
                    pointBorderWidth: 1,
                    pointHoverRadius: 6,
                    pointHoverBorderWidth: 2,
                    backgroundColor: "rgba(230, 0, 0, 0.4)",
                    pointRadius: 4,
                    fill: false,
                    borderWidth: 1,
                    type: 'line',
                    data: [],
                }]
            },
            options: {
                title: {
                    text: "Active users in the last 30 days",
                    display: true,
                    fontSize: 18,
                    fontStyle: 'normal',
                    fontColor: "rgba(0, 0, 0, 0.5)",
                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 0,
                        bottom: 0
                    }
                },
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgba(20, 20, 20, 0.9)",
                    titleFontColor: '#eee',
                    bodyFontColor: '#fff',
                    bodySpacing: 4,
                    xPadding: 12,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest"
                },
                legend: {
                    position: "bottom",
                    fillStyle: "#FFF",
                    display: true,
                    labels : {
                        boxWidth: 15,
                        padding: 15,
                    },
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: "rgba(0, 0, 0, 0.5)",
                            fontStyle: "bold",
                            beginAtZero: true,
                            maxTicksLimit: 5,
                            padding: 10
                        },
                        gridLines: {
                            drawTicks: true,
                            drawBorder: false,
                            display: true,
                            color: "rgba(100, 100, 100, 0.1)",
                            zeroLineColor: "transparent",
                        },
                        stacked: true
                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent",
                            display: false,
                        },
                        ticks: {
                            padding: 10,
                            fontColor: "rgba(0, 0, 0, 0.5)",
                            fontStyle: "bold"
                        },
                        stacked: true
                    }]
                }
            }
        });

        function updateActiveUsers () {
            axios.get(route('v1.customadmin.activeusers')).then(function (response) {
                //this chart show users's traffic in a period (actually 30 days)
                let maleTraffic     = response['data']['male_users'];
                let femaleTraffic   = response['data']['female_users'];
                let totalTraffic  = Array(30);

                for (let i = 0; i < maleTraffic.length; i++)
                    totalTraffic[i] = maleTraffic[i] + femaleTraffic[i];

                activeUsersChart.data.datasets[0].data = [];
                activeUsersChart.data.datasets[1].data = [];
                activeUsersChart.data.datasets[2].data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

                activeUsersChart.update();

                activeUsersChart.data.datasets[0].data = maleTraffic;
                activeUsersChart.data.datasets[1].data = femaleTraffic;
                activeUsersChart.data.datasets[2].data = totalTraffic;

                activeUsersChart.update();

            }).catch(function (error) {
                console.log(error);
                //showajaxerror('#mdal_publishRaffle',  error.response.data.error['message']);
            });
        }

        updateActiveUsers();
        // $('#refreshActUsers').on('click', updateActiveUsers);
        $(activeUsersCanvas).on('click', updateActiveUsers);


        let usersCanvas = document.getElementById("usersData");
        let usersDataCtx = usersCanvas.getContext("2d");

        let usersDataChart = new Chart(usersDataCtx ,{
            type: 'doughnut',
            data: {
                datasets: [{
                    backgroundColor: ['rgba(255, 0, 0, 0.5)', 'rgba(0, 0, 255, 0.5)'],
                    borderWidth: [5, 5],
                    data: [],
                }],
                labels: [
                    'Male',
                    'Female',
                ]
            },
            options: {
                title : {
                    display: true,
                    text: '',
                    fontSize: 18,
                    fontStyle: 'normal',
                    fontColor: "rgba(0, 0, 0, 0.5)",
                },
                legend: {
                    display: true,
                    position: 'right',
                    labels : {
                        boxWidth: 15,
                        padding: 40,
                    },
                },
            }
        });

        function updateRegisteredUsers () {
            axios.get(route('v1.customadmin.registeredusers')).then(function (response) {
                let maleCount   = response['data']['male'];
                let femaleCount = response['data']['female'];
                let total  = maleCount + femaleCount;

                usersDataChart.data.datasets[0].data = [];

                usersDataChart.update();

                usersDataChart.data.datasets[0].data = [maleCount, femaleCount];

                usersDataChart.options.title.text = 'Registered Users: ' + total;

                usersDataChart.update();

            }).catch(function (error) {
                console.log(error);
                //showajaxerror('#mdal_publishRaffle',  error.response.data.error['message']);
            });
        }

        updateRegisteredUsers();
        // $('#refreshActUsers').on('click', updateActiveUsers);
        $(usersCanvas).on('click', updateRegisteredUsers);


        let rafflesCanvas = document.getElementById("rafflesData");
        let rafflesDataCtx = rafflesCanvas.getContext("2d");

        let rafflesDataChart = new Chart(rafflesDataCtx ,{
            type: 'doughnut',
            data: {
                datasets: [{
                    backgroundColor: [
                        'rgba(255, 0, 0, 0.5)',
                        'rgba(0, 0, 255, 0.5)',
                        'rgba(100, 0, 20, 0.5)',
                        'rgba(0, 200, 255, 0.5)',
                        'rgba(255, 90, 0, 0.5)',
                        'rgba(60, 255, 80, 0.5)',
                    ],
                    borderWidth: [5, 5, 5, 5, 5, 5],

                    data: [],
                }],
                labels: [
                    'Unpublished',
                    'Published',
                    'Cancelled',
                    'Sold',
                    'Shuffled',
                    'Confirmed',
                ]
            },
            options: {
                title : {
                    display: true,
                    text: '',
                    fontSize: 18,
                    fontStyle: 'normal',
                    fontColor: "rgba(0, 0, 0, 0.5)",
                },
                legend: {
                    position: 'right',
                    labels : {
                        boxWidth: 15,
                        padding: 15,
                    },
                }
            }
        });


        function updateCreatedRaffles () {
            axios.get(route('v1.customadmin.rafflesbystatus')).then(function (response) {
                let rafflesData = [
                    response['data']['unpublished'],
                    response['data']['published'],
                    response['data']['cancelled'],
                    response['data']['sold'],
                    response['data']['shuffled'],
                    response['data']['confirmed'],
                ];

                let total = 0;
                for (let i = 0; i < 6; i++)
                    total += rafflesData[i];

                rafflesDataChart.data.datasets[0].data = [];

                rafflesDataChart.update();

                rafflesDataChart.data.datasets[0].data = rafflesData;

                rafflesDataChart.options.title.text = 'Created Raffles: ' + total;

                rafflesDataChart.update();

            }).catch(function (error) {
                console.log(error);
                //showajaxerror('#mdal_publishRaffle',  error.response.data.error['message']);
            });
        }

        updateCreatedRaffles();
        // $('#refreshActUsers').on('click', updateActiveUsers);
        $(rafflesCanvas).on('click', updateCreatedRaffles);


        let ticketsCanvas = document.getElementById("ticketsData");
        let ticketsDataCtx = ticketsCanvas.getContext("2d");

        let ticketsDataChart = new Chart(ticketsDataCtx, {
            type: 'bar',
            data: {
                labels: ['Referrals', 'Directly'],
                datasets: [{
                    label: "Male",
                    borderColor: "rgba(0, 0, 0, 0.2)",
                    fill: false,
                    backgroundColor: "rgba(0, 230, 0, 0.4)",
                    hoverBackgroundColor: "rgba(0, 230, 0, 0.6)",
                    borderWidth: 0.5,
                    data: [],
                },
                {
                    label: "Female",
                    borderColor: "rgba(0, 0, 0, 0.2)",
                    fill: false,
                    backgroundColor: "rgba(0, 0, 230, 0.4)",
                    hoverBackgroundColor: "rgba(0, 0, 230, 0.6)",
                    borderWidth: 0.5,
                    data: [],
                },
                {
                    label: "Solded Tickets ",
                    borderColor: "rgba(230, 0, 0, 0.4)",
                    pointBorderColor: "rgba(230, 0, 0, 0.4)",
                    pointBackgroundColor: "rgba(230, 0, 0, 0.4)",
                    pointHoverBackgroundColor: "rgba(230, 0, 0, 0.4)",
                    pointHoverBorderColor: "rgba(230, 0, 0, 0.4)",
                    pointBorderWidth: 1,
                    pointHoverRadius: 6,
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    backgroundColor: "rgba(230, 0, 0, 0.4)",
                    fill: false,
                    borderWidth: 1,
                    type: 'line',
                    data: [],
                }
                ]
            },
            options: {
                title: {
                    text: '',
                    display: true,
                    fontSize: 18,
                    fontStyle: 'normal',
                    fontColor: "rgba(0, 0, 0, 0.5)",
                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 0,
                        bottom: 0
                    }
                },
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgba(20, 20, 20, 0.9)",
                    titleFontColor: '#eee',
                    bodyFontColor: '#fff',
                    bodySpacing: 4,
                    xPadding: 12,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest"
                },
                legend: {
                    position: "bottom",
                    fillStyle: "#FFF",
                    display: true,
                    labels : {
                        boxWidth: 15,
                        padding: 15,
                    },
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: "rgba(0, 0, 0, 0.5)",
                            fontStyle: "bold",
                            beginAtZero: true,
                            maxTicksLimit: 5,
                            padding: 10
                        },
                        gridLines: {
                            drawTicks: true,
                            drawBorder: false,
                            display: true,
                            color: "rgba(100, 100, 100, 0.1)",
                            zeroLineColor: "transparent",
                        },
                        stacked: true
                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent",
                            display: false,
                        },
                        ticks: {
                            padding: 10,
                            fontColor: "rgba(0, 0, 0, 0.5)",
                            fontStyle: "bold"
                        },
                        stacked: true
                    }]
                }
            }
        });


        function updateSoldedTickets () {
            axios.get(route('v1.customadmin.soldedtickets')).then(function (response) {

                let maleData = [response['data']['male_referrals'], response['data']['male_directly']];
                let femaleData = [response['data']['female_referrals'], response['data']['female_directly']];
                let ticketsData = [maleData[0] + femaleData[0], maleData[1] + femaleData[1]];
                let remainTickets = response['data']['remain'];

                ticketsDataChart.data.datasets[0].data = [];
                ticketsDataChart.data.datasets[1].data = [];
                ticketsDataChart.data.datasets[2].data = [];

                ticketsDataChart.update();

                ticketsDataChart.data.datasets[0].data = maleData;
                ticketsDataChart.data.datasets[1].data = femaleData;
                ticketsDataChart.data.datasets[2].data = ticketsData;

                ticketsDataChart.options.title.text = "Solded Tickets: " + (ticketsData[0] + ticketsData[1]) + " (" + "Remain: " + remainTickets + ")";

                ticketsDataChart.update();

            }).catch(function (error) {
                console.log(error);
                //showajaxerror('#mdal_publishRaffle',  error.response.data.error['message']);
            });
        }

        updateSoldedTickets();
        $(ticketsCanvas).on('click', updateSoldedTickets);


        let moneyByTicketsCanvas = document.getElementById("moneyByTickets");
        let moneyByTicketsCtx = moneyByTicketsCanvas.getContext("2d");

        let moneyByTicketsChart = new Chart(moneyByTicketsCtx ,{
            type: 'doughnut',
            data: {
                datasets: [{
                    backgroundColor: ['rgba(255, 0, 0, 0.5)', 'rgba(0, 0, 255, 0.5)'],
                    borderWidth: [5, 5],
                    data: [],
                }],
                labels: [
                    'Directly',
                    'Referrals',
                ]
            },
            options: {
                title : {
                    display: true,
                    text: '',
                    fontSize: 18,
                    fontStyle: 'normal',
                    fontColor: "rgba(0, 0, 0, 0.5)",
                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 0,
                        bottom: 0
                    }
                },
                legend: {
                    display: true,
                    position: 'right',
                    labels : {
                        boxWidth: 15,
                        padding: 55,
                    },
                },
            }
        });


        function updateMoneyByTickets () {
            axios.get(route('v1.customadmin.moneybytickets')).then(function (response) {

                let moneyData = [response['data']['directly'], response['data']['referrals']];
                let moneyTicketsCount = moneyData[0] + moneyData[1];
                let netGain = response['data']['net_gain'];

                moneyByTicketsChart.data.datasets[0].data = [];

                moneyByTicketsChart.update();

                moneyByTicketsChart.data.datasets[0].data = moneyData;

                moneyByTicketsChart.options.title.text = 'Money by Tickets: $' + moneyTicketsCount + ' (Net. gain: $' + netGain + ')';

                moneyByTicketsChart.update();

            }).catch(function (error) {
                console.log(error);
                //showajaxerror('#mdal_publishRaffle',  error.response.data.error['message']);
            });
        }

        updateMoneyByTickets();
        $(moneyByTicketsCanvas).on('click', updateMoneyByTickets);


        let ticketsBySocialNetworksCanvas = document.getElementById("ticketsBySocialNetworksData");
        let ticketsBySocialNetworksDataCtx = ticketsBySocialNetworksCanvas.getContext("2d");

        let socialNetworksDataChart = new Chart(ticketsBySocialNetworksDataCtx, {
            type: 'bar',
            data: {
                labels: ['Facebook', 'Twitter', 'Instagram'],
                datasets: [{
                    label: "Male",
                    borderColor: "rgba(0, 0, 0, 0.2)",
                    fill: false,
                    backgroundColor: "rgba(0, 230, 0, 0.4)",
                    hoverBackgroundColor: "rgba(0, 230, 0, 0.6)",
                    borderWidth: 0.5,
                    data: [],
                },
                {
                    label: "Female",
                    borderColor: "rgba(0, 0, 0, 0.2)",
                    fill: false,
                    backgroundColor: "rgba(0, 0, 230, 0.4)",
                    hoverBackgroundColor: "rgba(0, 0, 230, 0.6)",
                    borderWidth: 0.5,
                    data: [],
                },
                {
                    label: "Solded Tickets ",
                    borderColor: "rgba(230, 0, 0, 0.4)",
                    pointBorderColor: "rgba(230, 0, 0, 0.4)",
                    pointBackgroundColor: "rgba(230, 0, 0, 0.4)",
                    pointHoverBackgroundColor: "rgba(230, 0, 0, 0.4)",
                    pointHoverBorderColor: "rgba(230, 0, 0, 0.4)",
                    pointBorderWidth: 1,
                    pointHoverRadius: 6,
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    backgroundColor: "rgba(230, 0, 0, 0.4)",
                    fill: false,
                    borderWidth: 1,
                    type: 'line',
                    data: [],
                }
                ]
            },
            options: {
                title: {
                    text: '',
                    display: true,
                    fontSize: 18,
                    fontStyle: 'normal',
                    fontColor: "rgba(0, 0, 0, 0.5)",
                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 0,
                        bottom: 0
                    }
                },
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgba(20, 20, 20, 0.9)",
                    titleFontColor: '#eee',
                    bodyFontColor: '#fff',
                    bodySpacing: 4,
                    xPadding: 12,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest"
                },
                legend: {
                    position: "bottom",
                    fillStyle: "#FFF",
                    display: true,
                    labels : {
                        boxWidth: 15,
                        padding: 15,
                    },
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: "rgba(0, 0, 0, 0.5)",
                            fontStyle: "bold",
                            beginAtZero: true,
                            maxTicksLimit: 5,
                            padding: 10
                        },
                        gridLines: {
                            drawTicks: true,
                            drawBorder: false,
                            display: true,
                            color: "rgba(100, 100, 100, 0.1)",
                            zeroLineColor: "transparent",
                        },
                        stacked: true
                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent",
                            display: false,
                        },
                        ticks: {
                            padding: 10,
                            fontColor: "rgba(0, 0, 0, 0.5)",
                            fontStyle: "bold"
                        },
                        stacked: true
                    }]
                }
            }
        });


        function updateSoldedTicketsBySocialNetworks () {
            axios.get(route('v1.customadmin.soldedticketsbysocialnetworks')).then(function (response) {

                let maleData = [
                    response['data']['male_facebook'],
                    response['data']['male_twitter'],
                    response['data']['male_instagram']
                ];
                let femaleData = [
                    response['data']['female_facebook'],
                    response['data']['female_twitter'],
                    response['data']['female_instagram']
                ];

                let facebookData = maleData[0] + femaleData[0];
                let twitterData = maleData[1] + femaleData[1];
                let instagramData = maleData[2] + femaleData[2];
                let socialNetworkTicketsData = [facebookData, twitterData, instagramData];
                let socialNetworkTicketsTotal = socialNetworkTicketsData[0] + socialNetworkTicketsData[1] + socialNetworkTicketsData[2];

                socialNetworksDataChart.data.datasets[0].data = [];
                socialNetworksDataChart.data.datasets[1].data = [];
                socialNetworksDataChart.data.datasets[2].data = [];

                socialNetworksDataChart.update();

                socialNetworksDataChart.data.datasets[0].data = maleData;
                socialNetworksDataChart.data.datasets[1].data = femaleData;
                socialNetworksDataChart.data.datasets[2].data = socialNetworkTicketsData;

                socialNetworksDataChart.options.title.text = "Solded tickets by Social Networks: " + socialNetworkTicketsTotal;

                socialNetworksDataChart.update();

            }).catch(function (error) {
                console.log(error);
                //showajaxerror('#mdal_publishRaffle',  error.response.data.error['message']);
            });
        }

        updateSoldedTicketsBySocialNetworks();
        $(ticketsBySocialNetworksCanvas).on('click', updateSoldedTicketsBySocialNetworks);

        let countriesCanvas = document.getElementById("countries");
        let countriesCtx = countriesCanvas.getContext("2d");

        let countriesChart = new Chart(countriesCtx, {
            type: 'horizontalBar',
            data: {
                labels: [],
                datasets: [{
                    label: "Users",
                    borderColor: "rgba(0, 0, 0, 0.2)",
                    fill: false,
                    backgroundColor: "rgba(0, 230, 200, 0.4)",
                    hoverBackgroundColor: "rgba(0, 230, 200, 0.6)",
                    borderWidth: 0.5,
                    data: [],
                }]
            },
            options: {
                title: {
                    text: 'Countries with most users',
                    display: true,
                    fontSize: 18,
                    fontStyle: 'normal',
                    fontColor: "rgba(0, 0, 0, 0.5)",
                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 0,
                        bottom: 0
                    }
                },
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgba(20, 20, 20, 0.9)",
                    titleFontColor: '#eee',
                    bodyFontColor: '#fff',
                    bodySpacing: 4,
                    xPadding: 12,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest"
                },
                legend: {
                    position: "bottom",
                    fillStyle: "#FFF",
                    display: false,
                    labels : {
                        boxWidth: 15,
                        padding: 15,
                    },
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: "rgba(0, 0, 0, 0.5)",
                            fontStyle: "bold",
                            beginAtZero: true,
                            maxTicksLimit: 5,
                            padding: 10
                        },
                        gridLines: {
                            drawTicks: false,
                            drawBorder: false,
                            display: true,
                            color: "rgba(100, 100, 100, 0.1)",
                            zeroLineColor: "transparent",
                        },
                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent",
                            display: true,
                        },
                        ticks: {
                            padding: 10,
                            fontColor: "rgba(0, 0, 0, 0.5)",
                            fontStyle: "bold",
                            beginAtZero: true,
                            maxTicksLimit: 5,
                            display: true,
                        },
                    }]
                }
            }
        });

        function updateCountriesUsers () {
            axios.get(route('v1.customadmin.countriesusers')).then(function (response) {
                let countriesCodes = response['data']['countries'];
                let users = response['data']['users'];
                countriesUsers = response['data']['countries_users'];

                let countries = [];
                for(let i = 0; i < countriesCodes.length; i++) {
                    countries.push(worldsCodes[countriesCodes[i]]);
                    mapData[countriesCodes[i]] = users[i] * 20;
                }
                countriesChart.data.labels = [];
                countriesChart.data.datasets[0].data = [];

                countriesChart.update();

                countriesChart.data.labels = countries;
                countriesChart.data.datasets[0].data = users;

                countriesChart.update();

                $("#worldMap").html('');

                initWorldMap();

            }).catch(function (error) {
                console.log(error);
            });
        }

        updateCountriesUsers();
        $(countriesCanvas).on('click', updateCountriesUsers);

        function initWorldMap() {

            $('#worldMap').vectorMap({
                map: 'world_mill_en',
                backgroundColor: "transparent",
                zoomOnScroll: false,
                regionStyle: {
                    initial: {
                        fill: '#e4e4e4',
                        "fill-opacity": 0.9,
                        stroke: 'none',
                        "stroke-width": 0,
                        "stroke-opacity": 0
                    }
                },

                series: {
                    regions: [{
                        values: mapData,
                        scale: ["#AAAAAA", "#444444"],
                        normalizeFunction: 'polynomial'
                    }]
                },
                onRegionTipShow: function(e, el, code){
                    let usersCount = 0;
                    if (countriesUsers[code] !== undefined)
                        usersCount = countriesUsers[code];
                    el.html(el.html() + ' (Users: ' + usersCount + ')');
                }
            });
        }

        /*****************************************************************************************************/
        /*                                                 mamei end                                         */
        /*****************************************************************************************************/








        ctx = document.getElementById('emailsCampaignChart').getContext("2d");

        gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
        gradientStroke.addColorStop(0, '#18ce0f');
        gradientStroke.addColorStop(1, chartColor);

        gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
        gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
        gradientFill.addColorStop(1, hexToRGB('#18ce0f',0.4));

        myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["12pm,", "3pm", "6pm", "9pm", "12am", "3am", "6am", "9am"],
                datasets: [{
                    label: "Email Stats",
                    borderColor: "#18ce0f",
                    pointBorderColor: "#FFF",
                    pointBackgroundColor: "#18ce0f",
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 4,
                    fill: true,
                    backgroundColor: gradientFill,
                    borderWidth: 2,
                    data: [40, 500, 650, 700, 1200, 1250, 1300, 1900]
                }]
            },
            options: gradientChartOptionsConfiguration
        });

        var e = document.getElementById("activeCountries").getContext("2d");

        gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
        gradientStroke.addColorStop(0, '#2CA8FF');
        gradientStroke.addColorStop(1, chartColor);

        gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
        gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
        gradientFill.addColorStop(1, hexToRGB('#2CA8FF', 0.4));

        var a =  {
            type : "line",
            data : {
                labels : ["January","February","March","April","May","June","July","August","September","October"],
                datasets: [{
                    label: "Active Countries",
                    backgroundColor: gradientFill,
                    borderColor: "#2CA8FF",
                    pointBorderColor: "#FFF",
                    pointBackgroundColor: "#2CA8FF",
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 4,
                    fill: true,
                    borderWidth: 2,
                    data: [80,78,86,96,83,85,76,75,88,90]
                }]
            },
            options: gradientChartOptionsConfiguration
        };

        var viewsChart = new Chart(e,a);


        // Bar Charts
        var e = $("#chartSupportRequests");

        if(0!=e.length) {
            var t = {
                labels:["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets:[{
                    backgroundColor: "#18ce0f",
                    data: [15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20]
                },
                    {
                        backgroundColor: "#f3f3fb",
                        data: [15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20]
                    }
                ]
            };

            var chartSupportRequests = new Chart(e, {
                    type:"bar",
                    data:t,
                    options: {
                        title: {
                            display: 0
                        },
                        tooltips: {
                            intersect: 0, mode: "nearest", xPadding: 10, yPadding: 10, caretPadding: 10
                        },
                        scales: {
                            yAxes: [{
                                display:0,
                                gridLines:0,
                                ticks: {
                                    display: false
                                },
                                gridLines: {
                                    zeroLineColor: "transparent",
                                    drawTicks: false,
                                    display: false,
                                    drawBorder: false
                                }
                            }],
                        },
                        legend: {
                            display: 0
                        },
                        layout: {
                            padding: {
                                left: 0, right: 0, top: 0, bottom: 0
                            }
                        }
                    }
                }
            )
        }
    },

    showSwal: function(type){
        if(type == 'basic'){
            swal({
                title: "Here's a message!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success"
            }).catch(swal.noop);

        }else if(type == 'title-and-text'){
            swal({
                title: "Here's a message!",
                text: "It's pretty, isn't it?",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-info"
            }).catch(swal.noop);

        }else if(type == 'success-message'){
            swal({
                title: "Good job!",
                text: "You clicked the button!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                type: "success"
            }).catch(swal.noop);

        }else if(type == 'warning-message-and-confirmation'){
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'Yes, delete it!',
                buttonsStyling: false
            }).then(function() {
                swal({
                    title: 'Deleted!',
                    text: 'Your file has been deleted.',
                    type: 'success',
                    confirmButtonClass: "btn btn-success",
                    buttonsStyling: false
                });
            }).catch(swal.noop);
        }else if(type == 'warning-message-and-cancel'){
            swal({
                title: 'Are you sure?',
                text: 'You will not be able to recover this imaginary file!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it',
                confirmButtonClass: "btn btn-success",
                cancelButtonClass: "btn btn-danger",
                buttonsStyling: false
            }).then(function() {
                swal({
                    title: 'Deleted!',
                    text: 'Your imaginary file has been deleted.',
                    type: 'success',
                    confirmButtonClass: "btn btn-success",
                    buttonsStyling: false
                }).catch(swal.noop);
            }, function(dismiss) {
                // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                if (dismiss === 'cancel') {
                    swal({
                        title: 'Cancelled',
                        text: 'Your imaginary file is safe :)',
                        type: 'error',
                        confirmButtonClass: "btn btn-info",
                        buttonsStyling: false
                    }).catch(swal.noop);
                }
            }).catch(swal.noop);

        }else if(type == 'custom-html'){
            swal({
                title: 'HTML example',
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                html:
                'You can use <b>bold text</b>, ' +
                '<a href="http://github.com">links</a> ' +
                'and other HTML tags'
            }).catch(swal.noop);

        }else if(type == 'auto-close'){
            swal({ title: "Auto close alert!",
                text: "I will close in 2 seconds.",
                timer: 2000,
                showConfirmButton: false
            }).catch(swal.noop);
        } else if(type == 'input-field'){
            swal({
                title: 'Input something',
                html: '<div class="form-group">' +
                '<input id="input-field" type="text" class="form-control" />' +
                '</div>',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function(result) {
                swal({
                    type: 'success',
                    html: 'You entered: <strong>' +
                    $('#input-field').val() +
                    '</strong>',
                    confirmButtonClass: 'btn btn-success',
                    buttonsStyling: false

                }).catch(swal.noop);
            }).catch(swal.noop);
        }
    },

    initNowUiWizard: function(){
        // Code for the Validator
        var $validator = $('.card-wizard form').validate({
            rules: {
                firstname: {
                    required: true,
                    minlength: 3
                },
                lastname: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    minlength: 3,
                }
            },
            highlight: function(element) {
                $(element).closest('.input-group').removeClass('has-success').addClass('has-danger');
            },
            success: function(element) {
                $(element).closest('.input-group').removeClass('has-danger').addClass('has-success');
            }
        });

        // Wizard Initialization
        $('.card-wizard').bootstrapWizard({
            'tabClass': 'nav nav-pills',
            'nextSelector': '.btn-next',
            'previousSelector': '.btn-previous',

            onNext: function(tab, navigation, index) {
                var $valid = $('.card-wizard form').valid();
                if(!$valid) {
                    $validator.focusInvalid();
                    return false;
                }
            },

            onInit : function(tab, navigation, index){
                //check number of tabs and fill the entire row
                var $total = navigation.find('li').length;
                var $wizard = navigation.closest('.card-wizard');

                first_li = navigation.find('li:first-child a').html();
                $moving_div = $("<div class='moving-tab'></div>");
                $moving_div.append(first_li);
                $('.card-wizard .wizard-navigation').append($moving_div);



                refreshAnimation($wizard, index);

                $('.moving-tab').css('transition','transform 0s');
            },

            onTabClick : function(tab, navigation, index){
                var $valid = $('.card-wizard form').valid();

                if(!$valid){
                    return false;
                } else{
                    return true;
                }
            },

            onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;

                var $wizard = navigation.closest('.card-wizard');

                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $($wizard).find('.btn-next').hide();
                    $($wizard).find('.btn-finish').show();
                } else {
                    $($wizard).find('.btn-next').show();
                    $($wizard).find('.btn-finish').hide();
                }

                button_text = navigation.find('li:nth-child(' + $current + ') a').html();

                setTimeout(function(){
                    $('.moving-tab').html(button_text);
                }, 150);

                var checkbox = $('.footer-checkbox');

                if( !index == 0 ){
                    $(checkbox).css({
                        'opacity':'0',
                        'visibility':'hidden',
                        'position':'absolute'
                    });
                } else {
                    $(checkbox).css({
                        'opacity':'1',
                        'visibility':'visible'
                    });
                }

                refreshAnimation($wizard, index);
            }
        });


        // Prepare the preview for profile picture
        $("#wizard-picture").change(function(){
            readURL(this);
        });

        $('[data-toggle="wizard-radio"]').click(function(){
            wizard = $(this).closest('.card-wizard');
            wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
            $(this).addClass('active');
            $(wizard).find('[type="radio"]').removeAttr('checked');
            $(this).find('[type="radio"]').attr('checked','true');
        });

        $('[data-toggle="wizard-checkbox"]').click(function(){
            if( $(this).hasClass('active')){
                $(this).removeClass('active');
                $(this).find('[type="checkbox"]').removeAttr('checked');
            } else {
                $(this).addClass('active');
                $(this).find('[type="checkbox"]').attr('checked','true');
            }
        });

        $('.set-full-height').css('height', 'auto');

        //Function to show image before upload

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(window).resize(function(){
            $('.card-wizard').each(function(){
                $wizard = $(this);

                index = $wizard.bootstrapWizard('currentIndex');
                refreshAnimation($wizard, index);

                $('.moving-tab').css({
                    'transition': 'transform 0s'
                });
            });
        });

        function refreshAnimation($wizard, index){
            $total = $wizard.find('.nav li').length;
            $li_width = 100/$total;

            total_steps = $wizard.find('.nav li').length;
            move_distance = $wizard.width() / total_steps;
            index_temp = index;
            vertical_level = 0;

            mobile_device = $(document).width() < 600 && $total > 3;

            if(mobile_device){
                move_distance = $wizard.width() / 2;
                index_temp = index % 2;
                $li_width = 50;
            }

            $wizard.find('.nav li').css('width',$li_width + '%');

            step_width = move_distance;
            move_distance = move_distance * index_temp;

            $current = index + 1;

            // if($current == 1 || (mobile_device == true && (index % 2 == 0) )){
            //     move_distance -= 8;
            // } else if($current == total_steps || (mobile_device == true && (index % 2 == 1))){
            //     move_distance += 8;
            // }

            if(mobile_device){
                vertical_level = parseInt(index / 2);
                vertical_level = vertical_level * 38;
            }

            $wizard.find('.moving-tab').css('width', step_width);
            $('.moving-tab').css({
                'transform':'translate3d(' + move_distance + 'px, ' + vertical_level +  'px, 0)',
                'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'

            });
        }
    },

    initSliders: function(){
        // Sliders for demo purpose in refine cards section
        var slider = document.getElementById('sliderRegular');

        noUiSlider.create(slider, {
            start: 40,
            connect: [true,false],
            range: {
                min: 0,
                max: 100
            }
        });

        var slider2 = document.getElementById('sliderDouble');

        noUiSlider.create(slider2, {
            start: [ 20, 60 ],
            connect: true,
            range: {
                min:  0,
                max:  100
            }
        });
    },

    initVectorMap: function(){
        var mapData = {
            "AU": 760,
            "BR": 550,
            "CA": 120,
            "DE": 1300,
            "FR": 540,
            "GB": 690,
            "GE": 200,
            "IN": 200,
            "RO": 600,
            "RU": 300,
            "US": 2920,
        };

        $('#worldMap').vectorMap({
            map: 'world_mill_en',
            backgroundColor: "transparent",
            zoomOnScroll: false,
            regionStyle: {
                initial: {
                    fill: '#e4e4e4',
                    "fill-opacity": 0.9,
                    stroke: 'none',
                    "stroke-width": 0,
                    "stroke-opacity": 0
                }
            },

            series: {
                regions: [{
                    values: mapData,
                    scale: ["#AAAAAA","#444444"],
                    normalizeFunction: 'polynomial'
                }]
            },
        });
    },


    initGoogleMaps: function(){
        var myLatlng = new google.maps.LatLng(40.748817, -73.985428);
        var mapOptions = {
            zoom: 13,
            center: myLatlng,
            scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
            styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
        };

        var map = new google.maps.Map(document.getElementById("map"), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            title:"Hello World!"
        });

        // To add the marker to the map, call setMap();
        marker.setMap(map);
    },

    initSmallGoogleMaps: function(){

        // Regular Map
        var myLatlng = new google.maps.LatLng(40.748817, -73.985428);
        var mapOptions = {
            zoom: 8,
            center: myLatlng,
            scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
        }

        var map = new google.maps.Map(document.getElementById("regularMap"), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            title:"Regular Map!"
        });

        marker.setMap(map);


        // Custom Skin & Settings Map
        var myLatlng = new google.maps.LatLng(40.748817, -73.985428);
        var mapOptions = {
            zoom: 13,
            center: myLatlng,
            scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
            disableDefaultUI: true, // a way to quickly hide all controls
            zoomControl: true,
            styles: [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}]

        }

        var map = new google.maps.Map(document.getElementById("customSkinMap"), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            title:"Custom Skin & Settings Map!"
        });

        marker.setMap(map);



        // Satellite Map
        var myLatlng = new google.maps.LatLng(40.748817, -73.985428);
        var mapOptions = {
            zoom: 3,
            scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.SATELLITE
        }

        var map = new google.maps.Map(document.getElementById("satelliteMap"), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            title:"Satellite Map!"
        });

        marker.setMap(map);


    },

    showNotification: function(from, align){
        color = 'primary';

        $.notify({
            icon: "now-ui-icons ui-1_bell-53",
            message: "Welcome to <b>Now Ui Dashboard Pro</b> - a beautiful freebie for every web developer."

        },{
            type: color,
            timer: 8000,
            placement: {
                from: from,
                align: align
            }
        });
    }

};
