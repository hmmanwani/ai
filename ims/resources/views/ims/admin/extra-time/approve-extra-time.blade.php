<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Approve Extra Time" />
</head>

<body>
    <div class="container-scroller">
        <x-header />
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    <section id="">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">
                                    <x-admin-sidebar />
                                </div>
                                <div class="col-md-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h1>Approve Extra Time</h1>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table id="extratime"
                                                        class="table table-bordered table-striped f-black">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Employee Name</th>
                                                                <th>Starting Date</th>
                                                                <th>Starting Time</th>
                                                                <th>Ending Date</th>
                                                                <th>Ending Time</th>
                                                                <th>Working Hours</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <x-footer-con />
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="ExtraTimeDetails" data-bs-backdrop="static">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title f-800">Extra Time Details : <span class="f-black" id="name"></span></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex mt-2">
                                <label class="f-18 f-600">Project :</label>
                                <span class="f-18 f-700 f-black ms-2" id="project"></span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex mt-2">
                                        <label class="f-18 f-600">Starting Date :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="starting_date"></span>
                                    </div>
                                    <div class="d-flex mt-2">
                                        <label class="f-18 f-600">Starting Time :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="starting_time"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex mt-2">
                                        <label class="f-18 f-600">Ending Date :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="ending_date"></span>
                                    </div>
                                    <div class="d-flex mt-2">
                                        <label class="f-18 f-600">Ending Time :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="ending_time"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-2">
                                <label class="f-18 f-600">Working Hour :</label>
                                <span class="f-18 f-700 f-black ms-2" id="working_hour"></span>
                            </div>
                            <div class="d-flex mt-2">
                                <label class="f-18 f-600">Task Description:</label>
                                <span class="f-18 f-700 f-black ms-2" id="task_description"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
    <script>
        $(document).ready(function() {
            $('body').on('click', 'a[id^="extra-time-details_"]', function() {
                var id = $(this).data('id');

                $.ajax({
                    url: '{{ url('extra-time-details') }}',
                    method: 'POST',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // starting time
                        if (response.data) {
                            var start = new Date(response.data.starting_time);
                           var startingDate = start.toLocaleDateString('en-GB').replaceAll('/', '-');
                            var startingTime = start.toLocaleTimeString('en-GB', {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            });
                            // Ending time
                            var end = new Date(response.data.ending_time);
                            var endingDate = end.toLocaleDateString(
                                'en-GB').replaceAll('/', '-');
                            var endingTime = end.toLocaleTimeString('en-GB', {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            });
                            $('#task_description').text(response.data.task_description);
                            $('#working_hour').text(response.data.working_hour);
                            $('#starting_date').text(startingDate);
                            $('#starting_time').text(startingTime);
                            $('#ending_date').text(endingDate);
                            $('#ending_time').text(endingTime);
                            $('#name').text(response.data.fname + ' ' + response.data
                                .lname);
                            if (response.project) {
                                $('#project').text(response.project.project_title);
                            }
                            // Show the modal
                            $('#ExtraTimeDetails').modal('show');
                        } else {
                            console.error('No data found in response');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
    
    <script>
        $(document).on('click', '.approve-status', function() {
            var ex_id = $(this).data('id');
            var e_id = $(this).data('e_id');

            $.ajax({
                url: '{{ url('submit-approve-extra-time') }}',
                method: 'POST',
                data: {
                    ex_id: ex_id,
                    e_id: e_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    assignData();
                    location.reload();
                }
            });
        });
        $(document).ready(function() {
            assignData();
        });

        function assignData() {
            $('#extratime').DataTable().destroy();
            ajaxDataTableInit(baseUrl() + '/get-approve-extra-time', 'extratime');
        }
    </script>
</body>

</html>
