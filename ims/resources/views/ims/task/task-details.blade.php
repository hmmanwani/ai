<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Task Details" />
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
                                    <div class="card">
                                        <div class="card-header">
                                            <div div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2 class="f-700 f-black">Task Details </h2>
                                                </div>

                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <?php if(in_array($empLogin,json_decode($data->assign_task)) && $data->status == 'complete' ){ ?>
                                                        <span class="badge bg-success me-4 d-flex align-self-center f-20">Complete</span>
                                                    <?php }else{ ?>
                                                    <div class="me-3 d-flex align-items-center ">
                                                        <form action="{{ URL('update-task-status') }}" method="POST"
                                                            class="h-50px" id="taskStatusForm">
                                                            <div class="form-group">
                                                                <input type="hidden" value="{{ $data->tm_id }}"
                                                                    name="id" id="taskId">
                                                                <select name="status" id="status"
                                                                    class="form-select select3">
                                                                    <option value="to_do"
                                                                        {{ $data->status == 'to_do' ? 'selected' : '' }}>
                                                                        to_do
                                                                    </option>
                                                                    <option value="in_progress"
                                                                        {{ $data->status == 'in_progress' ? 'selected' : '' }}>
                                                                        in_progress</option>
                                                                    <option value="hold"
                                                                        {{ $data->status == 'hold' ? 'selected' : '' }}>
                                                                        hold
                                                                    </option>
                                                                    <option value="complete"
                                                                        {{ $data->status == 'complete' ? 'selected' : '' }}>
                                                                        complete</option>
                                                                </select>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <?php } ?>
                                                    <button onclick="goBack()" class="btn btn-primary task-detail-back"><i
                                                            class="fa fa-arrow-left f-20" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                {{-- Task title  --}}
                                                <div class="col-md-12 mb-3">
                                                    <div class="mt-2 d-flex">
                                                        <label class="control-label f-18  f-600">Task Title
                                                            :</label>
                                                        <p class="f-20 f-black ms-1 f-700">
                                                            {{ $data->task_title }}
                                                        </p>
                                                    </div>
                                                </div>

                                                {{-- project name  --}}
                                                @if ($data->project_title != null)
                                                    <div class="col-md-12 ">
                                                        <div class="mt-2">
                                                            <label class="control-label f-18  f-600">
                                                                Project :</label>
                                                            <p class="f-20 f-black f-700">
                                                                {{ $data->project_title }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- task type --}}
                                                <div class="col-md-3">
                                                    <div class="mt-2">
                                                        <label class="control-label f-18 f-600">Task Type:</label>
                                                        <p class="f-20 f-black f-700">
                                                            @if ($data->task_type == 0)
                                                                Project Task
                                                            @elseif ($data->task_type == 1)
                                                                Individual Task
                                                            @elseif ($data->task_type == 2)
                                                                Other Task
                                                            @else
                                                                Unknown Task Type
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>

                                                {{-- assign by  --}}
                                                <div class="col-md-3">
                                                    <div class="mt-2">
                                                        <label class="control-label f-18  f-600">Assign By
                                                            :</label>
                                                        <p class="f-20 f-black f-700">
                                                            {{ $data->fname }} {{ $data->lname }}
                                                        </p>
                                                    </div>
                                                </div>

                                                {{-- deadline --}}
                                                <div class="col-md-3">
                                                    <div class="mt-2">
                                                        <label class="control-label f-18  f-600">Deadline
                                                            :</label>
                                                        <p class="f-20 f-black f-700">
                                                            {{ $data->deadline }}
                                                        </p>
                                                    </div>
                                                </div>

                                                {{-- complete date  --}}
                                                @if ($data->complete_date != null)
                                                    <div class="col-md-3">
                                                        <div class="mt-2">
                                                            <label class="control-label f-18  f-600">Complete Date
                                                                :</label>
                                                            <p class="f-20 f-black f-700">
                                                                {{ $data->complete_date }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- Project Description --}}
                                                <div class="col-md-12 mt-4">
                                                    <div class="form-group">
                                                        <label class="control-label f-18  f-600">Project
                                                            Description</label>
                                                        <div class="f-20 f-black f-700" id="taskdetails_description">
                                                            <?php echo $data->task_description; ?> </div>
                                                    </div>
                                                </div>

                                                {{-- Comment  --}}
                                                @if ($data->comment != null)
                                                    <div class="col-md-3">
                                                        <div class="mt-2">
                                                            <label class="control-label f-18  f-600">Comment
                                                                :</label>
                                                            <p class="f-20 f-black f-700">
                                                                {{ $data->comment }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif

                                                {{-- submit task comment  --}}
                                                @if ($show == 1)
                                                    <form action="{{ URL('submit-task-comment') }}" method="POST"
                                                        id="myForm">
                                                        @csrf
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label f-18  f-600">comment</label>
                                                                <textarea type="text" id="comment" name="comment" class="form-control  h-100" rows="3"
                                                                    value="{{ $data->comment }}" placeholder="Enter Your Comments"></textarea>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="id"
                                                            value="{{ $data->tm_id }}">
                                                        <div class="d-flex justify-content-end">
                                                            <button type="submit"
                                                                class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                @endif
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
        function goBack() {
            history.go(-1);
        }
    </script>
    <script>
        $('.select3').select2({
            placeholder: "-Select -",
            tags: true,
            allowClear: true,
            minimumResultsForSearch: Infinity,
        });
        $('#status').on('change', function() {
            var status = $(this).val();
            var id = $('#taskId').val();

            $.ajax({
                url: "{{ URL('update-task-status') }}",
                method: 'POST',
                data: {
                    id: id,
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('Task status updated successfully:', response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error updating task status:', error);
                }
            });
        });
    </script>
</body>

</html>
