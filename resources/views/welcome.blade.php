<!DOCTYPE html>
<head>
    <meta charset='utf-8'/>
    <title>
        Full Calendar - CRUD Matteo Carminato
    </title>

    {{-- Boostrap v5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- Full Calendar v5 --}}
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.10.2/main.min.css' rel='stylesheet'/>


    <style>
        #calendar {
            max-width: 1100px;
            margin: 40px auto;
        }
    </style>

    <script>

        var SITEURL = "{{ url('/') }}";

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
                events: "{{ route('calendar.getevents') }}",
                dateClick: function (info) {
                    var start = moment(info.dateStr).format('YYYY-MM-DD\THH:mm');
                    var end = moment(info.dateStr).add(30, 'minutes').format('YYYY-MM-DD\THH:mm');

                    document.getElementById('create-start').value = start;
                    document.getElementById('create-end').value = end;

                    var myModal = new bootstrap.Modal(document.getElementById('modal-create'))
                    myModal.show()
                },
                eventClick: function (info) {
                    let id_event = info.event._def['publicId'];
                    let _token = document.getElementsByName("_token")[0].value;
                    document.getElementById('id').value = id_event;

                    $.ajax({
                        method: "get",
                        url: SITEURL + '/calendar/' + id_event + '/edit',
                        data: {
                            _token: _token
                        },
                        success: function (response) {
                            document.getElementById('update-title').value = response.data.title;
                            document.getElementById('update-description').value = response.data.description;
                            document.getElementById('update-start').value = response.data.start;
                            document.getElementById('update-end').value = response.data.end;
                            document.getElementById('update-color').value = response.data.color;
                            document.getElementById('update-resource').value = response.data.resourceId;
                            document.getElementById('update-status').value = response.data.status;

                            var myModal = new bootstrap.Modal(document.getElementById('modal-update'))
                            myModal.show()
                        }
                    });
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
                               id="create-color" value="#563d7c"
                               title="Choose your color" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleColorInput" class="form-label">Status</label>
                        <select class="form-select" aria-label="Default select example" id="create_status" name="status" required>
                            <option value="1">Pending</option>
                            <option value="2">Confirmed</option>
                            <option value="3">Canceled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleColorInput" class="form-label">Resource</label>
                        <select class="form-select" aria-label="Default select example" id="create_resource" name="resourceId" required>
                            <option value="a">A</option>
                            <option value="b">B</option>
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

{{--Modal Update--}}
<div class="modal fade" id="modal-update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('calendar.updateevents')}}">
                @method('PUT')
                @csrf
                <input type="hidden" id="id" name="id" value="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="update-title" name="title"
                               aria-describedby="emailHelp" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="update-description" name="description"
                               aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleColorInput" class="form-label">Color picker</label>
                        <input type="color" name="color" class="form-control form-control-color"
                               id="update-color"
                               title="Choose your color" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleColorInput" class="form-label">Status</label>
                        <select class="form-select" aria-label="Default select example" id="update-status" name="status" required>
                            <option value="1">Pending</option>
                            <option value="2">Confirmed</option>
                            <option value="3">Canceled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleColorInput" class="form-label">Resource</label>
                        <select class="form-select" aria-label="Default select example" id="update-resource" name="resourceId" required>
                            <option value="a">A</option>
                            <option value="b">B</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="datetime-local">Start</label>
                        <input type="datetime-local" class="form-control" id="update-start" name="start" required>
                    </div>
                    <div class="mb-3">
                        <label for="datetime-local">End</label>
                        <input type="datetime-local" class="form-control" id="update-end" name="end" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


{{-- Boostrap v5 --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

{{-- Full Calendar v5 --}}
<script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.10.2/main.min.js'></script>

{{-- Moment JS--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>
