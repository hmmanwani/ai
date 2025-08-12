<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | All Leave" />
</head>

<body>
    <div class="container-scroller">
        <x-header />
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    <section id="overview">
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
                                                    <h1 class="">All Leave</h1>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="Date" class="f-black f-18 f-700">Date :</label>
                                                        <input type="text" id="l_date" name="l_date"
                                                            class="form-control" title="wfh Date" placeholder="d-m-Y"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 align-self-center">
                                                    <a href="javascript:void(0)" id="search"
                                                        class="btn btn-skyblue f-black">Search</a>
                                                    <a id="reset" class="btn btn-danger f-black">
                                                        Reset
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {{-- datatable --}}
                                                    <table id="approvedleavetable"
                                                        class="table table-bordered table-striped f-black">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Leave Type</th>
                                                                <th>Leave Date</th>
                                                                <th>Leave For</th>
                                                                <th>Leave Details</th>
                                                                <th>Leave By</th>
                                                                <th>Responsible person in absence</th>
                                                                <th>Leave Status</th>
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
    <div class="modal" tabindex="-1" id="deleteLeaveModal" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title f-800">Delete Approve/Reject Leave</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <p class="f-22 ">Are you sure you want to delete Leave ? This action can't be reversed.</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="LeaveId" value="">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a href="#" id="confirmDeleteBtn" class="btn btn-primary f-white">Yes</a>
                </div>

            </div>
        </div>
    </div>
    <x-footer />
    <script>
        $(document).ready(function() {
            $('#l_date').flatpickr({
                dateFormat: 'd-m-Y',
                // mode: "range",
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            assignApprovedData();
        });

        $('#search').click(function() {
            assignApprovedData();
        });

        $('#reset').on("click", function() {
            $('#l_date').val(''); // clear the input
            assignApprovedData(); // re-fetch data
        });

        function assignApprovedData() {
            $('#approvedleavetable').DataTable().destroy();
            let filter = {};
            filter['e_id'] = 'all';
            filter['l_date'] = $('#l_date').val();
            ajaxDataTableInit(baseUrl() + '/get-approved-leave', 'approvedleavetable', 0, 0, filter);
        }
    </script>
    <script>
        //  modal open codeserve
        $(document).ready(function() {
            $('body').on('click', 'a[id^="delete_approve_Leave_"]', function() {
                var id = $(this).data('id');
                $('#LeaveId').val(id);
                $('#confirmDeleteBtn').attr('href', "{{ url('delete-approve-leave') }}/" + id);
                $('#deleteLeaveModal').modal('show');
            });
        });
    </script>
</body>

</html>
