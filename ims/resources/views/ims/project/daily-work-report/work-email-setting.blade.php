<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="" />
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
                                                    <h2 class="f-700">Email Notification Setting</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <button onclick="goBack()" class="btn btn-primary"><i
                                                            class="fa fa-arrow-left me-2"
                                                            aria-hidden="true"></i>Back</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table id="empteamlist"
                                                        class="table table-bordered table-striped f-black">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>No.</th>
                                                                <th>name</th>
                                                                <th>team</th>
                                                                <th>status</th>
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
    <x-footer />
    <script>
        $(document).ready(function() {
            assignData();
        });

        function assignData() {
            $('#empteamlist').DataTable().destroy();
            let filter = {};
            ajaxDataTableInit(baseUrl() + '/get-team-emp-list', 'empteamlist', 0, 0, filter);

            $('#empteamlist').on('draw.dt', function() {
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
                            updateStatus($(this).data('id'),$(this).data('leader-id'), this.checked ? 1 : 0);
                        };
                    }
                });
            });
        }
        function updateStatus(employeeId,LeaderID, status) {
                console.log(employeeId,LeaderID, status);
                
            $.ajax({
                url: '{{ URL('update-work-report-setting-status') }}',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    e_id: employeeId,
                    l_id: LeaderID,
                    status: status
                },
                success: function(response) {
                    if (response.message === 'success') {
                        notification('success', 'Work Report Notification Change');
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
    <script>
        function goBack() {
            history.go(-1);
        }
    </script>
</body>

</html>
