<!DOCTYPE html>
<head>
    <meta charset='utf-8'/>
    <title>
        Full Calendar - CRUD Matteo Carminato
    </title>

    {{--Boostrap v5--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

    {{-- Full Calendar v5 --}}
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.10.2/main.min.css' rel='stylesheet'/>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.10.2/main.min.js'></script>

    {{-- Moment JS--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
            integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
                events: "{{ route('getEvents') }}",
                dateClick: function (info) {
                    var start = moment(info.startStr).format('YYYY-MM-DD\THH:mm');
                    var end = moment(info.startStr).add(30, 'minutes').format('YYYY-MM-DD\THH:mm');

                    document.getElementById('create-start').value = start;
                    document.getElementById('create-end').value = end;

                    var myModal = new bootstrap.Modal(document.getElementById('modal-create'))
                    myModal.show()
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


{{--Modal Create--}}
<div class="modal fade" id="modal-create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{route('calendar.store')}}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="create-title" name="title"
                               aria-describedby="emailHelp" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="create-description" name="description"
                               aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleColorInput" class="form-label">Color picker</label>
                        <input type="color" name="color" class="form-control form-control-color"
                               id="create-exampleColorInput" value="#563d7c"
                               title="Choose your color" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleColorInput" class="form-label">Status</label>
                        <select class="form-select" aria-label="Default select example" name="status" required>
                            <option value="1">Pending</option>
                            <option value="2">Confirmed</option>
                            <option value="3">Canceled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="datetime-local">Start</label>
                        <input type="datetime-local" class="form-control" id="create-start" name="start" required>
                    </div>
                    <div class="mb-3">
                        <label for="datetime-local">End</label>
                        <input type="datetime-local" class="form-control" id="create-end" name="end" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>


</body>

</html>
