<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Manage Project" />
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
                                                    <h2 class="f-700">Manage Project</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <a href="{{ URL('add-project') }}">
                                                        <button type="button" class="btn btn-primary">
                                                            Add Project</button></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table id="ManageProject"
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
    <x-footer />
    <script>
        $(document).ready(function() {
            assignData();
        });

        function assignData() {
            $('#ManageProject').DataTable().destroy();
            let filter = {};
            ajaxDataTableInit(baseUrl() + '/get-manage-project', 'ManageProject', 0, 0, filter,
                true); // Passing true to enable striping
        }
    </script>

    <script>
        function toggleStatus(projectId, currentStatus) {
            // console.log(projectId);
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
                        $('#ManageProject').DataTable().ajax.reload();
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
