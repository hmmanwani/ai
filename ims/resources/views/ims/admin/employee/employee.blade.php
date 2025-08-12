<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Employee" />
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
                    <section id="admin ">
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
                                                    <h1 class= "">Employee</h1>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <a href="{{ URL('addemployee') }}">
                                                        <button type="button" class="btn btn-primary">
                                                            Add Employee</button></a>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4 ">
                                                    <label for="name" class="f-black">Status:</label>
                                                    <select class="form-select" id="status"
                                                        aria-label="Default select example">
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="team" class="f-black">Team:</label>
                                                    <select name="team" id="team" class=" form-select ">
                                                        <option value="all">-Select team-</option>
                                                        @foreach ($team as $teams)
                                                            <option value="{{ $teams->t_id }}">
                                                                {{ $teams->team }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-body ">
                                                            <table id="employeetable"
                                                                class="table table-bordered table-striped f-black">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No.</th>
                                                                        <th>Name</th>
                                                                        <th>Email</th>
                                                                        <th>Team</th>
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
        $('#status,#team').on("change", function() {
            assignData();
        });
        $(document).ready(function() {
            assignData();
        });

        function assignData() {
            $('#employeetable').DataTable().destroy();
            let filter = {};
            filter['status'] = $('#status').val();
            filter['team'] = $('#team').val();
            ajaxDataTableInit(baseUrl() + '/get-employee-list', 'employeetable', 0, 0, filter);
        }
    </script>
    <script>
        function toggleStatus(employeeId, currentStatus) {
            let newStatus = (currentStatus === 'Active') ? 'Inactive' : 'Active';
            $.ajax({
                url: '{{ route('update_employee_status') }}',
                type: 'POST',
                data: {
                    employee_id: employeeId,
                    new_status: newStatus,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $('#employeetable').DataTable().ajax.reload();
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
