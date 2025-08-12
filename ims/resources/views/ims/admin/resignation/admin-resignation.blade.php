<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Admin Resignaton" />
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
                                                    <h1>Resignation</h1>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <div class="card">
                                                        <div class="card-body ">
                                                            <table id="resignation"
                                                                class="table table-bordered table-striped f-black">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No.</th>
                                                                        <th>Request By</th>
                                                                        <th>Date</th>
                                                                        <th>Reason</th>
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
        $(document).ready(function() {
            assignData();
        });

        function assignData() {
            $('#resignation').DataTable().destroy();
            let filter = {};
            ajaxDataTableInit(baseUrl() + '/get-resignation', 'resignation', 0, 0, filter);
        }

        $('body').on('click', '.approve-status', function() {
            var r_id = $(this).attr('data-value');
            var status = 'Approve';
            // console.log(r_id);

            $.ajax({
                url: baseUrl() + '/approve-resignation',
                method: 'POST',
                data: {
                    r_id: r_id,
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response == 'success') {
                        assignData(); // Refresh the table data
                    } else {
                        // alert(response.message);
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Initialize all Bootstrap tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>




</body>

</html>
