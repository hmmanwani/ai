<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Manage Notification" />
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
                                                    <h2 class="f-700">Manage Notification</h2>
                                                </div>
                                                {{-- <div class="col-md-6 d-flex justify-content-end">
                                                    <a href="{{ URL('add-task') }}">
                                                        <button type="button" class="btn btn-primary">
                                                            Add Task</button></a>
                                                </div> --}}
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-4">
                                                <div class="col-md-4">
                                                    <label for="team" class="f-black">Team:</label>
                                                    <select name="team" id="team" class=" form-select ">
                                                        <option value="all">All</option>
                                                        @foreach ($team as $teams)
                                                            <option value="{{ $teams->t_id }}">
                                                                {{ $teams->team }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="Status" class="f-black">Status:</label>
                                                    <select name="status" id="status" class=" form-select ">
                                                        <option value="all">All</option>
                                                        <option value="1">On</option>
                                                        <option value="0">Off</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- table  --}}
                                            <table id="EmployeeList"
                                                class="table table-bordered table-striped f-black f-600">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Name</th>
                                                        <th>Team</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="taskTableBody">
                                                    <!-- Rows will be appended here -->
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
        $('#status,#team').on("change", function() {
            assignData();
        });

        $(document).ready(function() {
            assignData();
        });

        function assignData() {
            // Destroy the DataTable instance
            $('#EmployeeList').DataTable().destroy();

            let filter = {};
            filter['team'] = $('#team').val();
            filter['status'] = $('#status').val();
            ajaxDataTableInit(baseUrl() + '/get-employee-notification-list', 'EmployeeList', 0, 0, filter);

            $('#EmployeeList').on('draw.dt', function() {
                var existingElems = document.querySelectorAll('.js-switch');
                existingElems.forEach(function(html) {
                    if (html.switchery) {
                        // html.switchery.destroy();
                    }
                });

                var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

                elems.forEach(function(html) {
                    if (!html.switchery) {
                        html.switchery = new Switchery(html, {
                            color: '#2bf503',
                            secondaryColor: '#f51303',
                            disabled: false
                        });
                        // Add change event listener
                        html.onchange = function() {
                            updateStatus($(this).data('id'), this.checked ? 1 : 0);
                        };
                    }
                });
            });
        }

        function updateStatus(employeeId, status) {
            $.ajax({
                url: '{{ URL('update-employee-notification-status') }}',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    e_id: employeeId,
                    status: status
                },
                success: function(response) {
                    if (response.message === 'success') {
                        notification('success', 'Email notification changed successfully');
                    } else {
                        notification('danger', 'Something went wrong', 'Error');
                    }

                    // Re-fetch the data without reloading the page
                    assignData();
                },
                error: function(xhr, status, error) {
                    notification('danger', 'An error occurred while updating the status', 'Error');
                    console.error('Error:', error);
                }
            });
        }
    </script>
</body>

</html>
