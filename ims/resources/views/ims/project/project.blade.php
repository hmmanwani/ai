<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Project" />
</head>
<style>
    @media (min-width: 576px) {
        #ass_sub_emp_modal .modal-dialog {
            max-width: 750px !important;
        }
    }
</style>

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
                                                    <h2 class="f-700">Assign Project</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <?php
                                                    if (session()->get('emp_login')['team'] == 1 || session()->get('emp_login')['team'] == 2 ) { ?>
                                                    <a href="{{ URL('add-project') }}">
                                                        <button type="button" class="btn btn-primary">
                                                            Add Project</button></a>
                                                    <?php  }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table id="Project"
                                                class="table table-bordered table-striped f-black f-600">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Project Title</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
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
    <div class="modal" tabindex="-1" id="ass_sub_emp_modal" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <?php if(session()->get('emp_login')['team'] == 1){  ?>
                    <h2 class="modal-title">Assign Team Member</h2>
                    <?php }else{ ?>
                    <h2 class="modal-title">Assign {{ $data['team_name']->team }} Team Member</h2>
                    <?php } ?>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ URL('update-assign-sub-emp') }}" method="POST" id="ass_sub_emp_form"
                        name="ass_sub_emp_form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="p_id" id="p_id" value="">
                                <div class="form-group">
                                    <label class="required control-label f-600" for="sub_emp">Project Member</label>
                                    <select name="sub_emp[]" id="sub_emp" class="form-select chosen-select" multiple>
                                        <option value="" disabled class="f-black f-700">-Select Members-</option>
                                        <?php foreach ($teamWiseEmployees as $team => $employees) { ?>
                                        <optgroup label="<?php echo $team; ?>">
                                            <?php foreach ($employees as $employee) { ?>
                                            <option value="{{ $employee->e_id }}">
                                                {{ $employee->fname }} {{ $employee->lname }}
                                            </option>
                                            <?php } ?>
                                        </optgroup>
                                        <?php } ?>
                                    </select>

                                </div>
                                <button type="submit" class="btn btn-primary">Assign</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
    <script>
        $(document).ready(function() {
            assignData();
        });

        function assignData() {
            $('#Project').DataTable().destroy();
            let filter = {};
            ajaxDataTableInit(baseUrl() + '/get-project-list', 'Project', 0, 0, filter,true,false);
        }
        
    </script>

    <script>
        function toggleStatus(projectId, currentStatus) {
            let newStatus = (currentStatus === 'Active') ? 'Inactive' : 'Active';
            $.ajax({
                url: '{{ route('update-project-status') }}',
                type: 'POST',
                data: {
                    p_id: projectId,
                    new_status: newStatus,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $('#Project').DataTable().ajax.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    </script>
    <script>
        $('body').on('click', 'a[id^="ass_sub_emp_"]', function() {
            var projectId = $(this).attr('data-id');
            $('#p_id').val(projectId)
            const select = $("#sub_emp");
            $.ajax({
                url: '{{ route('get-assign-sub-emp') }}',
                type: 'POST',
                data: {
                    p_id: projectId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $ids = JSON.parse(response['sub_emp']);
                    $('#ass_sub_emp_modal').modal('show');
                    $(".chosen-select").chosen();
                    var employeeArray = [];
                    $.each($ids, function(index, employee) {
                        employeeArray.push(employee);
                    });
                    console.log(employeeArray);
                    $('#sub_emp').val(employeeArray).trigger('chosen:updated');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        });
    </script>
</body>

</html>
