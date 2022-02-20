<!DOCTYPE html>
<head>
    <meta charset='utf-8'/>
    <title>
        Full Calendar - CRUD Matteo Carminato
    </title>

    {{--Boostrap v5--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    {{-- Full Calendar v5 --}}
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.10.2/main.min.css' rel='stylesheet'/>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.10.2/main.min.js'></script>

    <style>
        #calendar {
            max-width: 1100px;
            margin: 40px auto;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                nowIndicator: true,
                editable: true,
                selectable: true,
                navLinks: true,
                timeZone: 'America/Sao_Paulo',
                locale: 'pt-br',
                initialView: 'resourceTimeGridDay',
                eventColor: 'gray',
                resources: [
                    {id: 'a', title: 'Room A'},
                    {id: 'b', title: 'Room B'}
                ],
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'resourceTimeGridDay,resourceTimeGridWeek,dayGridMonth'
                },
                events: 'https://fullcalendar.io/api/demo-feeds/events.json?with-resources=4&single-day',
                dateClick: function(info) {
                    alert('clicked ' + info.dateStr);
                },
                eventClick: function (info) {
                   alert('clicked ' + info.dateStr);
                },
                eventDrop: function (info) {
                   alert('clicked ' + info.dateStr);
                },
                eventResize: function (info) {
                   alert('clicked ' + info.dateStr);
                }
            });
            calendar.render();
        });

    </script>
</head>
<body>

<div id='calendar'></div>

</body>

</html>
