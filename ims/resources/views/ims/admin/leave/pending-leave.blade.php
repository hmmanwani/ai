<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Pending Leave" />
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
                                                    <h1 class= "">Pending Leave</h1>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table id="pendingleavetable"
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
        $('#search').click(function() {
            assignData();
        });
        assignData();
        
        // click the pending badge approve code
        // $(document).ready(function() {
        //     $(document).on('click', '.approve-status', function() {
        //         var lv_id = $(this).data('id');
        //         $.ajax({
        //             url: baseUrl() + '/approve-leave',
        //             method: 'POST',
        //             data: {
        //                 lv_id: lv_id,
        //                 status: 'Approve',
        //                 _token: '{{ csrf_token() }}'
        //             },
        //             success: function(response) {
        //                 assignData();
        //             }
        //         });
        //     });
        // });

        function assignData() {
            $('#pendingleavetable').DataTable().destroy();
            let filter = {};
            filter['e_id'] = 'all';
            ajaxDataTableInit(baseUrl() + '/get-pending-leave', 'pendingleavetable', 0, 0, filter);
            $('#pendingleavetable').on('draw.dt', function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            });
        }
    </script>
</body>

</html>
