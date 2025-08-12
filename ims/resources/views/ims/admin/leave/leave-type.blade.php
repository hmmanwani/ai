<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Leave Type" />
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
                                                    <h1 class= "">Leave Type</h1>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <a href="javascript:voil(0)" id="addleavetype"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-plus f-24 f-white" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-body ">
                                                            <table id="leavetype"
                                                                class="table table-bordered table-striped f-black">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No.</th>
                                                                        <th>Leave Type</th>
                                                                        <th>Total Leaves</th>
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
    <div class="modal" tabindex="-1" id="AddLeaveTypeModal" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered 	modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Leave Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/submit-leave-types') }}" method="POST" id="MyFrom">
                        @csrf
                        <div class="row">
                            {{-- <input type="hidden" name="id" value="{{ $data->e_id }}"> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="leave_type" class="required f-black">Leave Type:</label>
                                    <div class="col-md-12">
                                        <input type="text" id="leave_type" name="leave_type" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_leave" class="required f-black">Total Leaves :</label>
                                    <div class="col-md-12">
                                        <input type="number" id="total_leave" name="total_leave" class="form-control">
                                        <div class="invalid-feedback" id="email-error">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" d-flex justify-content-end ">
                                <button type="submit" id="submitBtn" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <x-footer />
    <script>
        $('#addleavetype').click(function() {
            $('#AddLeaveTypeModal').modal('show');
        })
    </script>
    <script>
        $(document).ready(function() {
            assignData();
        });

        function assignData() {
            $('#leavetype').DataTable().destroy();
            let filter = {};
            ajaxDataTableInit(baseUrl() + '/get-leavetype', 'leavetype', 0, 0, filter);
        }

        $(document).ready(function() {
            $("#MyFrom").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                rules: {
                    leave_type: {
                        required: true
                    },
                    total_leave: {
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
                    $("#submitBtn").prop('disabled', true);
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>
