<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Edit Task" />
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
                    <form action="{{ URL('submit-edit-task') }}" method="POST" id="myForm">

                    <section id="EditTask">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2 class="f-700 f-black">Edit {{ $task_type }}</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <div class="me-3 d-flex align-items-center ">
                                                        
                                                            <div class="form-group">
                                                                <input type="hidden" value="{{ $task->tm_id }}"
                                                                    name="id" id="taskId">
                                                                <select name="status" id="status"
                                                                    class="form-select select3">
                                                                    <option value="to_do"
                                                                        {{ $task->status == 'to_do' ? 'selected' : '' }}>
                                                                        to_do
                                                                    </option>
                                                                    <option value="in_progress"
                                                                        {{ $task->status == 'in_progress' ? 'selected' : '' }}>
                                                                        in_progress</option>
                                                                    <option value="hold"
                                                                        {{ $task->status == 'hold' ? 'selected' : '' }}>
                                                                        hold
                                                                    </option>
                                                                    <option value="complete"
                                                                        {{ $task->status == 'complete' ? 'selected' : '' }}>
                                                                        complete</option>
                                                                </select>
                                                            </div>
                                                    </div>
                                                    <button onclick="goBack()" class="btn btn-primary task-detail-back"><i
                                                            class="fa fa-arrow-left f-20" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                                @csrf
                                                <div class="row">
                                                    @if (empty($project->project_title))
                                                        {{-- <div class="col-md-6"></div> --}}
                                                    @else
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label
                                                                    class="control-label f-600 required">Project:</label>
                                                                <input type="text" id="task_title" name="task_title"
                                                                    class="form-control"
                                                                    value="{{ $project->project_title }}"
                                                                    placeholder="Enter Task Title">
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <?php
                                                                    if (session()->get('emp_login')['team'] == 1 || session()->get('emp_login')['team'] == 2 || session()->get('emp_login')['team_lead'] == 1) { ?>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label f-600 required">Assign
                                                                Task:</label>
                                                            <select name="assign_task[]" id="assign_task"
                                                                class="form-select select3" value="{{ $empIds }}">
                                                                <option value="" disabled id="firstoption"
                                                                    class="f-black f-700">-Select
                                                                    Employee-</option>
                                                                @foreach ($emp as $emps)
                                                                    <option value="{{ $emps->e_id }}"
                                                                        {{ $emps->e_id == $empIds ? 'selected' : '' }}>
                                                                        {{ $emps->fname }} {{ $emps->lname }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label class="control-label f-600 required">Task
                                                                Title</label>
                                                            <input type="text" id="task_title" name="task_title"
                                                                class="form-control" value="{{ $task->task_title }}"
                                                                placeholder="Enter Task Title">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label f-600 required">Deadline</label>
                                                            <input type="text" id="deadline" name="deadline"
                                                                class="form-control" value="{{ $task->deadline }}"
                                                                placeholder="Enter Hours">
                                                        </div>
                                                    </div>
                                                    <?php if ($task->status == 'complete' && (session()->get('emp_login')['team'] == 1 || session()->get('emp_login')['team'] == 2 || session()->get('emp_login')['team_lead'] == 1)){ ?>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label f-600 ">comment</label>
                                                            <textarea type="text" id="comment" name="comment" class="form-control  h-100" rows="3"
                                                                value="{{ $task->comment }}" placeholder="Enter Your Comments"></textarea>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    <div class="col-md-12">
                                                        <div class="form-group f-black">
                                                            <label class="control-label f-600 required">Project
                                                                Description</label>
                                                            <input type="hidden" id="task_description_hidden"
                                                                name="task_description_hidden">
                                                            <textarea id="project-task-description" name="task_description" class="form-control" placeholder="Enter Project Title">{{ $task->task_description }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <input type="hidden" name="status" value="{{ $task->status }}"> --}}
                                                <input type="hidden" name="id" value="{{ $task->tm_id }}">
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" id="submitBtn"
                                                        class="btn btn-primary">Submit</button>
                                                </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
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
            $("#deadline").flatpickr({
                dateFormat: "d-m-Y",
                minDate: "today",
            });
        });
    </script>
    <script>
        $('#assign_task').select2({
            placeholder: "-Select Employee-",
            allowClear: true
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#project-task-description').summernote({
                height: 150,
                codemirror: {
                    theme: 'monokai'
                },
                onChange: function(contents, $editable) {
                    $('#task_description_hidden').val(contents);
                }
            });
        });
    </script>
    <script>
        $('.select3').select2({
            placeholder: "-Select -",
            tags: true,
            allowClear: true,
            minimumResultsForSearch: Infinity,
        });
        // $('#status').on('change', function() {
        //     var status = $(this).val();
        //     var id = $('#taskId').val();

        //     $.ajax({
        //         url: "{{ URL('update-task-status') }}",
        //         method: 'POST',
        //         data: {
        //             id: id,
        //             status: status,
        //             _token: '{{ csrf_token() }}'
        //         },
        //         success: function(response) {
        //             console.log('Task status updated successfully:', response);
        //             location.reload();
        //         },
        //         error: function(xhr, status, error) {
        //             console.error('Error updating task status:', error);
        //         }
        //     });
        // });
    </script>
    <script>
        function goBack() {
            window.history.back();
        }
        $("#MyForm").validate({
            errorElement: 'div',
            errorClass: 'invalid-feedback',
            rules: {
                task_title: {
                    required: true
                },
                deadline: {
                    required: true
                },
                emp: {
                    required: true
                },
                'emp[]': {
                    required: true
                },
                task_description_hidden: {
                    required: true
                },
            },
            messages: {

            },
            errorPlacement: function(error, element) {
                //  error.insertAfter(element);
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
    </script>
</body>

</html>
