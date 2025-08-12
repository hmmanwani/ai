<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Manage Extra Time" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_horizontal-navbar.html -->
        <x-header />
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    {{-- Start Design --}}
                    <section>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- card --}}
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2 class="card-title mb-0 f-24">Explore Extra Time</h2>
                                                </div>
                                                <div class="col-md-6 j-end">
                                                    <a href="{{ URL('add-extra-time') }}"
                                                        class="btn btn-primary  f-white">Add Extra
                                                        Hour</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table id="extratime" class="table table-bordered table-striped f-black">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th>Working Hours</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    {{-- End Start Design --}}
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <x-footer-con />

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    {{-- <div class="modal " tabindex="-1" id="modaladdextrahour" data-bs-backdrop="static">
        <div class="modal-dialog modal-xl ">
            <div class="modal-content">
                <form action="{{ url('/submit-extra-hours') }}" method="POST" id="myForm">
                    <div class="modal-header">
                        <h5 class="modal-title f-800 f-18">Add Extra hours</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="date and time" class="f-600 f-black form-label">From Date:</label>
                                    <input type="text" class="form-control" id="starting_date" name="starting_date"
                                        placeholder="dd-mm-yyyy">
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="mb-3">
                                    <label for="starting_time" class="f-600 f-black form-label">From Time:</label>
                                    <input type="text" class="form-control" id="starting_time" name="starting_time"
                                        placeholder="h:m">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="date and time" class="f-600 f-black form-label">To
                                        Date:</label>
                                    <input type="text" class="form-control" id="ending_date" name="ending_date"
                                        placeholder="dd-mm-yyyy">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="date and time" class="f-600 f-black form-label">To
                                        Time:</label>
                                    <input type="text" class="form-control" id="ending_time" name="ending_time"
                                        placeholder="h:m">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="project" class="f-600 f-black form-label">Project :</label>
                                    @if ($project->isEmpty())
                                        <p class="text-danger">No projects are
                                            assigned.</p>
                                    @else
                                        <select class="form-select" id="p_id" name="p_id"
                                            aria-label="Default select example">
                                            <option value="" disabled selected>-Select project-
                                            </option>
                                            @foreach ($project as $projects)
                                                <option value="{{ $projects->p_id }}">
                                                    {{ $projects->project_title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="task" class="f-600 f-black form-label">Task Description:</label>
                                <textarea class="form-control  h-100" name="task_description" id="task_description" rows="6"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    <div class="modal" tabindex="-1" id="ExtraTimeDetails" data-bs-backdrop="static">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title f-800">Extra Time Details : <span class="f-black" id="name"></span>
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex mb-3">
                                <label class="f-18 f-600">Project :</label>
                                <span class="f-18 f-700 f-black ms-2" id="project"></span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex mb-3">
                                        <label class="f-18 f-600">Starting Date :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="starting_date"></span>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <label class="f-18 f-600">Starting Time :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="starting_time_display"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex mb-3">
                                        <label class="f-18 f-600">Ending Date :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="ending_date"></span>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <label class="f-18 f-600">Ending Time :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="ending_time_display"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <label class="f-18 f-600">Working Hour :</label>
                                <span class="f-18 f-700 f-black ms-2" id="working_hour"></span>
                            </div>
                            <div class="d-flex mb-3">
                                <label class="f-18 f-600">Task Description :</label>
                                <span class="f-18 f-700 f-black ms-2" id="task_description_display"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
    <script>
        $('#addextrahour').click(function() {
            $('#modaladdextrahour').modal('show');
        })
    </script>
    <script>
        $(document).ready(function() {
            $('body').on('click', 'a[id^="extra-time-details_"]', function() {
                var id = $(this).data('id');

                $.ajax({
                    url: '{{ url('user-extra-time-details') }}',
                    method: 'POST',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // starting time
                        if (response.data) {
                            var start = new Date(response.data.starting_time);
                            var startingDate = start.toLocaleDateString(
                                'en-GB');
                            var startingTime = start.toLocaleTimeString('en-GB', {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            });
                            // Ending time
                            var end = new Date(response.data.ending_time);
                            var endingDate = end.toLocaleDateString(
                                'en-GB');
                            var endingTime = end.toLocaleTimeString('en-GB', {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            });
                            $('#task_description_display').text(response.data.task_description);
                            $('#working_hour').text(response.data.working_hour);
                            $('#starting_date').text(startingDate);
                            $('#starting_time_display').text(startingTime);
                            $('#ending_date').text(endingDate);
                            $('#ending_time_display').text(endingTime);
                            $('#name').text(response.data.fname + ' ' + response.data
                                .lname);
                            if (response.project) {
                                $('#project').text(response.project.project_title);
                            } else {
                                $('#project').text('-');
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
        $('#search').click(function() {
            assignData();
        });
        $(document).ready(function() {
            assignData();
        });

        function assignData() {
            $('#extratime').DataTable().destroy();
            let filter = {};
            ajaxDataTableInit(baseUrl() + '/get-extra-time', 'extratime', 0, 0, filter,"",false);
        }
        
    </script>


</body>

</html>
