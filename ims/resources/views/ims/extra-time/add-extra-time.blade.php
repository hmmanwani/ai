<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Add Extra Time" />
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
                                    <div class="card f-black">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2 class="card-title mb-0 f-24">Add Extra Time</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end"><button
                                                        onclick="goBack()" class="btn btn-primary"><i
                                                            class="fa fa-arrow-left me-2"
                                                            aria-hidden="true"></i>Back</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form id="myForm" action="{{ url('/submit-extra-hours') }}"
                                                method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="date and time"
                                                                class="f-600 f-black form-label required">From
                                                                Date</label>
                                                            <input type="text" class="form-control"
                                                                id="starting_date" name="starting_date"
                                                                placeholder="dd-mm-yyyy">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="mb-3">
                                                            <label for="starting_time"
                                                                class="f-600 f-black form-label required">From
                                                                Time</label>
                                                            <input type="text" class="form-control"
                                                                id="starting_time" name="starting_time"
                                                                placeholder="h:m">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="date and time"
                                                                class="f-600 f-black form-label required">To
                                                                Date</label>
                                                            <input type="text" class="form-control" id="ending_date"
                                                                name="ending_date" placeholder="dd-mm-yyyy">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="date and time"
                                                                class="f-600 f-black form-label required">To
                                                                Time</label>
                                                            <input type="text" class="form-control" id="ending_time"
                                                                name="ending_time" placeholder="h:m">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="project"
                                                                class="f-600 f-black form-label required">Project
                                                            </label>
                                                            @if ($project->isEmpty())
                                                                <p class="text-danger">No projects are
                                                                    assigned.</p>
                                                            @else
                                                                <select class="form-select" id="p_id"
                                                                    name="p_id" aria-label="Default select example">
                                                                    <option value="" disabled selected>-Select
                                                                        project-
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
                                                        <div class="mb-3">
                                                            <label for="task"
                                                                class="f-600 f-black form-label required">Task
                                                                Description</label>
                                                            <textarea class="form-control  h-100" name="task_description" id="task_description" rows="6"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="align-self-center text-end">
                                                    <button type="submit" id="submitbtn" class="btn btn-primary">Add
                                                        extra-time</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    {{-- End Start Design --}}
                </div>
                <!-- partial:partials/_footer.html -->
                <x-footer-con />
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <x-footer />
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#starting_time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#ending_time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            });
        });

        flatpickr("#starting_date", {
            time_24hr: false,
            dateFormat: "d-m-Y",
            maxDate: "today"
        });

        flatpickr("#ending_date", {
            // enableTime: true,
            time_24hr: true,
            dateFormat: "d-m-Y",
            maxDate: "today"
        });
    </script>
    <script>
        function goBack() {
            window.history.back();
        }

        $(document).ready(function() {
            $("#myForm").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                rules: {
                    starting_date: {
                        required: true
                    },
                    starting_time: {
                        required: true
                    },
                    ending_date: {
                        required: true
                    },
                    ending_time: {
                        required: true
                    },
                    p_id: {
                        // required: true
                    },
                    task_description: {
                        required: true
                    },
                },
                errorPlacement: function(error, element) {
                    // error.insertAfter(element);
                },
                highlight: function(element, errorClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    $("#submitbtn").prop('disabled', true);
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>
