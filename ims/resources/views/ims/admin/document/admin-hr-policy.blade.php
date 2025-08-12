<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | HR Policy" />
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
                                                    <h2 class= "">HR Policy</h2>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="{{ URL('submit-hr-policy') }}" method="POST"
                                                        enctype="multipart/form-data" id="MyForm">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="mb-3">
                                                                    <label for="formFile" class="form-label">Upload your
                                                                        document:</label>
                                                                    <input class="form-control" type="file"
                                                                        id="document" name="document">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label for="formFile" class="form-label">Year
                                                                        :</label>
                                                                    <input class="form-control" type="text"
                                                                        id="yearpicker" name="year">
                                                                </div>
                                                            </div>
                                                            <div class=" d-flex justify-content-end ">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <table id="hrpolicy"
                                                        class="table table-bordered table-striped f-black">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Documents</th>
                                                                <th>Year</th>
                                                                <th>Last Updated Date</th>
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
    <div class="modal" tabindex="-1" id="EditHrPolicy" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title f-800">Edit HR Policy</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ URL('submit-edit-hr-policy') }}" method="POST"
                                enctype="multipart/form-data" id="EditMyForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="id" id="hpid">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Upload your
                                                document:</label>
                                            <input class="form-control" type="file" id="document" name="document">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end modal-footer mt-3">
                                    <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
    <script>
        $('body').on('click', 'a[id^="edit-hr-policy_"]', function() {
            $('#EditHrPolicy').modal('show');
        });

        $(document).ready(function() {
            $(document).on('click', '[id^=edit-hr-policy_]', function() {
                var hpId = $(this).data('id');
                $('#hpid').val(hpId);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#yearpicker').datepicker({
                format: "yyyy",
                startView: "years",
                minViewMode: "years",
                autoclose: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            assignData();
        });

        function assignData() {
            $('#hrpolicy').DataTable().destroy();
            let filter = {};
            ajaxDataTableInit(baseUrl() + '/get-hr-policy', 'hrpolicy', 0, 0, filter);
        }
    </script>
    <script>
        function goBack() {
            window.history.back();
        }
        $("#MyForm").validate({
            errorElement: 'div',
            errorClass: 'invalid-feedback',
            rules: {
                document: {
                    required: true
                },
                year: {
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
        $("#EditMyForm").validate({
            errorElement: 'div',
            errorClass: 'invalid-feedback',
            rules: {
                document: {
                    required: true
                },
                year: {
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
                form.submit();
            }
        });
    </script>
</body>

</html>
