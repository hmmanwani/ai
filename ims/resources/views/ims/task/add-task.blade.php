<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Add Task" />
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
                                                    <h2 class="f-700 f-black">Add Task</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end"><button
                                                        onclick="goBack()" class="btn btn-primary"><i
                                                            class="fa fa-arrow-left me-2"
                                                            aria-hidden="true"></i>Back</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body" id="AddTask">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <!-- Nav tabs -->
                                                    <ul class="nav nav-tabs" id="taskTabs" role="tablist">
                                                        <!-- Personal Task Tab -->
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link f-18 active" id="personalTask-tab"
                                                                data-bs-toggle="tab" data-bs-target="#personalTask"
                                                                type="button" role="tab"
                                                                aria-controls="personalTask"
                                                                aria-selected="false">Individual Task</button>
                                                        </li>
                                                        <!-- Other Task Tab -->
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link f-18 " id="otherTask-tab"
                                                                data-bs-toggle="tab" data-bs-target="#otherTask"
                                                                type="button" role="tab" aria-controls="otherTask"
                                                                aria-selected="false">My Task</button>
                                                        </li>
                                                        <!-- Project Task Tab -->
                                                        <li class="nav-item <?php if ($show_project_task == 0) {
                                                            echo 'd-none';
                                                        } ?> " role="presentation">
                                                            <button class="nav-link f-18   " id="projectTask-tab"
                                                                data-bs-toggle="tab" data-bs-target="#projectTask"
                                                                type="button" role="tab"
                                                                aria-controls="projectTask" aria-selected="true">Project
                                                                Task</button>
                                                        </li>
                                                    </ul>

                                                    <!-- Tab content -->
                                                    <div class="tab-content" id="taskTabsContent">
                                                        <!-- Personal Task Content -->
                                                        <div class="tab-pane fade active show" id="personalTask"
                                                            role="tabpanel" aria-labelledby="personalTask-tab">
                                                            <form id="personalTaskForm"
                                                                action="{{ url('submit-task') }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row">
                                                                    {{-- start assign task --}}
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <?php $groupedEmployees = $emp->groupBy('team'); ?>
                                                                            <label class="required control-label f-600"
                                                                                for="emp">Assign Task</label>
                                                                            <select name="assign_task[]"
                                                                                id="assign_task_personal"
                                                                                class="form-select select3">
                                                                                <option value="" disabled selected
                                                                                    id="firstoption"
                                                                                    class="f-black f-700">-Select
                                                                                    Employee-</option>
                                                                                @foreach ($groupedEmployees as $team => $employees)
                                                                                    <optgroup
                                                                                        label="{{ $team }}">
                                                                                        @foreach ($employees as $emps)
                                                                                            <option
                                                                                                value="{{ $emps->e_id }}">
                                                                                                {{ $emps->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </optgroup>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    {{-- end assign task  --}}
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="control-label f-600 required">Task
                                                                                Title</label>
                                                                            <input type="text" id="task_title"
                                                                                name="task_title" class="form-control"
                                                                                placeholder="Enter Task Title">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="control-label f-600 required">Deadline</label>
                                                                            <input type="text" id="deadline"
                                                                                name="deadline"
                                                                                class="form-control deadline"
                                                                                placeholder="Enter Hours">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="control-label f-600 required">Project
                                                                                Description</label>
                                                                            <input type="hidden"
                                                                                id="task_description_hidden"
                                                                                name="task_description_hidden">
                                                                            <textarea id="personal-task-description" name="task_description" class="form-control"
                                                                                placeholder="Enter Project Title"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="task_type"
                                                                        value="1">
                                                                    <div class="d-flex justify-content-end">
                                                                        <button type="submit" id="submitBtn"
                                                                            class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <!-- Other Task Content -->
                                                        <div class="tab-pane fade" id="otherTask" role="tabpanel"
                                                            aria-labelledby="otherTask-tab">
                                                            <form id="otherTaskForm" action="{{ url('submit-task') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row">
                                                                    {{-- end assign task  --}}
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="control-label f-600 required">Task
                                                                                Title</label>
                                                                            <input type="text" id="task_title"
                                                                                name="task_title" class="form-control"
                                                                                placeholder="Enter Task Title">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="control-label f-600 required">Deadline</label>
                                                                            <input type="text" id="deadline"
                                                                                name="deadline"
                                                                                class="form-control deadline"
                                                                                placeholder="Enter Hours">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="control-label f-600 required">Project
                                                                                Description</label>
                                                                            <input type="hidden"
                                                                                id="task_description_hidden"
                                                                                name="task_description_hidden">
                                                                            <textarea id="other-task-description" name="task_description" class="form-control"
                                                                                placeholder="Enter Project Title"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="task_type"
                                                                        value="2">
                                                                    <div class="d-flex justify-content-end">
                                                                        <button type="submit" id="submitBtn"
                                                                            class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <!-- Project Task Content -->
                                                        <div class="tab-pane fade <?php if ($show_project_task == 0) {
                                                            echo 'd-none';
                                                        } ?>"
                                                            id="projectTask" role="tabpanel"
                                                            aria-labelledby="projectTask-tab">
                                                            <form id="projectTaskForm"
                                                                action="{{ url('submit-task') }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <label class="control-label f-600 required"
                                                                                for="project">Select Project</label>
                                                                            @if ($project->isEmpty())
                                                                                <p class="text-danger">No projects are
                                                                                    assigned.</p>
                                                                            @else
                                                                                <select class="form-select"
                                                                                    id="p_id" name="p_id"
                                                                                    aria-label="Default select example">
                                                                                    <option value="" disabled
                                                                                        selected selected>-Select
                                                                                        project-
                                                                                    </option>
                                                                                    @foreach ($project as $projects)
                                                                                        <option
                                                                                            value="{{ $projects->p_id }}">
                                                                                            {{ $projects->project_title }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    {{-- start assign task --}}
                                                                    <div class="col-md-7">
                                                                        <div class="form-group">
                                                                            <label class="required control-label f-600"
                                                                                for="emp">Assign Task</label>
                                                                            <select name="assign_task[]"
                                                                                id="assign_task"
                                                                                class="form-select select2">
                                                                                <option value="" disabled
                                                                                    id="firstoption"
                                                                                    class="f-black f-700">-Select
                                                                                    Project-</option>
                                                                                <!-- Options will be populated by AJAX -->
                                                                            </select>
                                                                            <p id="no-employees-message"
                                                                                style="display:none; color:red;"></p>
                                                                            <!-- Message will be displayed here -->
                                                                        </div>
                                                                    </div>
                                                                    {{-- end assign task  --}}
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="control-label f-600 required">Task
                                                                                Title</label>
                                                                            <input type="text" id="task_title"
                                                                                name="task_title" class="form-control"
                                                                                placeholder="Enter Task Title">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="control-label f-600 required">Deadline</label>
                                                                            <input type="text" id="deadline"
                                                                                name="deadline"
                                                                                class="form-control deadline"
                                                                                placeholder="Enter Hours">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="control-label f-600 required">Project
                                                                                Description</label>
                                                                            <input type="hidden"
                                                                                id="task_description_hidden"
                                                                                name="task_description_hidden">
                                                                            <textarea id="project-task-description" name="task_description" class="form-control"
                                                                                placeholder="Enter Project Title"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="task_type"
                                                                    value="0">
                                                                <div class="d-flex justify-content-end">
                                                                    <button type="submit" id="submitBtn"
                                                                        class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        {{-- end other task --}}
                                                    </div>
                                                </div>
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
    <x-footer />
    <script>
        $(document).ready(function() {
            $(".deadline").flatpickr({
                dateFormat: "d-m-Y",
                minDate: "today",
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#assign_task').select2({
                placeholder: "-Select Project-",
                allowClear: true

            });

            $('#assign_task_personal').select2({
                placeholder: "-Select Employee-",
                allowClear: true
            });

            $('#assign_task_other').select2({
                placeholder: "-Select Employee-",
                allowClear: true
            });

            $('#p_id').change(function() {
                var projectId = $(this).val();

                $.ajax({
                    url: 'fetch-project-member',
                    type: 'POST',
                    data: {
                        p_id: projectId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#assign_task').empty();

                        if (response.length > 0) {
                            $('#assign_task').append(
                                '<option value="" disabled selected>-Slect Members-</option>'
                            );
                            response.forEach(function(employee) {
                                var option = $('<option>', {
                                    value: employee.e_id,
                                    text: employee.fname + ' ' + employee.lname
                                });
                                $('#assign_task').append(option);
                            });
                        } else {
                            $('#assign_task').append(
                                '<option value="" disabled>No employees to assign</option>');
                        }

                        $('#assign_task').trigger('change');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
    <script>
    $(document).ready(function() {
        const summernoteOptions = {
            height: 150,
            codemirror: {
                theme: 'monokai'
            },
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link', 'table']] 
            ]
        };

        // Initialize Summernote on all matching selectors
        $('#project-task-description, #personal-task-description, #other-task-description').summernote(summernoteOptions);
    });
</script>
    <script>
        function goBack() {
            window.history.back();
        }
        $(document).ready(function() {
            $("#projectTaskForm").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                rules: {
                    task_title: {
                        required: true
                    },
                    deadline: {
                        required: true
                    },
                    assign_task: {
                        required: true
                    },
                    task_description_hidden: {
                        required: true
                    },
                    p_id: {
                        required: true
                    }
                },
                messages: {
                    // Messages for Project Task form
                },
                errorPlacement: function(error, element) {
                    // Custom error placement
                },
                highlight: function(element, errorClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    $("#submitBtn").prop('disabled', true);
                    form.submit();
                }
            });

            $("#personalTaskForm").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                rules: {
                    task_title: {
                        required: true
                    },
                    deadline: {
                        required: true
                    },
                    assign_task_personal: {
                        required: true
                    },
                    task_description_hidden: {
                        required: true
                    }
                },
                messages: {
                    // Messages for Personal Task form
                },
                errorPlacement: function(error, element) {
                    // Custom error placement
                },
                highlight: function(element, errorClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            $("#otherTaskForm").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                rules: {
                    task_title: {
                        required: true
                    },
                    deadline: {
                        required: true
                    },
                    assign_task_other: {
                        required: true
                    },
                    task_description_hidden: {
                        required: true
                    }
                },
                messages: {
                    // Messages for Other Task form
                },
                errorPlacement: function(error, element) {
                    // Custom error placement
                },
                highlight: function(element, errorClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>


</body>

</html>
