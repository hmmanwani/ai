<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Salary Slip" />
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
                                                    <h2 class= "">Salary Slip</h2>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <form action="{{ URL('submit-salary-slip') }}" method="POST"
                                                        enctype="multipart/form-data" id="uploadForm" class="d-inline">
                                                        @csrf
                                                        <label for="formFile" class="btn btn-primary text-white"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip" data-bs-html="true"
                                                            data-bs-title="You Must be Upload in <b>.CSV</b> file">
                                                            Upload
                                                            <input type="file" id="formFile" name="file"
                                                                style="display: none;">
                                                        </label>
                                                    </form>
                                                    <a href="{{ URL('admin-add-salary-slip') }}"
                                                        class="btn btn-primary f-white">Add Salary Slip</a>
                                                    <!-- <a href="{{ URL('generate-pdf') }}" class="btn btn-primary">Download Pdf</a> -->
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table id="salary-slip-detials"
                                                        class="table table-bordered table-striped f-black">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Name</th>
                                                                <th>Emp Id</th>
                                                                <th>Team</th>
                                                                <th>Designation</th>
                                                                <th>Date</th>
                                                                <th>Bank Name</th>
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
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>

    <script>
        $(document).ready(function() {
            var uploadButton = $('#uploadButton');
            var formFile = $('#formFile');
            var uploadForm = $('#uploadForm');

            uploadButton.on('click', function(event) {
                event.preventDefault();
                formFile.click();
            });

            formFile.on('change', function() {
                uploadForm.submit();
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
            $('#salary-slip-detials').DataTable().destroy();
            // let filter = {};
            // filter['e_id'] = 'all';
            ajaxDataTableInit(baseUrl() + '/get-salary-slip-detials', 'salary-slip-detials');
            // $('.loader').hide();
        }
    </script>
    <script>
        function toggleStatus(ssId, currentStatus) {
            let newStatus = (currentStatus === 'Active') ? 'Inactive' : 'Active';
            $.ajax({
                url: '{{ url('update-salary-slip-status') }}',
                type: 'POST',
                data: {
                    ss_id: ssId,
                    new_status: newStatus,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        assignData();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    </script>
</body>

</html>
