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
                    <section>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- card --}}
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2 class="card-title mb-0 f-24">HR Policy</h2>
                                                </div>
                                                {{-- <div class="col-md-6 d-flex justify-content-end"><button
                                                        onclick="goBack()" class="btn btn-primary"><i
                                                            class="fa fa-arrow-left me-2"
                                                            aria-hidden="true"></i>Back</button></div> --}}
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table id="hrpolicy" class="table table-bordered table-striped f-black">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>HR Policy</th>
                                                        <th>date</th>
                                                        <th>Last updated date</th>
                                                        <th>Download</th>
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
    {{-- <script>
        function goBack() {
            window.history.back();
        }
    </script> --}}
    <script>
        $('#search').click(function() {
            assignData();
        });
        $(document).ready(function() {
            assignData();
        });

        function assignData() {
            $('#hrpolicy').DataTable().destroy();
            let filter = {};
           ajaxDataTableInit(baseUrl() + '/get-hr-policy-user', 'hrpolicy', 0, 0, filter,"",false);
        }
    </script>
</body>

</html>
